<?php

namespace App\Http\Controllers\Mentor\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class NilaiPesertaController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(): View
    {
        return view('mentor.nilai_peserta.index');
    }

    public function list(Request $request): JsonResponse
    {
        $idMentor = (int) (Auth::user()->id_mentor ?? 0);

        $rekapKuisKelas = DB::table('kuis')
            ->join('materi', 'materi.id_materi', '=', 'kuis.id_materi')
            ->join(
                'bagian_kelas',
                'bagian_kelas.id_bagian_kelas',
                '=',
                'materi.id_bagian_kelas'
            )
            ->where('kuis.aktif', 1)
            ->groupBy('bagian_kelas.id_kelas')
            ->select(
                'bagian_kelas.id_kelas',
                DB::raw('COUNT(DISTINCT kuis.id_kuis) AS total_kuis')
            );

        $rekapNilaiPendaftaran = DB::table('progres_kuis')
            ->groupBy('progres_kuis.id_pendaftaran')
            ->select(
                'progres_kuis.id_pendaftaran',
                DB::raw(
                    'SUM(CASE
                        WHEN progres_kuis.diserahkan_pada IS NOT NULL
                        THEN 1 ELSE 0
                    END) AS kuis_dikerjakan'
                ),
                DB::raw(
                    'SUM(CASE
                        WHEN progres_kuis.diserahkan_pada IS NOT NULL
                            AND progres_kuis.lulus = 1
                        THEN 1 ELSE 0
                    END) AS kuis_lulus'
                ),
                DB::raw(
                    'AVG(CASE
                        WHEN progres_kuis.diserahkan_pada IS NOT NULL
                        THEN progres_kuis.nilai
                        ELSE NULL
                    END) AS rata_rata_nilai'
                ),
                DB::raw('MAX(progres_kuis.diserahkan_pada) AS terakhir_mengerjakan')
            );

        return $this->transactionService->handleWithDataTable(
            function () use (
                $request,
                $idMentor,
                $rekapKuisKelas,
                $rekapNilaiPendaftaran
            ) {
                $data = DB::table('pendaftaran')
                    ->join(
                        'pengguna',
                        'pengguna.id_pengguna',
                        '=',
                        'pendaftaran.id_pengguna'
                    )
                    ->join(
                        'kelas',
                        'kelas.id_kelas',
                        '=',
                        'pendaftaran.id_kelas'
                    )
                    ->leftJoinSub(
                        $rekapKuisKelas,
                        'rekap_kuis_kelas',
                        function ($join) {
                            $join->on(
                                'rekap_kuis_kelas.id_kelas',
                                '=',
                                'pendaftaran.id_kelas'
                            );
                        }
                    )
                    ->leftJoinSub(
                        $rekapNilaiPendaftaran,
                        'rekap_nilai',
                        function ($join) {
                            $join->on(
                                'rekap_nilai.id_pendaftaran',
                                '=',
                                'pendaftaran.id_pendaftaran'
                            );
                        }
                    )
                    ->where('kelas.id_pemilik', $idMentor)
                    ->whereNull('kelas.deleted_at')
                    ->whereNull('pengguna.deleted_at')
                    ->when(
                        $request->filled('id_kelas'),
                        fn ($query) => $query->where(
                            'pendaftaran.id_kelas',
                            $request->input('id_kelas')
                        )
                    )
                    ->when(
                        $request->filled('status_pendaftaran'),
                        fn ($query) => $query->where(
                            'pendaftaran.status',
                            $request->input('status_pendaftaran')
                        )
                    )
                    ->select(
                        'pendaftaran.id_pendaftaran',
                        'pendaftaran.id_pengguna',
                        'pendaftaran.id_kelas',
                        'pendaftaran.terdaftar_pada',
                        'pendaftaran.persentase_progres',
                        'pendaftaran.status as status_pendaftaran',
                        'pengguna.nama as pengguna_nama',
                        'pengguna.email as pengguna_email',
                        'kelas.judul as kelas_judul',
                        DB::raw(
                            'COALESCE(rekap_kuis_kelas.total_kuis, 0) AS total_kuis'
                        ),
                        DB::raw(
                            'COALESCE(rekap_nilai.kuis_dikerjakan, 0) AS kuis_dikerjakan'
                        ),
                        DB::raw(
                            'COALESCE(rekap_nilai.kuis_lulus, 0) AS kuis_lulus'
                        ),
                        'rekap_nilai.rata_rata_nilai',
                        'rekap_nilai.terakhir_mengerjakan'
                    )
                    ->orderByDesc('pendaftaran.terdaftar_pada')
                    ->get();

                if ($request->filled('status_nilai')) {
                    $statusNilai = (string) $request->input('status_nilai');

                    $data = $data
                        ->filter(
                            fn ($row) => $this->statusNilaiKey($row) === $statusNilai
                        )
                        ->values();
                }

                return $data;
            },
            [
                'action' => fn ($row) => $this->transactionService->actionButton(
                    (string) $row->id_pendaftaran,
                    'detail'
                ),

                'rekap_kuis' => fn ($row) => sprintf(
                    '%d / %d',
                    (int) $row->kuis_dikerjakan,
                    (int) $row->total_kuis
                ),

                'rata_rata' => fn ($row) => is_null($row->rata_rata_nilai)
                    ? '-'
                    : number_format(
                        (float) $row->rata_rata_nilai,
                        2,
                        ',',
                        '.'
                    ),

                'status_nilai' => fn ($row) => $this->statusNilaiBadge($row),
            ]
        );
    }

    public function detail(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(
            function () use ($id) {
                $idMentor = (int) (Auth::user()->id_mentor ?? 0);

                $pendaftaran = DB::table('pendaftaran')
                    ->join(
                        'pengguna',
                        'pengguna.id_pengguna',
                        '=',
                        'pendaftaran.id_pengguna'
                    )
                    ->join(
                        'kelas',
                        'kelas.id_kelas',
                        '=',
                        'pendaftaran.id_kelas'
                    )
                    ->where('pendaftaran.id_pendaftaran', $id)
                    ->where('kelas.id_pemilik', $idMentor)
                    ->whereNull('kelas.deleted_at')
                    ->whereNull('pengguna.deleted_at')
                    ->select(
                        'pendaftaran.id_pendaftaran',
                        'pendaftaran.id_kelas',
                        'pendaftaran.terdaftar_pada',
                        'pendaftaran.persentase_progres',
                        'pendaftaran.status as status_pendaftaran',
                        'pengguna.nama as pengguna_nama',
                        'pengguna.email as pengguna_email',
                        'kelas.judul as kelas_judul'
                    )
                    ->first();

                if (! $pendaftaran) {
                    return $this->responseService->errorResponse(
                        'Data pendaftaran tidak ditemukan atau bukan peserta kelas Anda.',
                        404
                    );
                }

                $rekapHistori = DB::table('progres_kuis_histori')
                    ->groupBy('id_progres_kuis')
                    ->select(
                        'id_progres_kuis',
                        DB::raw('COUNT(*) AS jumlah_percobaan')
                    );

                $nilaiKuis = DB::table('kuis')
                    ->join('materi', 'materi.id_materi', '=', 'kuis.id_materi')
                    ->join(
                        'bagian_kelas',
                        'bagian_kelas.id_bagian_kelas',
                        '=',
                        'materi.id_bagian_kelas'
                    )
                    ->leftJoin(
                        'progres_kuis',
                        function ($join) use ($id) {
                            $join
                                ->on(
                                    'progres_kuis.id_kuis',
                                    '=',
                                    'kuis.id_kuis'
                                )
                                ->where('progres_kuis.id_pendaftaran', $id);
                        }
                    )
                    ->leftJoinSub(
                        $rekapHistori,
                        'rekap_histori',
                        function ($join) {
                            $join->on(
                                'rekap_histori.id_progres_kuis',
                                '=',
                                'progres_kuis.id_progres_kuis'
                            );
                        }
                    )
                    ->where('bagian_kelas.id_kelas', $pendaftaran->id_kelas)
                    ->where('kuis.aktif', 1)
                    ->orderBy('bagian_kelas.urutan')
                    ->orderBy('materi.urutan')
                    ->orderBy('kuis.id_kuis')
                    ->select(
                        'kuis.id_kuis',
                        'kuis.judul as kuis_judul',
                        'kuis.tipe as kuis_tipe',
                        'kuis.nilai_lulus',
                        'materi.judul as materi_judul',
                        'materi.tipe as materi_tipe',
                        'progres_kuis.id_progres_kuis',
                        'progres_kuis.nilai',
                        'progres_kuis.total_soal',
                        'progres_kuis.jawaban_benar',
                        'progres_kuis.lulus',
                        'progres_kuis.diserahkan_pada',
                        DB::raw(
                            'COALESCE(rekap_histori.jumlah_percobaan, 0) AS jumlah_percobaan'
                        )
                    )
                    ->get()
                    ->map(function ($row) {
                        $sudahMengerjakan = ! is_null($row->diserahkan_pada);
                        $jumlahPercobaan = (int) $row->jumlah_percobaan;

                        if ($sudahMengerjakan && $jumlahPercobaan < 1) {
                            $jumlahPercobaan = 1;
                        }

                        return [
                            'id_kuis' => (int) $row->id_kuis,
                            'kuis_judul' => $row->kuis_judul,
                            'kuis_tipe' => $row->kuis_tipe,
                            'materi_judul' => $row->materi_judul,
                            'materi_tipe' => $row->materi_tipe,
                            'nilai_lulus' => (int) $row->nilai_lulus,
                            'nilai' => $sudahMengerjakan
                                ? (float) $row->nilai
                                : null,
                            'total_soal' => $sudahMengerjakan
                                ? (int) $row->total_soal
                                : null,
                            'jawaban_benar' => $sudahMengerjakan
                                ? (int) $row->jawaban_benar
                                : null,
                            'jumlah_percobaan' => $jumlahPercobaan,
                            'lulus' => $sudahMengerjakan
                                ? (bool) $row->lulus
                                : null,
                            'status' => match (true) {
                                ! $sudahMengerjakan => 'Belum mengerjakan',
                                (bool) $row->lulus => 'Lulus',
                                default => 'Belum lulus',
                            },
                            'diserahkan_pada' => $row->diserahkan_pada,
                        ];
                    })
                    ->values();

                return $this->responseService->successResponse(
                    'Data nilai peserta berhasil diambil.',
                    [
                        'pendaftaran' => $pendaftaran,
                        'nilai_kuis' => $nilaiKuis,
                    ]
                );
            }
        );
    }

    private function statusNilaiKey(object $row): string
    {
        $totalKuis = (int) $row->total_kuis;
        $kuisDikerjakan = (int) $row->kuis_dikerjakan;
        $kuisLulus = (int) $row->kuis_lulus;

        return match (true) {
            $totalKuis === 0 => 'belum_ada_kuis',
            $kuisDikerjakan === 0 => 'belum_mengerjakan',
            $kuisLulus >= $totalKuis => 'semua_lulus',
            default => 'sedang_mengerjakan',
        };
    }

    private function statusNilaiBadge(object $row): string
    {
        return match ($this->statusNilaiKey($row)) {
            'belum_ada_kuis' =>
                '<span class="badge badge-light-secondary">Belum ada kuis</span>',

            'belum_mengerjakan' =>
                '<span class="badge badge-light-dark">Belum mengerjakan</span>',

            'semua_lulus' =>
                '<span class="badge badge-light-success">Semua kuis lulus</span>',

            default =>
                '<span class="badge badge-light-warning">Sedang mengerjakan</span>',
        };
    }
}
