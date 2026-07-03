<?php

namespace App\Services\Pendaftaran;

use App\Models\Kuis;
use App\Models\Materi;
use App\Models\Soal;
use App\Models\SoalJawaban;
use App\Models\Pendaftaran;
use App\Models\ProgresJawaban;
use App\Models\ProgresKelas;
use App\Models\ProgresKuis;
use App\Models\ProgresKuisHistori;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;

final class CoursePlayerService
{
    private const MAKS_PERCOBAAN_KUIS = 3;
    private const QUIZ_TIMER_CACHE_PREFIX = 'quiz_timer_started_at';
    private const QUIZ_TIMER_CACHE_DAYS = 7;

    public function __construct(
        private readonly PendaftaranService $pendaftaranService,
        private readonly ProgresKelasService $progresKelasService,
    ) {}

    public function getOwnedPendaftaran(string $id, int $penggunaId): ?Pendaftaran
    {
        return $this->pendaftaranService->getDetailData($id, ['id_pengguna' => $penggunaId]);
    }

    public function syncAndGetOrderedMateri(Pendaftaran $pendaftaran): Collection
    {
        $this->progresKelasService->syncProgresForPendaftaran($pendaftaran);

        return $this->getOrderedMateri($pendaftaran->id_pendaftaran);
    }

    public function getProgressPayload(Pendaftaran $pendaftaran): array
    {
        return $this->buildProgressPayload($pendaftaran);
    }

    private function buildProgressPayload(Pendaftaran $pendaftaran): array
    {
        $rows = $this->getOrderedMateri($pendaftaran->id_pendaftaran);
        $allMateri = $rows->values();
        $totalMateri = $allMateri->count();

        if ($totalMateri === 0) {
            return [
                'progres' => [],
                'ringkasan' => [
                    'total_materi' => 0,
                    'materi_selesai' => 0,
                    'persentase' => 0,
                    'semua_selesai' => false,
                    'semua_kuis_selesai' => false,
                    'bisa_sertifikat' => false,
                ],
                'navigasi' => [
                    'posisi_saat_ini' => 0,
                    'materi_sebelumnya' => null,
                    'materi_saat_ini' => null,
                    'materi_selanjutnya' => null,
                ],
                'kelas' => [
                    'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                    'judul' => $pendaftaran->kelas_judul ?? '',
                    'status' => $pendaftaran->status ?? '',
                ],
            ];
        }

        $currentIndex = $allMateri->search(fn ($m) => ! $this->isProgressUnitComplete($m));
        if ($currentIndex === false) {
            $currentIndex = $totalMateri - 1;
        }

        $materiSelesai = $allMateri
            ->filter(fn ($m) => $this->isProgressUnitComplete($m))
            ->count();

        $allQuizCompleted = $allMateri
            ->every(fn ($m) => ! (bool) ($m->punya_kuis ?? false) || (bool) ($m->kuis_selesai ?? true));

        $progres = [];
        $bagianMap = [];

        foreach ($allMateri as $index => $row) {
            $bagianId = $row->id_bagian_kelas;

            if (! isset($bagianMap[$bagianId])) {
                $bagianMap[$bagianId] = count($progres);
                $progres[] = [
                    'bagian' => [
                        'id_bagian_kelas' => $bagianId,
                        'urutan_bagian_kelas' => $row->urutan_bagian_kelas,
                        'bagian_judul' => $row->bagian_judul,
                        'bagian_urutan' => $row->bagian_urutan,
                        'materi' => [],
                        'bagian_selesai' => true,
                        'kuis_tersedia' => false,
                    ],
                ];
            }

            $unitSelesai = $this->isProgressUnitComplete($row);

            if (! $unitSelesai) {
                $progres[$bagianMap[$bagianId]]['bagian']['bagian_selesai'] = false;
            }

            $bisaDiakses = $this->cekAksesByIndex($allMateri, $index, $currentIndex);

            $progres[$bagianMap[$bagianId]]['bagian']['materi'][] = [
                'id_progres_kelas' => $row->id_progres_kelas,
                'materi_judul' => $row->materi_judul,
                'tipe' => $row->tipe_tampilan ?? $row->tipe,
                'tipe_asli' => $row->tipe,
                'urutan' => $row->urutan_materi,
                'selesai' => $unitSelesai,
                'materi_selesai' => (bool) $row->selesai,
                'punya_kuis' => (bool) ($row->punya_kuis ?? false),
                'kuis_selesai' => (bool) ($row->kuis_selesai ?? false),
                'kuis_sudah_submit' => (bool) ($row->kuis_sudah_submit ?? false),
                'kuis_pending' => (bool) ($row->kuis_pending ?? false),
                'selesai_pada' => $row->selesai_pada,
                'bisa_diakses' => $bisaDiakses,
                'is_current' => $index === $currentIndex,
            ];
        }

        foreach ($progres as &$item) {
            $materiDiBagian = collect($item['bagian']['materi']);
            $adaKuis = $materiDiBagian->contains(fn ($m) => (bool) ($m['punya_kuis'] ?? false) || ($m['tipe'] ?? null) === 'kuis');
            $semuaMateriUtamaSelesai = $materiDiBagian->every(fn ($m) => (bool) ($m['materi_selesai'] ?? $m['selesai'] ?? false));

            $item['bagian']['kuis_tersedia'] = $adaKuis && $semuaMateriUtamaSelesai;
        }
        unset($item);

        $persentase = $totalMateri > 0
            ? round(($materiSelesai / $totalMateri) * 100, 2)
            : 0;

        $materiSebelumnya = $currentIndex > 0
            ? $this->formatMateri($allMateri[$currentIndex - 1])
            : null;

        $materiSaatIni = $this->formatMateri($allMateri[$currentIndex]);

        $materiSelanjutnya = $currentIndex < $totalMateri - 1
            ? $this->formatMateri($allMateri[$currentIndex + 1])
            : null;

        return [
            'progres' => $progres,
            'ringkasan' => [
                'total_materi' => $totalMateri,
                'materi_selesai' => $materiSelesai,
                'persentase' => $persentase,
                'semua_selesai' => $materiSelesai === $totalMateri,
                'semua_kuis_selesai' => $allQuizCompleted,
                'bisa_sertifikat' => $materiSelesai === $totalMateri && $allQuizCompleted,
            ],
            'navigasi' => [
                'posisi_saat_ini' => $currentIndex + 1,
                'materi_sebelumnya' => $materiSebelumnya,
                'materi_saat_ini' => $materiSaatIni,
                'materi_selanjutnya' => $materiSelanjutnya,
            ],
            'kelas' => [
                'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                'judul' => $pendaftaran->kelas_judul ?? '',
                'status' => $pendaftaran->status ?? '',
            ],
        ];
    }

