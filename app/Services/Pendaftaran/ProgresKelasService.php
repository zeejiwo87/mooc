<?php

namespace App\Services\Pendaftaran;

use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Materi;
use App\Models\Pendaftaran;
use App\Models\ProgresJawaban;
use App\Models\ProgresKelas;
use App\Models\ProgresKuis;
use App\Models\Sertifikat;
use App\Models\Soal;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Carbon\Carbon;

final class ProgresKelasService
{
    public function getListData(string $id): Collection
    {
        $progresKelas = ProgresKelas::query()
            ->leftJoin('materi', 'materi.id_materi', '=', 'progres_kelas.id_materi')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'progres_kelas.id_bagian_kelas')
            ->select(
                'progres_kelas.id_progres_kelas',
                'progres_kelas.id_pendaftaran',
                'progres_kelas.id_materi',
                'progres_kelas.urutan_bagian_kelas',
                'progres_kelas.urutan_materi',
                'bagian_kelas.judul as bagian_judul',
                'materi.judul as materi_judul',
                'materi.tipe',
                'progres_kelas.selesai',
                'progres_kelas.selesai_pada'
            )
            ->where('progres_kelas.id_pendaftaran', $id)
            ->orderBy('bagian_kelas.urutan')
            ->orderBy('materi.urutan')
            ->get();

        if ($progresKelas->isEmpty()) {
            return collect([]);
        }

        $progresKelasIds = $progresKelas->pluck('id_progres_kelas');

        $progresKuisList = ProgresKuis::query()
            ->leftJoin('kuis', 'kuis.id_kuis', '=', 'progres_kuis.id_kuis')
            ->select(
                'progres_kuis.id_progres_kuis',
                'progres_kuis.id_progres_kelas',
                'progres_kuis.id_kuis',
                'kuis.judul as kuis_judul',
                'kuis.tipe as kuis_tipe',
                'progres_kuis.nilai'
            )
            ->whereIn('progres_kuis.id_progres_kelas', $progresKelasIds)
            ->get()
            ->groupBy('id_progres_kelas');

        $progresKuisIds = $progresKuisList->flatten(1)->pluck('id_progres_kuis');

        $progresJawabanList = collect([]);

        if ($progresKuisIds->isNotEmpty()) {
            $progresJawabanList = ProgresJawaban::query()
                ->leftJoin('soal', 'soal.id_soal', '=', 'progres_jawaban.id_soal')
                ->select(
                    'progres_jawaban.id_progres_jawaban',
                    'progres_jawaban.id_progres_kuis',
                    'progres_jawaban.id_soal',
                    'soal.teks_soal as soal_pertanyaan',
                    'progres_jawaban.benar',
                    'progres_jawaban.id_soal_jawaban',
                )
                ->whereIn('progres_jawaban.id_progres_kuis', $progresKuisIds)
                ->get()
                ->groupBy('id_progres_kuis');
        }

