<?php

namespace App\Services\Kelas;

use App\Models\Kelas;
use App\Services\Tools\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class KelasService
{
    public function __construct(
        private readonly FileUploadService $fileUploadService,
    ) {}

    private function durasiSql(): string
    {
        return "
            (
                SELECT CEIL(COALESCE(SUM(m.durasi_detik), 0) / 60)
                FROM bagian_kelas bk
                LEFT JOIN materi m ON m.id_bagian_kelas = bk.id_bagian_kelas
                WHERE bk.id_kelas = kelas.id_kelas
            )
        ";
    }

    private function jumlahMateriSql(): string
    {
        return "
            (
                SELECT COUNT(DISTINCT m.id_materi)
                FROM bagian_kelas bk
                LEFT JOIN materi m ON m.id_bagian_kelas = bk.id_bagian_kelas
                WHERE bk.id_kelas = kelas.id_kelas
            )
        ";
    }

    private function jumlahVideoSql(): string
    {
        return "
            (
                SELECT COUNT(DISTINCT m.id_materi)
                FROM bagian_kelas bk
                LEFT JOIN materi m ON m.id_bagian_kelas = bk.id_bagian_kelas
                WHERE bk.id_kelas = kelas.id_kelas
                  AND m.tipe = 'video'
            )
        ";
    }

    private function totalPendaftaranSql(): string
    {
        return "
            (
                SELECT COUNT(DISTINCT p.id_pengguna)
                FROM pendaftaran p
                WHERE p.id_kelas = kelas.id_kelas
                  AND p.status IN ('aktif', 'selesai')
            )
        ";
    }

    private function totalSelesaiSql(): string
    {
        return "
            (
                SELECT COUNT(DISTINCT p.id_pengguna)
                FROM pendaftaran p
                WHERE p.id_kelas = kelas.id_kelas
                  AND p.status = 'selesai'
            )
        ";
    }

    public function getFilteredKursusForContent(Request $request)
    {
        $durasiSql = $this->durasiSql();
        $jumlahMateriSql = $this->jumlahMateriSql();
        $jumlahVideoSql = $this->jumlahVideoSql();
        $totalPendaftaranSql = $this->totalPendaftaranSql();
        $totalSelesaiSql = $this->totalSelesaiSql();

        $query = Kelas::query()
            ->leftJoin('kategori_sub', 'kategori_sub.id_kategori_sub', '=', 'kelas.id_kategori_sub')
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'kategori_sub.id_kategori')
            ->select([
                'kelas.id_kelas',
                'kelas.judul',
                'kelas.slug',
                'kelas.banner',
                'kelas.video_intro_url',
                'kelas.tingkat',
                'kelas.bahasa',
                'kelas.rating',
                'kelas.nilai_lulus',
                'kelas.total_review',
                'kategori_sub.nama as kategori_sub_nama',
                'kategori.nama as kategori_nama',
            ])
            ->selectRaw("{$durasiSql} as total_durasi_menit")
            ->selectRaw("{$jumlahMateriSql} as jumlah_materi")
            ->selectRaw("{$jumlahVideoSql} as jumlah_video")
            ->selectRaw("{$totalPendaftaranSql} as total_pendaftaran")
            ->selectRaw("{$totalSelesaiSql} as total_selesai")
            ->where('kelas.status', 'terbit');

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('kelas.judul', 'LIKE', "%{$search}%")
                    ->orWhere('kelas.deskripsi_singkat', 'LIKE', "%{$search}%");
            });
        }

        if ($tingkat = $request->input('filter_tingkat')) {
            $query->where('kelas.tingkat', $tingkat);
        }

        if ($kategori = $request->input('filter_kategori')) {
            $query->where('kategori.id_kategori', $kategori);
        }

        $bahasa = strtoupper(trim((string) $request->input('filter_bahasa', 'ID')));

        if (! in_array($bahasa, ['ID', 'EN', 'AR'], true)) {
            $bahasa = 'ID';
        }

        $query->where('kelas.bahasa', $bahasa);

        if ($minRating = $request->input('min_rating')) {
            $query->where('kelas.rating', '>=', (float) $minRating);
        }

        if ($durasiRange = $request->input('durasi_range')) {
            switch ($durasiRange) {
                case 'short':
                    $query->whereRaw("{$durasiSql} <= ?", [120]);
                    break;

                case 'medium':
                    $query->whereRaw("{$durasiSql} BETWEEN ? AND ?", [120, 360]);
                    break;

                case 'long':
                    $query->whereRaw("{$durasiSql} > ?", [360]);
                    break;
            }
        }

        $sortAllowed = [
            'terbaru',
            'terpopuler',
            'rating_tertinggi',
            'durasi_terpendek',
            'durasi_terlama',
        ];

        $sort = $request->input('sort', 'terbaru');

        if (! in_array($sort, $sortAllowed, true)) {
            $sort = 'terbaru';
        }

        switch ($sort) {
            case 'terpopuler':
                $query->orderByRaw("{$totalPendaftaranSql} DESC");
                break;

            case 'rating_tertinggi':
                $query->orderByDesc('kelas.rating')
                    ->orderByDesc('kelas.total_review');
                break;

            case 'durasi_terpendek':
                $query->orderByRaw("{$durasiSql} ASC");
                break;

            case 'durasi_terlama':
                $query->orderByRaw("{$durasiSql} DESC");
                break;

            case 'terbaru':
            default:
                $query->orderByDesc('kelas.id_kelas');
                break;
        }

        $perPage = (int) $request->input('per_page', 6);

        if ($perPage <= 0 || $perPage > 48) {
            $perPage = 6;
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function getDetailForContent(string $slug)
    {
        $kelas = Kelas::query()
            ->leftJoin('kategori_sub', 'kategori_sub.id_kategori_sub', '=', 'kelas.id_kategori_sub')
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'kategori_sub.id_kategori')
            ->leftJoin('mentor', 'mentor.id_mentor', '=', 'kelas.id_pemilik')
            ->select(
                'kelas.*',
                'kategori_sub.nama as kategori_sub_nama',
                'kategori_sub.deskripsi as kategori_sub_deskripsi',
                'kategori.nama as kategori_nama',
                'kategori.deskripsi as kategori_deskripsi',
                'mentor.nama as pemilik_nama',
                'mentor.foto_profil as pemilik_foto',
                'mentor.bio as pemilik_bio',
                'mentor.spesialisasi as pemilik_spesialisasi',
                'mentor.total_siswa as pemilik_total_siswa',
                'mentor.rating_rata as pemilik_rating_rata'
            )
            ->where('kelas.slug', $slug)
            ->where('kelas.status', 'terbit')
            ->firstOrFail();

        $idKelas = (int) $kelas->id_kelas;

        $tujuanList = DB::table('kelas_tujuan_pembelajaran')
            ->where('id_kelas', $idKelas)
            ->orderBy('urutan')
            ->get();

        $targetList = DB::table('kelas_target_peserta')
            ->where('id_kelas', $idKelas)
            ->orderBy('urutan')
            ->get();

        $persyaratanList = DB::table('kelas_persyaratan')
            ->where('id_kelas', $idKelas)
            ->orderBy('urutan')
            ->get();

        $bagianList = DB::table('bagian_kelas')
            ->where('id_kelas', $idKelas)
            ->orderByRaw('COALESCE(urutan, 999999) ASC')
            ->orderBy('id_bagian_kelas')
            ->get();

        $materiList = collect();
        $materiAll = collect();

        if ($bagianList->isNotEmpty()) {
            $materiAll = DB::table('materi')
                ->whereIn('id_bagian_kelas', $bagianList->pluck('id_bagian_kelas'))
                ->orderByRaw('COALESCE(urutan, 999999) ASC')
                ->orderBy('id_materi')
                ->get();

            $materiList = $materiAll->groupBy('id_bagian_kelas');
        }

        $jumlahMateri = $materiAll->count();
        $jumlahVideo = $materiAll->where('tipe', 'video')->count();
        $jumlahText = $materiAll->whereIn('tipe', ['text', 'teks'])->count();
        $jumlahMateriKuis = $materiAll->where('tipe', 'kuis')->count();

        $totalDurasiDetik = (int) $materiAll
            ->sum(fn ($materi) => (int) ($materi->durasi_detik ?? 0));

        $totalDurasiMenit = $totalDurasiDetik > 0
            ? (int) ceil($totalDurasiDetik / 60)
            : 0;

        $durasiVideoDetik = (int) $materiAll
            ->where('tipe', 'video')
            ->sum(fn ($materi) => (int) ($materi->durasi_detik ?? 0));

        $durasiVideoMenit = $durasiVideoDetik > 0
            ? (int) ceil($durasiVideoDetik / 60)
            : 0;

        $totalPreviewMateri = $materiAll->where('preview', 1)->count();

        $jumlahKuisMateri = 0;
        $jumlahKuisAkhir = 0;
        $hasFinalExam = false;
        $totalKuis = 0;
        $totalSoalKuis = 0;
        $totalSoalAkhir = 0;
        $totalSoal = 0;

        $materiIds = $materiAll
            ->pluck('id_materi')
            ->filter()
            ->values();

        if ($materiIds->isNotEmpty()) {
            $kuisStats = DB::table('kuis')
                ->leftJoin('soal', 'soal.id_kuis', '=', 'kuis.id_kuis')
                ->whereIn('kuis.id_materi', $materiIds)
                ->selectRaw("
                    COUNT(DISTINCT kuis.id_kuis) as total_kuis,
                    COUNT(DISTINCT CASE WHEN kuis.tipe = 'kuis_materi' THEN kuis.id_kuis END) as jumlah_kuis_materi,
                    COUNT(DISTINCT CASE WHEN kuis.tipe = 'ujian_akhir' THEN kuis.id_kuis END) as jumlah_kuis_akhir,
                    COUNT(DISTINCT soal.id_soal) as total_soal,
                    COUNT(DISTINCT CASE WHEN kuis.tipe = 'kuis_materi' THEN soal.id_soal END) as total_soal_kuis,
                    COUNT(DISTINCT CASE WHEN kuis.tipe = 'ujian_akhir' THEN soal.id_soal END) as total_soal_akhir
                ")
                ->first();

            $jumlahKuisMateri = (int) ($kuisStats->jumlah_kuis_materi ?? 0);
            $jumlahKuisAkhir = (int) ($kuisStats->jumlah_kuis_akhir ?? 0);
            $hasFinalExam = $jumlahKuisAkhir > 0;
            $totalKuis = (int) ($kuisStats->total_kuis ?? 0);
            $totalSoalKuis = (int) ($kuisStats->total_soal_kuis ?? 0);
            $totalSoalAkhir = (int) ($kuisStats->total_soal_akhir ?? 0);
            $totalSoal = (int) ($kuisStats->total_soal ?? 0);
        }

        $pendaftaranStats = DB::table('pendaftaran')
            ->where('id_kelas', $idKelas)
            ->selectRaw("
                COUNT(DISTINCT CASE WHEN status IN ('aktif', 'selesai') THEN id_pengguna END) as total_pendaftaran,
                COUNT(DISTINCT CASE WHEN status = 'selesai' THEN id_pengguna END) as total_selesai
            ")
            ->first();

        $kelas->jumlah_materi = $jumlahMateri;
        $kelas->jumlah_video = $jumlahVideo;
        $kelas->jumlah_text = $jumlahText;
        $kelas->jumlah_materi_kuis = $jumlahMateriKuis;
        $kelas->total_durasi_menit = $totalDurasiMenit;
        $kelas->total_pendaftaran = (int) ($pendaftaranStats->total_pendaftaran ?? 0);
        $kelas->total_selesai = (int) ($pendaftaranStats->total_selesai ?? 0);

        // Konsep final: 1 kelas hanya memiliki 1 mentor utama melalui kelas.id_pemilik.
        // Variabel ini tetap dikirim sebagai collection kosong agar view yang masih memakai
        // $mentorLain tidak error, tetapi data tidak lagi diambil dari tabel kelas_mentor.
        $mentorLain = collect();

        $tags = DB::table('kelas_tag')
            ->join('tag', 'tag.id_tag', '=', 'kelas_tag.id_tag')
            ->where('kelas_tag.id_kelas', $idKelas)
            ->select('tag.*')
            ->get();

        return [
            'kelas' => $kelas,
            'tujuanList' => $tujuanList,
            'targetList' => $targetList,
            'persyaratanList' => $persyaratanList,
            'bagianList' => $bagianList,
            'materiList' => $materiList,
            'mentorLain' => $mentorLain,
            'tags' => $tags,
            'jumlahMateri' => $jumlahMateri,
            'jumlahVideo' => $jumlahVideo,
            'jumlahText' => $jumlahText,
            'jumlahMateriKuis' => $jumlahMateriKuis,
            'durasiVideoMenit' => $durasiVideoMenit,
            'totalDurasiMenit' => $totalDurasiMenit,
            'totalPreviewMateri' => $totalPreviewMateri,
            'jumlahKuisMateri' => $jumlahKuisMateri,
            'jumlahKuisAkhir' => $jumlahKuisAkhir,
            'hasFinalExam' => $hasFinalExam,
            'totalKuis' => $totalKuis,
            'totalSoalKuis' => $totalSoalKuis,
            'totalSoalAkhir' => $totalSoalAkhir,
            'totalSoal' => $totalSoal,
        ];
    }

    public function getListData(array $filters = []): Collection
    {
        $query = Kelas::query()
            ->leftJoin('kategori_sub', 'kategori_sub.id_kategori_sub', '=', 'kelas.id_kategori_sub')
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'kategori_sub.id_kategori')
            ->leftJoin('mentor', 'mentor.id_mentor', '=', 'kelas.id_pemilik')
            ->select(
                'kelas.*',
                'mentor.nama as pemilik',
                'mentor.foto_profil',
                'mentor.spesialisasi',
                'kategori_sub.nama as kategori_sub_nama',
                'kategori.nama as kategori_nama',
            )
            ->orderBy('kelas.id_kelas');

        if (! empty($filters['id_pemilik'])) {
            $query->where('kelas.id_pemilik', $filters['id_pemilik']);
        }

        if (! empty($filters['id_kategori'])) {
            $query->where('kategori.id_kategori', $filters['id_kategori']);
        }

        if (! empty($filters['tingkat'])) {
            $query->where('kelas.tingkat', $filters['tingkat']);
        }

        if (! empty($filters['bahasa'])) {
            $bahasa = strtoupper(trim((string) $filters['bahasa']));

            if (in_array($bahasa, ['ID', 'EN', 'AR'], true)) {
                $query->where('kelas.bahasa', $bahasa);
            }
        }

        if (! empty($filters['status'])) {
            $query->where('kelas.status', $filters['status']);
        }

        return $query->get();
    }

    public function getListDataOrdered(?array $filters = []): Collection
    {
        return Kelas::query()
            ->select('id_kelas', 'judul')
            ->orderBy('id_kelas')
            ->when(
                ! empty($filters['id_pemilik']),
                fn ($q) => $q->where('id_pemilik', $filters['id_pemilik'])
            )
            ->get();
    }

    public function create(array $data): Kelas
    {
        return Kelas::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?Kelas
    {
        $query = Kelas::query()
            ->leftJoin('kategori_sub', 'kategori_sub.id_kategori_sub', '=', 'kelas.id_kategori_sub')
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'kategori_sub.id_kategori')
            ->leftJoin('mentor', 'mentor.id_mentor', '=', 'kelas.id_pemilik')
            ->select(
                'kelas.*',
                'mentor.nama as pemilik',
                'mentor.foto_profil',
                'mentor.spesialisasi',
                'kategori.id_kategori',
                'kategori_sub.nama as kategori_sub_nama',
                'kategori.nama as kategori_nama',
            )
            ->where('kelas.id_kelas', $id);

        if (! empty($filters['id_pemilik'])) {
            $query->where('kelas.id_pemilik', $filters['id_pemilik']);
        }

        $kelas = $query->first();

        if (! $kelas) {
            return null;
        }

        $idKelas = (int) $kelas->id_kelas;

        $materiStats = DB::table('materi')
            ->join('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->where('bagian_kelas.id_kelas', $idKelas)
            ->selectRaw('
                COUNT(materi.id_materi) as jumlah_materi,
                COALESCE(SUM(materi.durasi_detik), 0) as total_durasi_detik
            ')
            ->first();

        $pendaftaranStats = DB::table('pendaftaran')
            ->where('id_kelas', $idKelas)
            ->selectRaw("
                COUNT(id_pendaftaran) as total_pendaftaran,
                COALESCE(SUM(CASE WHEN status = 'selesai' THEN 1 ELSE 0 END), 0) as total_selesai
            ")
            ->first();

        $totalDurasiDetik = (int) ($materiStats->total_durasi_detik ?? 0);

        $kelas->jumlah_materi = (int) ($materiStats->jumlah_materi ?? 0);

        $kelas->total_durasi_menit = $totalDurasiDetik > 0
            ? (int) ceil($totalDurasiDetik / 60)
            : 0;

        $kelas->total_pendaftaran = (int) ($pendaftaranStats->total_pendaftaran ?? 0);
        $kelas->total_selesai = (int) ($pendaftaranStats->total_selesai ?? 0);

        return $kelas;
    }

    public function getBuilderData(string $id, ?array $filters = []): array
    {
        $kelas = $this->getDetailData($id, $filters);

        if (! $kelas) {
            abort(404, 'Kelas tidak ditemukan.');
        }

        $idKelas = (int) $kelas->id_kelas;

        $bagianKelas = DB::table('bagian_kelas')
            ->where('id_kelas', $idKelas)
            ->orderByRaw('COALESCE(urutan, 999999) ASC')
            ->orderBy('id_bagian_kelas')
            ->get();

        $materiByBagian = collect();
        $materiAll = collect();
        $kuisByMateri = collect();
        $kuisStatsByMateri = collect();
        $soalByKuis = collect();
        $jawabanBySoal = collect();

        if ($bagianKelas->isNotEmpty()) {
            $idBagianKelas = $bagianKelas
                ->pluck('id_bagian_kelas')
                ->filter()
                ->values();

            if ($idBagianKelas->isNotEmpty()) {
                $materiAll = DB::table('materi')
                    ->whereIn('id_bagian_kelas', $idBagianKelas)
                    ->orderByRaw('COALESCE(urutan, 999999) ASC')
                    ->orderBy('id_materi')
                    ->get();

                $materiByBagian = $materiAll->groupBy('id_bagian_kelas');
            }
        }

        $materiIds = $materiAll
            ->pluck('id_materi')
            ->filter()
            ->values();

        if ($materiIds->isNotEmpty()) {
            $kuisAll = DB::table('kuis')
                ->whereIn('id_materi', $materiIds)
                ->orderBy('id_kuis')
                ->get();

            $kuisByMateri = $kuisAll->groupBy('id_materi');

            $kuisIds = $kuisAll
                ->pluck('id_kuis')
                ->filter()
                ->values();

            if ($kuisIds->isNotEmpty()) {
                $soalAll = DB::table('soal')
                    ->whereIn('id_kuis', $kuisIds)
                    ->orderBy('id_soal')
                    ->get();

                $soalByKuis = $soalAll->groupBy('id_kuis');

                $soalIds = $soalAll
                    ->pluck('id_soal')
                    ->filter()
                    ->values();

                if ($soalIds->isNotEmpty()) {
                    $jawabanAll = DB::table('soal_jawaban')
                        ->whereIn('id_soal', $soalIds)
                        ->orderBy('id_soal_jawaban')
                        ->get();

                    $jawabanBySoal = $jawabanAll->groupBy('id_soal');
                }
            }

            $kuisStatsByMateri = DB::table('kuis')
                ->leftJoin('soal', 'soal.id_kuis', '=', 'kuis.id_kuis')
                ->leftJoin('soal_jawaban', 'soal_jawaban.id_soal', '=', 'soal.id_soal')
                ->whereIn('kuis.id_materi', $materiIds)
                ->groupBy('kuis.id_materi')
                ->selectRaw('
                    kuis.id_materi,
                    COUNT(DISTINCT kuis.id_kuis) as total_kuis,
                    COUNT(DISTINCT soal.id_soal) as total_soal,
                    COUNT(DISTINCT soal_jawaban.id_soal_jawaban) as total_jawaban
                ')
                ->get()
                ->keyBy('id_materi');
        }

        $jumlahBagian = $bagianKelas->count();
        $jumlahMateri = $materiAll->count();

        $jumlahVideo = $materiAll
            ->where('tipe', 'video')
            ->count();

        $jumlahText = $materiAll
            ->whereIn('tipe', ['text', 'teks'])
            ->count();

        $jumlahMateriKuis = $materiAll
            ->where('tipe', 'kuis')
            ->count();

        $jumlahPreview = $materiAll
            ->where('preview', 1)
            ->count();

        $totalDurasiDetik = (int) $materiAll
            ->sum(fn ($materi) => (int) ($materi->durasi_detik ?? 0));

        $totalDurasiMenit = $totalDurasiDetik > 0
            ? (int) ceil($totalDurasiDetik / 60)
            : 0;

        $totalKuis = (int) $kuisStatsByMateri
            ->sum(fn ($row) => (int) ($row->total_kuis ?? 0));

        $totalSoal = (int) $kuisStatsByMateri
            ->sum(fn ($row) => (int) ($row->total_soal ?? 0));

        $totalJawaban = (int) $kuisStatsByMateri
            ->sum(fn ($row) => (int) ($row->total_jawaban ?? 0));

        return [
            'kelas' => $kelas,
            'bagianKelas' => $bagianKelas,
            'materiByBagian' => $materiByBagian,
            'materiAll' => $materiAll,
            'kuisByMateri' => $kuisByMateri,
            'kuisStatsByMateri' => $kuisStatsByMateri,
            'soalByKuis' => $soalByKuis,
            'jawabanBySoal' => $jawabanBySoal,
            'jumlahBagian' => $jumlahBagian,
            'jumlahMateri' => $jumlahMateri,
            'jumlahVideo' => $jumlahVideo,
            'jumlahText' => $jumlahText,
            'jumlahMateriKuis' => $jumlahMateriKuis,
            'jumlahPreview' => $jumlahPreview,
            'totalDurasiDetik' => $totalDurasiDetik,
            'totalDurasiMenit' => $totalDurasiMenit,
            'totalKuis' => $totalKuis,
            'totalSoal' => $totalSoal,
            'totalJawaban' => $totalJawaban,
        ];
    }

    public function findById(string $id): ?Kelas
    {
        return Kelas::find($id);
    }

    public function update(Kelas $kelas, array $data): Kelas
    {
        $kelas->update($data);

        return $kelas;
    }

    public function delete(Kelas $kelas): void
    {
        $kelas->delete();
    }

    public function handleFileUploadSertifikat($sertifikat, ?Kelas $kelas = null): ?array
    {
        if (! $sertifikat) {
            return null;
        }

        if ($kelas && $kelas->sertifikat) {
            return $this->fileUploadService->updateFileByType($sertifikat, $kelas->sertifikat, 'sertifikat');
        }

        return $this->fileUploadService->uploadByType($sertifikat, 'sertifikat');
    }

    public function handleFileUploadBanner($banner, ?Kelas $kelas = null): ?array
    {
        if (! $banner) {
            return null;
        }

        if ($kelas && $kelas->banner) {
            return $this->fileUploadService->updateFileByType($banner, $kelas->banner, 'banner');
        }

        return $this->fileUploadService->uploadByType($banner, 'banner');
    }

    public function getbaruClasses(int $limit = 3): Collection
    {
        $durasiSql = $this->durasiSql();
        $jumlahMateriSql = $this->jumlahMateriSql();
        $jumlahVideoSql = $this->jumlahVideoSql();
        $totalPendaftaranSql = $this->totalPendaftaranSql();
        $totalSelesaiSql = $this->totalSelesaiSql();

        $limit = max(1, min($limit, 12));

        return Kelas::query()
            ->leftJoin('kategori_sub', 'kategori_sub.id_kategori_sub', '=', 'kelas.id_kategori_sub')
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'kategori_sub.id_kategori')
            ->leftJoin('mentor', 'mentor.id_mentor', '=', 'kelas.id_pemilik')
            ->select([
                'kelas.id_kelas',
                'kelas.id_kategori_sub',
                'kelas.id_pemilik',
                'kelas.judul',
                'kelas.slug',
                'kelas.deskripsi_singkat',
                'kelas.deskripsi_lengkap',
                'kelas.banner',
                'kelas.sertifikat',
                'kelas.video_intro_url',
                'kelas.tingkat',
                'kelas.bahasa',
                'kelas.rating',
                'kelas.nilai_lulus',
                'kelas.total_review',
                'kelas.status',
                'kelas.deleted_at',
                'kelas.created_at',
                'kelas.updated_at',
                'mentor.nama as pemilik',
                'mentor.foto_profil',
                'mentor.spesialisasi',
                'kategori_sub.nama as kategori_sub_nama',
                'kategori.nama as kategori_nama',
            ])
            ->selectRaw("{$durasiSql} as total_durasi_menit")
            ->selectRaw("{$jumlahMateriSql} as jumlah_materi")
            ->selectRaw("{$jumlahVideoSql} as jumlah_video")
            ->selectRaw("{$totalPendaftaranSql} as total_pendaftaran")
            ->selectRaw("{$totalSelesaiSql} as total_selesai")
            ->where('kelas.status', 'terbit')
            ->orderByDesc('kelas.created_at')
            ->orderByDesc('kelas.id_kelas')
            ->limit($limit)
            ->get();
    }
}