    public function getMateriPayload(Pendaftaran $pendaftaran, string $idProgresKelas, bool $forceQuizReview = false): array
    {
        $allMateri = $this->getOrderedMateri($pendaftaran->id_pendaftaran);
        $progresKelas = $allMateri->firstWhere('id_progres_kelas', $idProgresKelas);

        if (! $progresKelas) {
            throw new RuntimeException('Unauthorized', 403);
        }

        if (! $this->canAccessProgres($allMateri, $idProgresKelas)) {
            throw new RuntimeException('Materi belum dapat diakses', 403);
        }

        $materi = Materi::select('id_materi', 'judul', 'content', 'url_video', 'tipe')
            ->where('id_materi', $progresKelas->id_materi)
            ->first();

        if (! $materi) {
            throw new RuntimeException('Materi tidak ditemukan', 404);
        }

        $tampilkanKuis = $this->shouldDisplayQuizPayload($pendaftaran, $progresKelas, $materi, $forceQuizReview);
        $tipeMateri = $tampilkanKuis ? 'kuis' : $materi->tipe;
        $kuisData = $tampilkanKuis
            ? $this->buildKuisPayload($pendaftaran, $progresKelas, $materi, $forceQuizReview)
            : null;

        $progresInfo = [
            'id_progres_kelas' => $progresKelas->id_progres_kelas,
            'selesai' => (bool) $progresKelas->selesai,
            'unit_selesai' => $this->isProgressUnitComplete($progresKelas),
            'materi_selesai' => (bool) $progresKelas->selesai,
            'punya_kuis' => (bool) ($progresKelas->punya_kuis ?? false),
            'kuis_selesai' => (bool) ($progresKelas->kuis_selesai ?? false),
            'kuis_sudah_submit' => (bool) ($progresKelas->kuis_sudah_submit ?? false),
            'kuis_pending' => (bool) ($progresKelas->kuis_pending ?? false),
            'selesai_pada' => $progresKelas->selesai_pada,
            'posisi_video_terakhir' => $progresKelas->posisi_video_terakhir,
            'waktu_belajar_detik' => $progresKelas->waktu_belajar_detik,
        ];

        $navigasi = $this->getNavigasiSet($allMateri, $progresKelas->id_progres_kelas);

        $payload = [
            'tipe_materi' => $tipeMateri,
            'materi' => $tampilkanKuis ? [
                'id_materi' => $materi->id_materi,
                'judul' => $kuisData['kuis']['meta']['judul'] ?? $materi->judul,
                'tipe' => 'kuis',
                'tipe_asli' => $materi->tipe,
                'content' => $materi->content,
                'url_video' => $materi->url_video,
            ] : [
                'id_materi' => $materi->id_materi,
                'judul' => $materi->judul,
                'tipe' => $materi->tipe,
                'content' => $materi->content,
                'url_video' => $materi->url_video,
            ],
            'kuis' => $tampilkanKuis ? $kuisData['kuis'] : null,
            'progres' => $progresInfo,
            'bisa_diakses' => true,
            'id_progres_kelas' => $progresKelas->id_progres_kelas,
            'navigasi' => $navigasi,
        ];

        return $payload;
    }

   public function updateProgres(
    Pendaftaran $pendaftaran,
    string $idProgresKelas,
    int $waktuBelajarDetik = 0,
    int $posisiVideoTerakhir = 0,
    bool $selesai = false
): array {
    $allMateri = $this->getOrderedMateri($pendaftaran->id_pendaftaran);
    $progresKelas = ProgresKelas::where('id_progres_kelas', $idProgresKelas)
        ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
        ->first();

    if (! $progresKelas) {
        throw new RuntimeException('Unauthorized', 403);
    }

    if (! $this->canAccessProgres($allMateri, $idProgresKelas)) {
        throw new RuntimeException('Materi belum dapat diakses', 403);
    }

    if ($waktuBelajarDetik > 0) {
        $progresKelas->waktu_belajar_detik = $waktuBelajarDetik;
    }
    
    if ($posisiVideoTerakhir > 0) {
        $progresKelas->posisi_video_terakhir = $posisiVideoTerakhir;
    }

    if ($selesai) {
        $progresKelas->selesai = true;
        $progresKelas->selesai_pada = now();
    }

    $progresKelas->save();

    $ringkasan = $this->refreshPendaftaranProgress($pendaftaran);

    return [
        'message' => 'Progres diperbarui',
        'ringkasan' => $ringkasan,
    ];
}