        return $progresKelas->map(function ($progres) use ($progresKuisList, $progresJawabanList) {

            $data = [
                'id_progres_kelas' => $progres->id_progres_kelas,
                'bagian_judul' => $progres->bagian_judul ?? '-',
                'urutan_bagian_kelas' => $progres->urutan_bagian_kelas ?? 0,
                'materi_judul' => $progres->materi_judul ?? '-',
                'urutan_materi' => $progres->urutan_materi ?? 0,
                'materi_tipe' => $progres->tipe,
                'selesai' => $progres->selesai,
                'selesai_pada' => $progres->selesai_pada,
                'progres_kuis' => null,
            ];

            $kuisList = $progresKuisList->get(
                $progres->id_progres_kelas,
                collect([])
            );

            if ($kuisList->isNotEmpty()) {

                $data['progres_kuis'] = $kuisList->map(function ($kuis) use ($progresJawabanList) {

                    $jawabanList = $progresJawabanList->get(
                        $kuis->id_progres_kuis,
                        collect([])
                    );

                    return [
                        'id_progres_kuis' => $kuis->id_progres_kuis,
                        'id_kuis' => $kuis->id_kuis,
                        'kuis_judul' => $kuis->kuis_judul ?? '-',
                        'kuis_tipe' => $kuis->kuis_tipe,
                        'nilai' => $kuis->nilai,
                        'total_soal' => $jawabanList->count(),
                        'soal_terjawab' => $jawabanList
                            ->whereNotNull('id_soal_jawaban')
                            ->count(),

                        'progres_jawaban' => $jawabanList->map(function ($jawaban) {

                            return [
                                'id_progres_jawaban' => $jawaban->id_progres_jawaban,
                                'id_soal' => $jawaban->id_soal,
                                'soal_pertanyaan' => $jawaban->soal_pertanyaan ?? '-',
                                'benar' => $jawaban->id_soal_jawaban == null
                                    ? null
                                    : $jawaban->benar,
                            ];
                        })->values(),
                    ];
                })->values();
            }

            return $data;
        });
    }

    public function syncProgresForPendaftaran(Pendaftaran $pendaftaran): void
    {
        $materiList = Materi::query()
            ->join('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->join('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->where('kelas.id_kelas', $pendaftaran->id_kelas)
            ->orderBy('bagian_kelas.urutan')
            ->orderBy('materi.urutan')
            ->select(
                'materi.id_materi',
                'materi.tipe',
                'materi.urutan as urutan_materi',
                'bagian_kelas.id_bagian_kelas',
                'bagian_kelas.urutan as urutan_bagian_kelas'
            )
            ->distinct()
            ->get()
            ->unique('id_materi')
            ->values();

        if ($materiList->isEmpty()) {
            return;
        }

        $existingProgresKelas = ProgresKelas::query()
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->whereIn('id_materi', $materiList->pluck('id_materi'))
            ->pluck('id_materi')
            ->toArray();

        $newMateriIds = $materiList->pluck('id_materi')
            ->diff($existingProgresKelas)
            ->values();

        if ($newMateriIds->isNotEmpty()) {

            $rowsProgresKelas = $materiList
                ->whereIn('id_materi', $newMateriIds)
                ->map(fn ($materi) => [
                    'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                    'id_materi' => $materi->id_materi,
                    'id_bagian_kelas' => $materi->id_bagian_kelas,
                    'urutan_materi' => $materi->urutan_materi,
                    'urutan_bagian_kelas' => $materi->urutan_bagian_kelas,
                ])
                ->unique(fn ($row) =>
                    $row['id_pendaftaran'].'-'.$row['id_bagian_kelas'].'-'.$row['id_materi']
                )
                ->values()
                ->all();

            ProgresKelas::insertOrIgnore($rowsProgresKelas);
        }

        $progresKelasMap = ProgresKelas::query()
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->whereIn('id_materi', $materiList->pluck('id_materi'))
            ->get([
                'id_progres_kelas',
                'id_materi',
                'id_bagian_kelas'
            ])
            ->unique('id_materi')
            ->keyBy('id_materi');

        $materiIdsUntukKuis = $materiList
            ->pluck('id_materi')
            ->unique()
            ->values();

        if ($materiIdsUntukKuis->isEmpty()) {
            return;
        }

        $kuisList = Kuis::query()
            ->whereIn('id_materi', $materiIdsUntukKuis)
            ->where('aktif', 1)
            ->select('id_kuis', 'id_materi')
            ->distinct()
            ->get()
            ->unique('id_kuis')
            ->values();

        if ($kuisList->isEmpty()) {
            return;
        }

        $existingProgresKuis = ProgresKuis::query()
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->whereIn('id_kuis', $kuisList->pluck('id_kuis'))
            ->pluck('id_kuis')
            ->toArray();

        $newKuisIds = $kuisList->pluck('id_kuis')
            ->diff($existingProgresKuis)
            ->values();

        $jumlahSoalByKuis = Soal::query()
            ->whereIn('id_kuis', $kuisList->pluck('id_kuis'))
            ->selectRaw('id_kuis, COUNT(*) as total_soal')
            ->groupBy('id_kuis')
            ->pluck('total_soal', 'id_kuis');

        if ($newKuisIds->isNotEmpty()) {

            $rowsProgresKuis = $kuisList
                ->whereIn('id_kuis', $newKuisIds)
                ->map(function ($kuis) use ($pendaftaran, $progresKelasMap, $jumlahSoalByKuis) {

                    $progresKelas = $progresKelasMap->get($kuis->id_materi);

                    if (! $progresKelas) {
                        return null;
                    }

                    return [
                        'id_progres_kelas' => $progresKelas->id_progres_kelas,
                        'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                        'id_kuis' => $kuis->id_kuis,
                        'total_soal' => (int) ($jumlahSoalByKuis->get($kuis->id_kuis, 0)),
                        'jawaban_benar' => 0,
                        'nilai' => 0,
                        'lulus' => 0,
                    ];
                })
                ->filter()
                ->unique(fn ($row) =>
                    $row['id_pendaftaran'].'-'.$row['id_kuis']
                )
                ->values()
                ->all();

            if (! empty($rowsProgresKuis)) {
                ProgresKuis::insertOrIgnore($rowsProgresKuis);
            }
        }

        foreach ($jumlahSoalByKuis as $idKuis => $totalSoal) {
            ProgresKuis::query()
                ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
                ->where('id_kuis', $idKuis)
                ->update(['total_soal' => (int) $totalSoal]);
        }

        $progresKuisMap = ProgresKuis::query()
            ->where('id_pendaftaran', $pendaftaran->id_pendaftaran)
            ->whereIn('id_kuis', $kuisList->pluck('id_kuis'))
            ->get([
                'id_progres_kuis',
                'id_kuis'
            ])
            ->unique('id_kuis')
            ->keyBy('id_kuis');

        $soalList = Soal::query()
            ->whereIn('id_kuis', $kuisList->pluck('id_kuis'))
            ->select('id_soal', 'id_kuis')
            ->distinct()
            ->get()
            ->unique('id_soal')
            ->values();

        if ($soalList->isEmpty()) {
            return;
        }

        $existingProgresJawaban = ProgresJawaban::query()
            ->whereIn(
                'id_progres_kuis',
                $progresKuisMap->pluck('id_progres_kuis')
            )
            ->whereIn('id_soal', $soalList->pluck('id_soal'))
            ->get([
                'id_progres_kuis',
                'id_soal'
            ])
            ->map(fn ($item) =>
                $item->id_progres_kuis.'-'.$item->id_soal
            )
            ->toArray();

        $rowsProgresJawaban = $soalList
            ->map(function ($soal) use ($progresKuisMap) {

                $progresKuis = $progresKuisMap->get($soal->id_kuis);

                if (! $progresKuis) {
                    return null;
                }

                return [
                    'id_progres_kuis' => $progresKuis->id_progres_kuis,
                    'id_soal' => $soal->id_soal,
                    'key' => $progresKuis->id_progres_kuis.'-'.$soal->id_soal,
                ];
            })
            ->filter()
            ->reject(fn ($row) =>
                in_array($row['key'], $existingProgresJawaban)
            )
            ->unique('key')
            ->map(fn ($row) => [
                'id_progres_kuis' => $row['id_progres_kuis'],
                'id_soal' => $row['id_soal'],
            ])
            ->values()
            ->all();

        if (! empty($rowsProgresJawaban)) {
            ProgresJawaban::insertOrIgnore($rowsProgresJawaban);
        }
    }

    public function syncTunasPendaftaran(string $id): void
    {
        /*
        |--------------------------------------------------------------------------
        | Perbaikan keamanan sertifikat
        |--------------------------------------------------------------------------
        | Sebelumnya method ini langsung mengubah semua progres menjadi selesai
        | dan membuat sertifikat. Itu berisiko karena peserta bisa mendapat
        | sertifikat tanpa benar-benar menyelesaikan materi/kuis.
        |
        | Sekarang method ini hanya mengecek ulang kelayakan sertifikat.
        | Nama method tetap dipertahankan agar route/controller lama tidak rusak.
        */
        $this->cekTunasPendaftaran($id);
    }

    public static function generateNomor()
    {
        $tahun = Carbon::now()->format('Y');
        $bulan = Carbon::now()->format('m');

        $count = Sertifikat::whereYear('tanggal_selesai', $tahun)->count() + 1;

        return sprintf('SERT/%s/%s/%05d', $tahun, $bulan, $count);
    }

    public function isPendaftaranLayakSertifikat(string|int $id): bool
    {
        $pendaftaran = Pendaftaran::query()
            ->where('id_pendaftaran', $id)
            ->where('status', '!=', 'expired')
            ->first();

        if (! $pendaftaran) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Sinkronkan progres terlebih dahulu
        |--------------------------------------------------------------------------
        | Tujuannya agar semua materi dan kuis yang ada di kelas mempunyai
        | data progres. Setelah itu baru dicek apakah semuanya selesai/lulus.
        */
        $this->syncProgresForPendaftaran($pendaftaran);

        $materiIds = Materi::query()
            ->join('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->where('bagian_kelas.id_kelas', $pendaftaran->id_kelas)
            ->pluck('materi.id_materi')
            ->unique()
            ->values();

        if ($materiIds->isEmpty()) {
            return false;
        }

        $totalProgresMateri = ProgresKelas::query()
            ->where('id_pendaftaran', $id)
            ->whereIn('id_materi', $materiIds)
            ->count();

        if ($totalProgresMateri < $materiIds->count()) {
            return false;
        }

        $adaMateriBelumSelesai = ProgresKelas::query()
            ->where('id_pendaftaran', $id)
            ->whereIn('id_materi', $materiIds)
            ->where('selesai', false)
            ->exists();

        if ($adaMateriBelumSelesai) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Cek seluruh kuis aktif
        |--------------------------------------------------------------------------
        | Jika ada kuis aktif pada materi kelas, maka seluruh kuis aktif
        | tersebut wajib sudah lulus sebelum sertifikat diterbitkan.
        */
        $kuisIds = Kuis::query()
            ->whereIn('id_materi', $materiIds)
            ->where('aktif', true)
            ->pluck('id_kuis')
            ->unique()
            ->values();

        if ($kuisIds->isNotEmpty()) {
            $kuisLulusIds = ProgresKuis::query()
                ->where('id_pendaftaran', $id)
                ->whereIn('id_kuis', $kuisIds)
                ->where('lulus', true)
                ->pluck('id_kuis')
                ->unique()
                ->values();

            if ($kuisIds->diff($kuisLulusIds)->isNotEmpty()) {
                return false;
            }
        }

        return true;
    }

    public function cekTunasPendaftaran(string $id): ?Sertifikat
    {
        if (! $this->isPendaftaranLayakSertifikat($id)) {
            /*
            |--------------------------------------------------------------------------
            | Jika belum layak, jangan buat sertifikat
            |--------------------------------------------------------------------------
            | Jika status pendaftaran sebelumnya terlanjur selesai, kembalikan
            | menjadi aktif agar tidak salah menampilkan status kelulusan.
            */
            Pendaftaran::query()
                ->where('id_pendaftaran', $id)
                ->where('status', 'selesai')
                ->update([
                    'status' => 'aktif',
                    'selesai_pada' => null,
                ]);

            return null;
        }

        $pendaftaran = Pendaftaran::query()
            ->leftJoin('pengguna', 'pengguna.id_pengguna', '=', 'pendaftaran.id_pengguna')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'pendaftaran.id_kelas')
            ->select(
                'pendaftaran.id_pendaftaran',
                'pendaftaran.selesai_pada',
                'pengguna.nama as nama_penerima',
                'kelas.judul as judul_kelas'
            )
            ->where('pendaftaran.id_pendaftaran', $id)
            ->first();

        if (! $pendaftaran) {
            return null;
        }

        $selesaiPada = $pendaftaran->selesai_pada ?: now();

        Pendaftaran::query()
            ->where('id_pendaftaran', $id)
            ->update([
                'status' => 'selesai',
                'persentase_progres' => 100,
                'selesai_pada' => $selesaiPada,
            ]);

        $sertifikat = Sertifikat::where('id_pendaftaran', $id)->first();

        $kodeVerifikasi = $sertifikat?->kode_verifikasi
            ?: (string) Str::uuid();

        $qrCodeUrl = route(
            'sertifikat.verifikasi',
            ['id' => $kodeVerifikasi]
        );

        return Sertifikat::updateOrCreate(
            ['id_pendaftaran' => $id],
            [
                'nomor_sertifikat' => $sertifikat?->nomor_sertifikat ?: $this->generateNomor(),
                'nama_penerima' => $pendaftaran->nama_penerima,
                'judul_kelas' => $pendaftaran->judul_kelas,
                'tanggal_selesai' => $selesaiPada,
                'kode_verifikasi' => $kodeVerifikasi,
                'qr_code_url' => $qrCodeUrl,
            ]
        );
    }

    public function delete(string $id)
    {
        ProgresKelas::where('id_pendaftaran', $id)->delete();
    }

    public function hasProgres(string|int $idPendaftaran): bool
    {
        return ProgresKelas::query()
            ->where('id_pendaftaran', $idPendaftaran)
            ->exists();
    }

    public function templateSertifikat(string $id)
    {
        return Kelas::query()
            ->leftJoin('pendaftaran', 'pendaftaran.id_kelas', '=', 'kelas.id_kelas')
            ->where('pendaftaran.id_pendaftaran', $id)
            ->value('kelas.sertifikat');
    }

    public function sertifikat(string $id): ?Sertifikat
    {
        if (! $this->isPendaftaranLayakSertifikat($id)) {
            return null;
        }

        return Sertifikat::query()
            ->where('id_pendaftaran', $id)
            ->first();
    }
}