    public function submitJawabanKuis(Pendaftaran $pendaftaran, string $idProgresKelas, array $jawabanInput, bool $otomatisKarenaWaktuHabis = false): array
    {
        $allMateri = $this->getOrderedMateri($pendaftaran->id_pendaftaran);
        $progresKelas = $allMateri->firstWhere('id_progres_kelas', $idProgresKelas);
        $progresKelasModel = ProgresKelas::where('id_progres_kelas', $idProgresKelas)
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->first();

        if (! $progresKelas || ! $progresKelasModel) {
            throw new RuntimeException('Materi ini bukan kuis', 400);
        }

        $punyaKuis = ProgresKuis::query()
            ->where('id_progres_kelas', $progresKelas->id_progres_kelas)
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->exists();

        if ($progresKelas->tipe !== 'kuis' && ! $punyaKuis) {
            throw new RuntimeException('Materi ini tidak memiliki kuis', 400);
        }

        if ($progresKelas->tipe !== 'kuis' && ! (bool) $progresKelasModel->selesai) {
            throw new RuntimeException('Selesaikan materi terlebih dahulu sebelum mengerjakan kuis.', 403);
        }

        if (! $this->canAccessProgres($allMateri, $idProgresKelas)) {
            throw new RuntimeException('Kuis belum dapat diakses', 403);
        }

        $progresKuis = ProgresKuis::where('id_progres_kelas', $progresKelas->id_progres_kelas)
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->first();

        if (! $progresKuis) {
            throw new RuntimeException('Data kuis tidak ditemukan', 404);
        }

        if (! $otomatisKarenaWaktuHabis) {
            $rateKey = sprintf('quiz-submit:%s:%s', $progresKuis->id_progres_kuis, $pendaftaran->id_pendaftaran);
            if (RateLimiter::tooManyAttempts($rateKey, 5)) {
                $seconds = RateLimiter::availableIn($rateKey);
                throw new RuntimeException('Terlalu sering mengirim jawaban. Coba lagi dalam '.$seconds.' detik.', 429);
            }
            RateLimiter::hit($rateKey, 60);
        }

        $existingAttempts = ProgresKuisHistori::where('id_progres_kuis', $progresKuis->id_progres_kuis)->count();

        if ($existingAttempts >= self::MAKS_PERCOBAAN_KUIS) {
            $kuisMeta = $this->buildKuisProgressMeta($progresKuis);

            return [
                'error' => 'Batas percobaan kuis sudah tercapai ('.self::MAKS_PERCOBAAN_KUIS.'x). Ambil nilai terbaik yang sudah ada.',
                'status' => $kuisMeta['status'],
                'riwayat' => $kuisMeta['riwayat'],
                'code' => 422,
            ];
        }

        $kuis = Kuis::where('id_kuis', $progresKuis->id_kuis)
            ->select('id_kuis', 'nilai_lulus', 'durasi_menit')
            ->first();

        if (! $kuis) {
            throw new RuntimeException('Kuis tidak ditemukan', 404);
        }

        $percobaanKe = $existingAttempts + 1;
        $timerMeta = $this->getQuizTimerMeta($progresKuis, $kuis, $percobaanKe, false);

        if ((int) ($timerMeta['durasi_detik'] ?? 0) > 0 && ! (bool) ($timerMeta['timer_sudah_mulai'] ?? false)) {
            throw new RuntimeException('Timer kuis belum dimulai. Silakan klik tombol Mulai Kuis terlebih dahulu.', 422);
        }

        $waktuHabis = (bool) ($timerMeta['waktu_habis'] ?? false);

        $soalList = Soal::where('id_kuis', $progresKuis->id_kuis)
            ->select('id_soal', 'nilai')
            ->get()
            ->keyBy('id_soal');

        if ($soalList->isEmpty()) {
            throw new RuntimeException('Soal kuis kosong', 422);
        }

        $totalSoalKuis = $soalList->count();
        $soalIdsKuis = $soalList->keys();

        $jawabanCollection = collect($jawabanInput)
            ->filter(fn ($item) => is_array($item))
            ->map(function ($item) {
                return [
                    'id_soal' => isset($item['id_soal']) ? (int) $item['id_soal'] : null,
                    'id_soal_jawaban' => isset($item['id_soal_jawaban']) && $item['id_soal_jawaban'] !== ''
                        ? (int) $item['id_soal_jawaban']
                        : null,
                ];
            })
            ->filter(fn ($item) => ! empty($item['id_soal']) && ! empty($item['id_soal_jawaban']))
            ->values();

        $submittedSoalIds = $jawabanCollection->pluck('id_soal');

        $duplicateSoal = $submittedSoalIds->count() !== $submittedSoalIds->unique()->count();
        if ($duplicateSoal) {
            throw new RuntimeException('Duplikasi jawaban terdeteksi. Kirim satu jawaban per soal.', 422);
        }

        $unknownSoal = $submittedSoalIds->diff($soalIdsKuis);
        if ($unknownSoal->isNotEmpty()) {
            throw new RuntimeException('Soal tidak valid untuk kuis ini.', 422);
        }

        $jawabanBySoal = $jawabanCollection
            ->keyBy('id_soal')
            ->map(fn ($item) => $item['id_soal_jawaban']);

        $jawabanIds = $jawabanCollection->pluck('id_soal_jawaban')->unique()->values();
        $jawabanList = $jawabanIds->isNotEmpty()
            ? SoalJawaban::whereIn('id_soal_jawaban', $jawabanIds)->get()->keyBy('id_soal_jawaban')
            : collect();

        $rows = [];
        $totalPoinMaks = (int) $soalList->sum('nilai');
        $totalPoin = 0;
        $jawabanBenar = 0;
        $totalTerjawab = 0;

        foreach ($soalList as $soalId => $soal) {
            $soalId = (int) $soalId;
            $jawabId = $jawabanBySoal->get($soalId);
            $jawab = $jawabId ? $jawabanList->get($jawabId) : null;

            if ($jawabId && (! $jawab || (int) $jawab->id_soal !== $soalId)) {
                throw new RuntimeException('Jawaban tidak valid', 422);
            }

            $benar = $jawab ? (bool) $jawab->benar : false;
            $poin = $benar ? (int) $soal->nilai : 0;

            if ($jawabId) {
                $totalTerjawab++;
            }

            if ($benar) {
                $jawabanBenar++;
                $totalPoin += $poin;
            }

            $rows[] = [
                'id_progres_kuis' => $progresKuis->id_progres_kuis,
                'id_soal' => $soalId,
                'id_soal_jawaban' => $jawabId ?: null,
                'benar' => $benar,
                'poin_diperoleh' => $poin,
            ];
        }

        DB::transaction(function () use ($rows, $progresKuis, $progresKelas, $progresKelasModel, $totalPoin, $totalPoinMaks, $jawabanBenar, $kuis, $pendaftaran, $percobaanKe, $totalSoalKuis) {
            ProgresJawaban::upsert($rows, ['id_progres_kuis', 'id_soal'], ['id_soal_jawaban', 'benar', 'poin_diperoleh']);

            $nilaiBaru = $totalPoinMaks > 0 ? round(($totalPoin / $totalPoinMaks) * 100, 2) : 0;
            $nilaiTertinggi = max((float) $progresKuis->nilai, $nilaiBaru);
            $nilaiLulus = (int) $kuis->nilai_lulus;
            $lulusPercobaanIni = $nilaiBaru >= $nilaiLulus;
            $lulusBerdasarkanNilaiTertinggi = $nilaiTertinggi >= $nilaiLulus;

            ProgresKuisHistori::create([
                'id_progres_kuis' => $progresKuis->id_progres_kuis,
                'percobaan_ke' => $percobaanKe,
                'nilai' => $nilaiBaru,
                'total_soal' => $totalSoalKuis,
                'jawaban_benar' => $jawabanBenar,
                'lulus' => $lulusPercobaanIni,
                'diserahkan_pada' => now(),
            ]);

            $progresKuis->total_soal = max((int) $progresKuis->total_soal, $totalSoalKuis);
            $progresKuis->jawaban_benar = max((int) $progresKuis->jawaban_benar, $jawabanBenar);
            $progresKuis->nilai = $nilaiTertinggi;
            $progresKuis->lulus = $lulusBerdasarkanNilaiTertinggi;
            $progresKuis->diserahkan_pada = now();
            $progresKuis->save();

            if (($progresKelas->tipe ?? null) === 'kuis') {
                $progresKelasModel->selesai = $lulusBerdasarkanNilaiTertinggi;
                $progresKelasModel->selesai_pada = $lulusBerdasarkanNilaiTertinggi
                    ? ($progresKelasModel->selesai_pada ?: now())
                    : null;
            } else {
                if ($lulusBerdasarkanNilaiTertinggi) {
                    $progresKelasModel->selesai = true;
                    $progresKelasModel->selesai_pada = $progresKelasModel->selesai_pada ?: now();
                } else {
                    // Kuis menempel pada materi. Jika gagal, materi dibuat belum selesai lagi
                    // supaya peserta wajib mempelajari materi ulang sebelum percobaan berikutnya.
                    $progresKelasModel->selesai = false;
                    $progresKelasModel->selesai_pada = null;
                }
            }

            $progresKelasModel->save();

            $this->refreshPendaftaranProgress($pendaftaran);
        });

        $this->forgetQuizTimer($progresKuis, $percobaanKe);
        $progresKuis->refresh();

        $navigation = $this->getNavigasiSet($allMateri, $idProgresKelas);
        $kuisProgressMeta = $this->buildKuisProgressMeta($progresKuis);

        $lulus = (bool) $progresKuis->lulus;
        $percobaanTerkunci = (bool) ($kuisProgressMeta['status']['terkunci'] ?? false);

        if (! $lulus) {
            $kuisProgressMeta['status']['ulang_materi'] = true;
            $kuisProgressMeta['status']['tampilkan_koreksi'] = false;
        } else {
            $kuisProgressMeta['status']['ulang_materi'] = false;
            $kuisProgressMeta['status']['tampilkan_koreksi'] = true;
        }

        $kuisProgressMeta['status']['waktu_habis'] = $waktuHabis;
        $kuisProgressMeta['status']['sisa_detik'] = 0;
        $kuisProgressMeta['status']['terjawab'] = $totalTerjawab;

        $message = $lulus
            ? 'Jawaban kuis disimpan. Selamat, nilai Anda sudah memenuhi batas kelulusan. Silakan lihat koreksi jawaban.'
            : 'Jawaban kuis disimpan. Nilai Anda belum memenuhi batas kelulusan. Silakan pelajari materi lagi sebelum mengulang kuis.';

        if ($waktuHabis || $otomatisKarenaWaktuHabis) {
            $message = $lulus
                ? 'Waktu kuis habis. Jawaban yang sudah terisi berhasil dikirim dan nilai Anda sudah memenuhi batas kelulusan.'
                : 'Waktu kuis habis. Jawaban yang sudah terisi berhasil dikirim dan nilai Anda belum memenuhi batas kelulusan.';
        }

        if (! $lulus && $percobaanTerkunci) {
            $message = $waktuHabis || $otomatisKarenaWaktuHabis
                ? 'Waktu kuis habis. Jawaban yang sudah terisi berhasil dikirim, namun nilai belum lulus dan batas percobaan sudah tercapai.'
                : 'Jawaban kuis disimpan. Nilai Anda belum memenuhi batas kelulusan dan batas percobaan sudah tercapai.';
        }

        return [
            'message' => $message,
            'hasil' => [
                'nilai' => $progresKuis->nilai,
                'total_soal' => $totalSoalKuis,
                'jawaban_benar' => $jawabanBenar,
                'terjawab' => $totalTerjawab,
                'lulus' => $lulus,
                'percobaan_ke' => $percobaanKe,
                'waktu_habis' => $waktuHabis || $otomatisKarenaWaktuHabis,
            ],
            'navigasi' => $navigation,
            'status' => $kuisProgressMeta['status'],
            'riwayat' => $kuisProgressMeta['riwayat'],
        ];
    }

    public function mulaiTimerKuis(Pendaftaran $pendaftaran, string $idProgresKelas): array
    {
        $allMateri = $this->getOrderedMateri($pendaftaran->id_pendaftaran);
        $progresKelas = $allMateri->firstWhere('id_progres_kelas', $idProgresKelas);
        $progresKelasModel = ProgresKelas::where('id_progres_kelas', $idProgresKelas)
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->first();

        if (! $progresKelas || ! $progresKelasModel) {
            throw new RuntimeException('Materi ini bukan kuis', 400);
        }

        $punyaKuis = ProgresKuis::query()
            ->where('id_progres_kelas', $progresKelas->id_progres_kelas)
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->exists();

        if ($progresKelas->tipe !== 'kuis' && ! $punyaKuis) {
            throw new RuntimeException('Materi ini tidak memiliki kuis', 400);
        }

        if ($progresKelas->tipe !== 'kuis' && ! (bool) $progresKelasModel->selesai) {
            throw new RuntimeException('Selesaikan materi terlebih dahulu sebelum mengerjakan kuis.', 403);
        }

        if (! $this->canAccessProgres($allMateri, $idProgresKelas)) {
            throw new RuntimeException('Kuis belum dapat diakses', 403);
        }

        $progresKuis = ProgresKuis::where('id_progres_kelas', $progresKelas->id_progres_kelas)
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->first();

        if (! $progresKuis) {
            throw new RuntimeException('Data kuis tidak ditemukan', 404);
        }

        $kuisProgressMeta = $this->buildKuisProgressMeta($progresKuis);
        $status = $kuisProgressMeta['status'] ?? [];

        if ((bool) ($status['lulus'] ?? false)) {
            throw new RuntimeException('Kuis sudah lulus. Timer tidak perlu dimulai lagi.', 422);
        }

        if ((bool) ($status['terkunci'] ?? false)) {
            throw new RuntimeException('Kuis sudah terkunci karena batas percobaan tercapai.', 422);
        }

        $existingAttempts = ProgresKuisHistori::where('id_progres_kuis', $progresKuis->id_progres_kuis)->count();

        if ($existingAttempts >= self::MAKS_PERCOBAAN_KUIS) {
            throw new RuntimeException('Batas percobaan kuis sudah tercapai ('.self::MAKS_PERCOBAAN_KUIS.'x).', 422);
        }

        $kuis = Kuis::where('id_kuis', $progresKuis->id_kuis)
            ->select('id_kuis', 'nilai_lulus', 'durasi_menit')
            ->first();

        if (! $kuis) {
            throw new RuntimeException('Kuis tidak ditemukan', 404);
        }

        $percobaanKe = $existingAttempts + 1;
        $timerMeta = $this->getQuizTimerMeta($progresKuis, $kuis, $percobaanKe, true);

        $kuisProgressMeta['status']['mulai_pada'] = $timerMeta['mulai_pada'];
        $kuisProgressMeta['status']['batas_waktu_pada'] = $timerMeta['batas_waktu_pada'];
        $kuisProgressMeta['status']['sisa_detik'] = $timerMeta['sisa_detik'];
        $kuisProgressMeta['status']['waktu_habis'] = $timerMeta['waktu_habis'];
        $kuisProgressMeta['status']['durasi_detik'] = $timerMeta['durasi_detik'];
        $kuisProgressMeta['status']['timer_sudah_mulai'] = $timerMeta['timer_sudah_mulai'];

        return [
            'message' => 'Timer kuis dimulai',
            'timer' => $timerMeta,
            'status' => $kuisProgressMeta['status'],
            'riwayat' => $kuisProgressMeta['riwayat'],
        ];
    }

    private function buildKuisPayload(Pendaftaran $pendaftaran, $progresKelas, Materi $materi, bool $forceQuizReview = false): array
    {
        $progresKuis = ProgresKuis::where('id_progres_kelas', $progresKelas->id_progres_kelas)
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->first();

        if (! $progresKuis) {
            throw new RuntimeException('Unauthorized', 403);
        }

        $kuis = Kuis::where('id_kuis', $progresKuis->id_kuis)
            ->where('id_materi', $materi->id_materi)
            ->select(
                'id_kuis',
                'judul',
                'deskripsi',
                'instruksi',
                'durasi_menit',
                'acak_soal',
                'acak_jawaban',
                'tampilkan_jawaban_benar',
                'tipe',
                'nilai_lulus'
            )
            ->first();

        if (! $kuis) {
            throw new RuntimeException('Kuis tidak ditemukan', 404);
        }

        $kuisProgressMeta = $this->buildKuisProgressMeta($progresKuis);
        $sudahLulus = (bool) $progresKuis->lulus;
        $terkunci = (bool) ($kuisProgressMeta['status']['terkunci'] ?? false);

        $timerMeta = null;
        if (! $sudahLulus && ! $terkunci) {
            $percobaanBerikutnya = ((int) ($kuisProgressMeta['status']['total_percobaan'] ?? 0)) + 1;
            $timerMeta = $this->getQuizTimerMeta($progresKuis, $kuis, $percobaanBerikutnya, false);

            $kuisProgressMeta['status']['mulai_pada'] = $timerMeta['mulai_pada'];
            $kuisProgressMeta['status']['batas_waktu_pada'] = $timerMeta['batas_waktu_pada'];
            $kuisProgressMeta['status']['sisa_detik'] = $timerMeta['sisa_detik'];
            $kuisProgressMeta['status']['waktu_habis'] = $timerMeta['waktu_habis'];
            $kuisProgressMeta['status']['durasi_detik'] = $timerMeta['durasi_detik'];
            $kuisProgressMeta['status']['timer_sudah_mulai'] = $timerMeta['timer_sudah_mulai'];
        }

        // Koreksi/kunci jawaban hanya boleh tampil jika peserta sudah lulus.
        // Peserta yang gagal harus kembali ke materi tanpa melihat jawaban benar.
        $modeReview = $sudahLulus;

        $progresJawaban = ProgresJawaban::where('id_progres_kuis', $progresKuis->id_progres_kuis)
            ->get()
            ->keyBy('id_soal');

        $listSoal = Soal::where('id_kuis', $kuis->id_kuis)
            ->select('id_soal', 'teks_soal', 'gambar_soal', 'penjelasan')
            ->get();

        if (! $modeReview && (int) $kuis->acak_soal === 1) {
            $listSoal = $listSoal->shuffle()->values();
        }

        $soalIds = $listSoal->pluck('id_soal');
        $jawabanPerSoal = SoalJawaban::whereIn('id_soal', $soalIds)
            ->select('id_soal_jawaban', 'id_soal', 'teks_jawaban', 'benar')
            ->get()
            ->groupBy('id_soal');

        $soalDenganJawaban = $listSoal->map(function ($s) use ($kuis, $jawabanPerSoal, $progresJawaban, $modeReview) {
            $opsi = $jawabanPerSoal->get($s->id_soal, collect());

            if (! $modeReview && (int) $kuis->acak_jawaban === 1) {
                $opsi = $opsi->shuffle()->values();
            }

            $pjRaw = $progresJawaban->get($s->id_soal);
            $pj = $pjRaw && ! is_null($pjRaw->id_soal_jawaban) ? $pjRaw : null;
            $jawabanBenar = $opsi->first(fn ($j) => (bool) $j->benar);

            $opsiArr = $opsi->map(function ($j) use ($modeReview, $pj) {
                $item = [
                    'id_soal_jawaban' => $j->id_soal_jawaban,
                    'teks_jawaban' => $j->teks_jawaban,
                ];

                if ($modeReview) {
                    $item['benar'] = (bool) $j->benar;
                    $item['dipilih_pengguna'] = $pj
                        ? (int) $pj->id_soal_jawaban === (int) $j->id_soal_jawaban
                        : false;
                }

                return $item;
            })->values();

            return [
                'id_soal' => $s->id_soal,
                'teks_soal' => $s->teks_soal,
                'gambar_soal' => $s->gambar_soal,
                'penjelasan' => $modeReview ? $s->penjelasan : null,
                'jawaban' => $opsiArr,
                'review' => $modeReview,
                'jawaban_benar_id' => $modeReview && $jawabanBenar ? $jawabanBenar->id_soal_jawaban : null,
                'progres' => $pj ? [
                    'id_progres_jawaban' => $pj->id_progres_jawaban,
                    'id_soal_jawaban' => $pj->id_soal_jawaban,
                    'benar' => (bool) $pj->benar,
                    'poin_diperoleh' => (int) $pj->poin_diperoleh,
                ] : null,
            ];
        })->values();

        return [
            'materi' => $materi,
            'kuis' => [
                'id_progres_kuis' => $progresKuis->id_progres_kuis,
                'mode_review' => $modeReview,
                'meta' => [
                    'id_kuis' => $kuis->id_kuis,
                    'judul' => $kuis->judul,
                    'deskripsi' => $kuis->deskripsi,
                    'instruksi' => $kuis->instruksi,
                    'durasi_menit' => $kuis->durasi_menit,
                    'tipe' => $kuis->tipe,
                    'nilai_lulus' => $kuis->nilai_lulus,
                    'acak_soal' => (int) $kuis->acak_soal,
                    'acak_jawaban' => (int) $kuis->acak_jawaban,
                    'tampilkan_jawaban_benar' => (int) $kuis->tampilkan_jawaban_benar,
                ],
                'soal' => $soalDenganJawaban,
                'status' => $kuisProgressMeta['status'],
                'riwayat' => $kuisProgressMeta['riwayat'],
            ],
        ];
    }

    private function buildKuisProgressMeta(ProgresKuis $progresKuis): array
    {
        $riwayatCollection = ProgresKuisHistori::where('id_progres_kuis', $progresKuis->id_progres_kuis)
            ->orderBy('percobaan_ke')
            ->get();

        $riwayat = $riwayatCollection->map(function ($row) {
            return [
                'id_progres_kuis_histori' => $row->id_progres_kuis_histori,
                'percobaan_ke' => $row->percobaan_ke,
                'nilai' => (float) $row->nilai,
                'total_soal' => $row->total_soal,
                'jawaban_benar' => $row->jawaban_benar,
                'lulus' => (bool) $row->lulus,
                'diserahkan_pada' => optional($row->diserahkan_pada)->format('Y-m-d H:i:s'),
                'dibuat_pada' => optional($row->created_at)->format('Y-m-d H:i:s'),
            ];
        });

        $totalPercobaan = $riwayatCollection->count();
        $nilaiTertinggi = max((float) ($riwayatCollection->max('nilai') ?? 0), (float) ($progresKuis->nilai ?? 0));
        $riwayatValues = $riwayat->values();
        $lulus = (bool) $progresKuis->lulus;
        $batasPercobaanTercapai = $totalPercobaan >= self::MAKS_PERCOBAAN_KUIS;
        $terkunci = $lulus || $batasPercobaanTercapai;

        return [
            'riwayat' => $riwayatValues->toArray(),
            'status' => [
                'maksimal_percobaan' => self::MAKS_PERCOBAAN_KUIS,
                'total_percobaan' => $totalPercobaan,
                'percobaan_sisa' => max(self::MAKS_PERCOBAAN_KUIS - $totalPercobaan, 0),
                'nilai_tertinggi' => $nilaiTertinggi,
                'lulus' => $lulus,
                'terkunci' => $terkunci,
                'boleh_mengulang' => ! $terkunci,
                'ulang_materi' => ! $lulus && ! $terkunci,
                'tampilkan_koreksi' => $lulus,
                'percobaan_terakhir' => $riwayatValues->last(),
            ],
        ];
    }

    private function getQuizTimerMeta(ProgresKuis $progresKuis, Kuis $kuis, int $percobaanKe, bool $startIfMissing = false): array
    {
        $durasiMenit = max((int) ($kuis->durasi_menit ?? 0), 0);
        $durasiDetik = $durasiMenit * 60;

        if ($durasiDetik <= 0) {
            return [
                'mulai_pada' => null,
                'batas_waktu_pada' => null,
                'sisa_detik' => null,
                'waktu_habis' => false,
                'durasi_detik' => 0,
                'timer_sudah_mulai' => false,
            ];
        }

        $cacheKey = $this->getQuizTimerCacheKey($progresKuis, $percobaanKe);
        $startedAtRaw = Cache::get($cacheKey);

        if (! $startedAtRaw && $startIfMissing) {
            $startedAtRaw = now()->toDateTimeString();
            Cache::put($cacheKey, $startedAtRaw, now()->addDays(self::QUIZ_TIMER_CACHE_DAYS));
        }

        if (! $startedAtRaw) {
            return [
                'mulai_pada' => null,
                'batas_waktu_pada' => null,
                'sisa_detik' => $durasiDetik,
                'waktu_habis' => false,
                'durasi_detik' => $durasiDetik,
                'timer_sudah_mulai' => false,
            ];
        }

        $startedAt = Carbon::parse($startedAtRaw);
        $deadline = $startedAt->copy()->addSeconds($durasiDetik);
        $remainingSeconds = max($deadline->getTimestamp() - now()->getTimestamp(), 0);

        return [
            'mulai_pada' => $startedAt->format('Y-m-d H:i:s'),
            'batas_waktu_pada' => $deadline->format('Y-m-d H:i:s'),
            'sisa_detik' => $remainingSeconds,
            'waktu_habis' => $remainingSeconds <= 0,
            'durasi_detik' => $durasiDetik,
            'timer_sudah_mulai' => true,
        ];
    }

    private function getQuizTimerCacheKey(ProgresKuis $progresKuis, int $percobaanKe): string
    {
        return self::QUIZ_TIMER_CACHE_PREFIX.':'.$progresKuis->id_progres_kuis.':attempt:'.$percobaanKe;
    }

    private function forgetQuizTimer(ProgresKuis $progresKuis, int $percobaanKe): void
    {
        Cache::forget($this->getQuizTimerCacheKey($progresKuis, $percobaanKe));
    }

    public function refreshPendaftaranProgress(Pendaftaran $pendaftaran): array
    {
        $this->progresKelasService->syncProgresForPendaftaran($pendaftaran);

        $allMateri = $this->getOrderedMateri($pendaftaran->id_pendaftaran);
        $totalMateri = $allMateri->count();
        $materiSelesai = $allMateri
            ->filter(fn ($m) => $this->isProgressUnitComplete($m))
            ->count();

        $persentase = $totalMateri > 0
            ? round(($materiSelesai / $totalMateri) * 100, 2)
            : 0;

        $pendaftaran->persentase_progres = $persentase;
        $pendaftaran->terakhir_akses = now();

        if ($totalMateri > 0 && $materiSelesai === $totalMateri) {
            $pendaftaran->status = 'selesai';
            $pendaftaran->selesai_pada = $pendaftaran->selesai_pada ?: now();
        } elseif ($pendaftaran->status === 'selesai') {
            $pendaftaran->status = 'aktif';
            $pendaftaran->selesai_pada = null;
        }

        $pendaftaran->save();

        return [
            'total_materi' => $totalMateri,
            'materi_selesai' => $materiSelesai,
            'persentase' => $persentase,
            'status' => $pendaftaran->status,
            'selesai_pada' => $pendaftaran->selesai_pada,
            'terakhir_akses' => $pendaftaran->terakhir_akses,
        ];
    }

    private function cekAksesByIndex(Collection $allMateri, int $index, int $currentIndex): bool
    {
        $row = $allMateri[$index];

        // Materi yang sudah selesai harus tetap bisa dibuka ulang untuk belajar kembali.
        if ($this->isProgressUnitComplete($row)) {
            return true;
        }

        // Jika seluruh unit kelas sudah selesai, semua materi boleh dibuka ulang.
        if ($this->allProgressUnitsComplete($allMateri)) {
            return true;
        }

        // Unit saat ini tetap bisa dibuka sesuai aturan urutan.
        if ($index === $currentIndex) {
            if (($row->tipe_tampilan ?? $row->tipe) === 'kuis') {
                return $this->cekKuisBisaDiakses($allMateri, $row);
            }

            return true;
        }

        return false;
    }

    private function cekKuisBisaDiakses(Collection $allMateri, $kuisRow): bool
    {
        if (! (bool) ($kuisRow->punya_kuis ?? false) && $kuisRow->tipe !== 'kuis') {
            return false;
        }

        if ($kuisRow->tipe !== 'kuis' && ! (bool) ($kuisRow->selesai ?? false)) {
            return false;
        }

        return $allMateri
            ->where('id_bagian_kelas', $kuisRow->id_bagian_kelas)
            ->filter(fn ($m) => (string) $m->id_progres_kelas !== (string) $kuisRow->id_progres_kelas)
            ->every(fn ($m) => $this->isProgressUnitComplete($m) || $m->urutan_materi >= $kuisRow->urutan_materi);
    }

    private function formatMateri($row): array
    {
        return [
            'id_progres_kelas' => $row->id_progres_kelas,
            'judul' => $row->materi_judul,
            'tipe' => $row->tipe_tampilan ?? $row->tipe,
            'tipe_asli' => $row->tipe,
            'bagian' => $row->bagian_judul,
            'bagian_urutan' => $row->bagian_urutan,
            'urutan' => $row->urutan_materi,
            'selesai' => $this->isProgressUnitComplete($row),
            'materi_selesai' => (bool) $row->selesai,
            'punya_kuis' => (bool) ($row->punya_kuis ?? false),
            'kuis_selesai' => (bool) ($row->kuis_selesai ?? false),
            'kuis_sudah_submit' => (bool) ($row->kuis_sudah_submit ?? false),
            'kuis_pending' => (bool) ($row->kuis_pending ?? false),
            'selesai_pada' => $row->selesai_pada,
        ];
    }

    private function canAccessProgres(Collection $allMateri, string $targetProgresId): bool
    {
        $allMateri = $allMateri->values();
        if ($allMateri->isEmpty()) {
            return false;
        }

        $currentIndex = $allMateri->search(fn ($m) => ! $this->isProgressUnitComplete($m));
        if ($currentIndex === false) {
            $currentIndex = $allMateri->count() - 1;
        }

        foreach ($allMateri as $index => $row) {
            if ((string) $row->id_progres_kelas !== (string) $targetProgresId) {
                continue;
            }

            // Setelah materi/unit selesai, pengguna boleh membuka ulang materi untuk belajar kembali.
            if ($this->isProgressUnitComplete($row)) {
                return true;
            }

            // Setelah kelas selesai, semua materi boleh diakses ulang.
            // Kuis tetap dikunci oleh buildKuisPayload()/submitJawabanKuis() karena percobaan maksimal 1x.
            if ($this->allProgressUnitsComplete($allMateri)) {
                return true;
            }

            if ($index === $currentIndex) {
                if (($row->tipe_tampilan ?? $row->tipe) === 'kuis') {
                    return $this->cekKuisBisaDiakses($allMateri, $row);
                }

                return true;
            }

            return false;
        }

        return false;
    }

    private function getNavigasiSet(Collection $allMateri, string $currentId): array
    {
        $list = $allMateri->values();
        $idx = $list->search(fn ($m) => (string) $m->id_progres_kelas === (string) $currentId);
        $next = ($idx !== false && $idx < $list->count() - 1) ? $list->get($idx + 1) : null;
        $prev = ($idx !== false && $idx > 0) ? $list->get($idx - 1) : null;

        return [
            'materi_sebelumnya' => $prev ? [
                'id_progres_kelas' => $prev->id_progres_kelas,
                'judul' => $prev->materi_judul,
                'tipe' => $prev->tipe_tampilan ?? $prev->tipe,
                'tipe_asli' => $prev->tipe,
                'bisa_diakses' => $this->canAccessProgres($list, $prev->id_progres_kelas),
            ] : null,
            'materi_selanjutnya' => $next ? [
                'id_progres_kelas' => $next->id_progres_kelas,
                'judul' => $next->materi_judul,
                'tipe' => $next->tipe_tampilan ?? $next->tipe,
                'tipe_asli' => $next->tipe,
                'bisa_diakses' => $this->canAccessProgres($list, $next->id_progres_kelas),
            ] : null,
        ];
    }

    private function isProgressUnitComplete($row): bool
    {
        if (isset($row->unit_selesai)) {
            return (bool) $row->unit_selesai;
        }

        return (bool) ($row->selesai ?? false);
    }

    private function shouldDisplayQuizPayload(Pendaftaran $pendaftaran, $progresKelas, Materi $materi, bool $forceQuizReview = false): bool
    {
        // Materi yang memang bertipe kuis harus selalu masuk payload kuis.
        // Kalau sudah pernah submit, buildKuisPayload() otomatis mengunci menjadi mode review.
        if ($materi->tipe === 'kuis') {
            return true;
        }

        // Kuis yang menempel pada video/artikel hanya boleh muncul setelah materi utama selesai.
        if (! (bool) ($progresKelas->selesai ?? false)) {
            return false;
        }

        $progresKuis = ProgresKuis::query()
            ->join('kuis', 'kuis.id_kuis', '=', 'progres_kuis.id_kuis')
            ->where('progres_kuis.id_progres_kelas', $progresKelas->id_progres_kelas)
            ->where('progres_kuis.id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->where('kuis.id_materi', $materi->id_materi)
            ->where('kuis.aktif', 1)
            ->select('progres_kuis.*')
            ->first();

        if (! $progresKuis) {
            return false;
        }

        $sudahSubmit = $this->isKuisAlreadySubmitted($progresKuis);
        $kuisProgressMeta = $this->buildKuisProgressMeta($progresKuis);
        $sudahLulus = (bool) $progresKuis->lulus;
        $bolehMengulang = (bool) ($kuisProgressMeta['status']['boleh_mengulang'] ?? false);

        // Mode khusus setelah submit: koreksi jawaban hanya boleh dibuka jika kuis sudah lulus.
        // Jika belum lulus, peserta dikembalikan ke materi utama untuk belajar ulang.
        if ($forceQuizReview && $sudahSubmit) {
            return $sudahLulus;
        }

        // Jika sudah lulus, tampilkan materi utama saat dibuka ulang biasa.
        if ($sudahLulus) {
            return false;
        }

        // Normal akses:
        // - Jika kuis belum submit, tampilkan kuis agar bisa dikerjakan.
        // - Jika kuis sudah submit tapi belum lulus dan masih ada percobaan, tampilkan kuis lagi.
        // - Jika sudah submit, belum lulus, dan percobaan habis, tampilkan materi/review sesuai request frontend.
        return ! $sudahSubmit || $bolehMengulang;
    }

    private function allProgressUnitsComplete(Collection $allMateri): bool
    {
        $allMateri = $allMateri->values();

        return $allMateri->isNotEmpty()
            && $allMateri->every(fn ($m) => $this->isProgressUnitComplete($m));
    }

    private function isKuisAlreadySubmitted(ProgresKuis $progresKuis): bool
    {
        if (! empty($progresKuis->diserahkan_pada)) {
            return true;
        }

        return ProgresKuisHistori::where('id_progres_kuis', $progresKuis->id_progres_kuis)->exists();
    }

    private function getOrderedMateri(string $pendaftaranId): Collection
    {
        $rows = ProgresKelas::query()
            ->join('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'progres_kelas.id_bagian_kelas')
            ->join('materi', 'materi.id_materi', '=', 'progres_kelas.id_materi')
            ->where('progres_kelas.id_pendaftaran', $pendaftaranId)
            ->select([
                'progres_kelas.*',
                'bagian_kelas.judul as bagian_judul',
                'bagian_kelas.urutan as bagian_urutan',
                'materi.judul as materi_judul',
                'materi.tipe',
            ])
            ->orderBy('progres_kelas.urutan_bagian_kelas')
            ->orderBy('progres_kelas.urutan_materi')
            ->get();

        if ($rows->isEmpty()) {
            return $rows;
        }

        $progresIds = $rows->pluck('id_progres_kelas')->filter()->values();

        $kuisByProgres = ProgresKuis::query()
            ->join('kuis', 'kuis.id_kuis', '=', 'progres_kuis.id_kuis')
            ->whereIn('progres_kuis.id_progres_kelas', $progresIds)
            ->where('progres_kuis.id_pendaftaran', $pendaftaranId)
            ->where('kuis.aktif', 1)
            ->select([
                'progres_kuis.id_progres_kuis',
                'progres_kuis.id_progres_kelas',
                'progres_kuis.id_pendaftaran',
                'progres_kuis.id_kuis',
                'progres_kuis.nilai',
                'progres_kuis.total_soal',
                'progres_kuis.jawaban_benar',
                'progres_kuis.lulus',
                'progres_kuis.diserahkan_pada',
                'kuis.judul as kuis_judul',
            ])
            ->orderBy('progres_kuis.id_progres_kuis')
            ->get()
            ->groupBy('id_progres_kelas');

        return $rows->map(function ($row) use ($kuisByProgres) {
            $kuisItems = $kuisByProgres->get($row->id_progres_kelas, collect());
            $punyaKuis = $kuisItems->isNotEmpty();

            $kuisSudahSubmit = $punyaKuis
                ? $kuisItems->every(fn ($kuis) => $this->isKuisAlreadySubmitted($kuis))
                : false;

            $kuisSelesai = $punyaKuis
                ? $kuisItems->every(fn ($kuis) => (bool) $kuis->lulus)
                : true;

            $row->punya_kuis = $punyaKuis;
            $row->kuis_sudah_submit = $kuisSudahSubmit;
            $row->kuis_selesai = $kuisSelesai;
            $row->kuis_pending = $punyaKuis && ! $kuisSelesai;
            $row->unit_selesai = (bool) $row->selesai && (! $punyaKuis || $kuisSelesai);
            $row->tipe_tampilan = (((bool) $row->selesai && $punyaKuis && ! $kuisSelesai) || $row->tipe === 'kuis')
                ? 'kuis'
                : $row->tipe;

            return $row;
        });
    }
}