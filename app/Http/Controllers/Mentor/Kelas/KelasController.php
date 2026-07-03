<?php

namespace App\Http\Controllers\Mentor\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasRequest;
use App\Services\Kelas\KelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class KelasController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    private function mentorId(): string
    {
        return (string) (Auth::user()->id_mentor ?? '');
    }

    private function ownerFilters(): array
    {
        return [
            'id_pemilik' => $this->mentorId(),
        ];
    }

    public function index(): View
    {
        return view('mentor.kelas.kelas.index');
    }

    public function api(): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () {
            $data = $this->kelasService->getListDataOrdered($this->ownerFilters());

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function list(Request $request): JsonResponse
    {
        $filters = [
            'id_kategori' => $request->input('id_kategori'),
            'tingkat' => $request->input('tingkat'),
            'bahasa' => $request->input('bahasa'),
            'status' => $request->input('status'),
            'id_pemilik' => $this->mentorId(),
        ];

        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasService->getListData($filters),
            [
                'action' => function ($row) {
                    $actions = [
                        $this->transactionService->actionButton($row->id_kelas, 'detail'),
                        $this->transactionService->actionButton($row->id_kelas, 'edit'),
                        $this->transactionService->actionLink(
                            route('mentor.kelas.kelas.histori', $row->id_kelas),
                            'histori',
                            'Isi Kelas'
                        ),
                    ];

                    if (! empty($row->sertifikat)) {
                        $actions[] = $this->transactionService->actionLink(
                            route('view-file', ['sertifikat', $row->sertifikat]),
                            'sertifikat',
                            'Template Sertifikat'
                        );
                    }

                    return implode(' ', $actions);
                },
            ]
        );
    }

    public function histori(string $id): View
    {
        $builder = $this->kelasService->getBuilderData($id, $this->ownerFilters());

        return view('mentor.kelas.kelas.histori', [
            'kelas' => $builder['kelas'],
            'id' => $id,

            'bagianKelas' => $builder['bagianKelas'],
            'materiByBagian' => $builder['materiByBagian'],
            'materiAll' => $builder['materiAll'],

            'kuisByMateri' => $builder['kuisByMateri'],
            'kuisStatsByMateri' => $builder['kuisStatsByMateri'],
            'soalByKuis' => $builder['soalByKuis'],
            'jawabanBySoal' => $builder['jawabanBySoal'],

            'jumlahBagian' => $builder['jumlahBagian'],
            'jumlahMateri' => $builder['jumlahMateri'],
            'jumlahVideo' => $builder['jumlahVideo'],
            'jumlahText' => $builder['jumlahText'],
            'jumlahMateriKuis' => $builder['jumlahMateriKuis'],
            'jumlahPreview' => $builder['jumlahPreview'],

            'totalDurasiDetik' => $builder['totalDurasiDetik'],
            'totalDurasiMenit' => $builder['totalDurasiMenit'],

            'totalKuis' => $builder['totalKuis'],
            'totalSoal' => $builder['totalSoal'],
            'totalJawaban' => $builder['totalJawaban'],
        ]);
    }

    public function store(KelasRequest $request): JsonResponse
    {
        $banner = $request->file('banner');
        $sertifikat = $request->file('sertifikat');

        return $this->transactionService->handleWithTransaction(function () use ($request, $banner, $sertifikat) {
            $payload = $request->only([
                'id_kategori_sub',
                'judul',
                'slug',
                'deskripsi_singkat',
                'deskripsi_lengkap',
                'video_intro_url',
                'tingkat',
                'bahasa',
                'nilai_lulus',
                'status',
            ]);

            $payload['id_pemilik'] = $this->mentorId();

            $created = $this->kelasService->create($payload);

            $uploadResultBanner = $this->kelasService->handleFileUploadBanner($banner, $created);

            if ($uploadResultBanner) {
                $created->update([
                    'banner' => $uploadResultBanner['file_name'],
                ]);
            }

            $uploadResultSertifikat = $this->kelasService->handleFileUploadSertifikat($sertifikat, $created);

            if ($uploadResultSertifikat) {
                $created->update([
                    'sertifikat' => $uploadResultSertifikat['file_name'],
                ]);
            }

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KelasRequest $request, string $id): JsonResponse
    {
        $kelas = $this->kelasService->getDetailData($id, $this->ownerFilters());

        if (! $kelas) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        $data = $this->kelasService->findById($id);

        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        $banner = $request->file('banner');
        $sertifikat = $request->file('sertifikat');

        return $this->transactionService->handleWithTransaction(function () use ($request, $data, $banner, $sertifikat) {
            $payload = $request->only([
                'id_kategori_sub',
                'judul',
                'slug',
                'deskripsi_singkat',
                'deskripsi_lengkap',
                'video_intro_url',
                'tingkat',
                'bahasa',
                'nilai_lulus',
                'status',
            ]);

            $payload['id_pemilik'] = $this->mentorId();

            $updatedData = $this->kelasService->update($data, $payload);

            $uploadResultBanner = $this->kelasService->handleFileUploadBanner($banner, $updatedData);

            if ($uploadResultBanner) {
                $updatedData->update([
                    'banner' => $uploadResultBanner['file_name'],
                ]);
            }

            $uploadResultSertifikat = $this->kelasService->handleFileUploadSertifikat($sertifikat, $updatedData);

            if ($uploadResultSertifikat) {
                $updatedData->update([
                    'sertifikat' => $uploadResultSertifikat['file_name'],
                ]);
            }

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    private function sanitizeCsvCell(mixed $value): string
    {
        $value = trim(strip_tags((string) $value));

        if ($value !== '' && preg_match('/^[=+\-@\t\r]/', $value)) {
            return "'".$value;
        }

        return $value;
    }

    public function exportBuilder(Request $request, string $id)
    {
        $kelas = DB::table('kelas')
            ->where('id_kelas', $id)
            ->where('id_pemilik', $this->mentorId())
            ->first(['id_kelas', 'judul']);

        if (! $kelas) {
            abort(404, 'Kelas tidak ditemukan.');
        }

        $scope = (string) $request->query('scope', 'kelas');
        $target = $request->query('target');

        $allowedScopes = ['kelas', 'bagian', 'materi', 'kuis', 'soal'];
        if (! in_array($scope, $allowedScopes, true)) {
            $scope = 'kelas';
        }

        $query = DB::table('kelas')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->leftJoin('materi', 'materi.id_bagian_kelas', '=', 'bagian_kelas.id_bagian_kelas')
            ->leftJoin('kuis', 'kuis.id_materi', '=', 'materi.id_materi')
            ->leftJoin('soal', 'soal.id_kuis', '=', 'kuis.id_kuis')
            ->leftJoin('soal_jawaban', 'soal_jawaban.id_soal', '=', 'soal.id_soal')
            ->where('kelas.id_kelas', $id)
            ->where('kelas.id_pemilik', $this->mentorId())
            ->select([
                'kelas.id_kelas',
                'kelas.judul as kelas_judul',
                'bagian_kelas.id_bagian_kelas',
                'bagian_kelas.urutan as bagian_urutan',
                'bagian_kelas.judul as bagian_judul',
                'materi.id_materi',
                'materi.urutan as materi_urutan',
                'materi.judul as materi_judul',
                'materi.tipe as materi_tipe',
                'materi.durasi_detik',
                'materi.preview',
                'kuis.id_kuis',
                'kuis.judul as kuis_judul',
                'kuis.tipe as kuis_tipe',
                'kuis.durasi_menit',
                'kuis.nilai_lulus',
                'kuis.aktif as kuis_aktif',
                'soal.id_soal',
                'soal.teks_soal',
                'soal.nilai as soal_nilai',
                'soal.penjelasan as soal_penjelasan',
                'soal_jawaban.id_soal_jawaban',
                'soal_jawaban.teks_jawaban',
                'soal_jawaban.benar as jawaban_benar',
            ])
            ->orderBy('bagian_kelas.urutan')
            ->orderBy('materi.urutan')
            ->orderBy('kuis.id_kuis')
            ->orderBy('soal.id_soal')
            ->orderBy('soal_jawaban.id_soal_jawaban');

        if ($target) {
            match ($scope) {
                'bagian' => $query->where('bagian_kelas.id_bagian_kelas', $target),
                'materi' => $query->where('materi.id_materi', $target),
                'kuis' => $query->where('kuis.id_kuis', $target),
                'soal' => $query->where('soal.id_soal', $target),
                default => null,
            };
        }

        $rows = $query->get();

        $safeKelas = Str::slug($kelas->judul ?: 'kelas-'.$id);
        $safeScope = Str::slug($scope ?: 'kelas');
        $safeTarget = $target ? '-'.$target : '';
        $filename = 'export-'.$safeKelas.'-'.$safeScope.$safeTarget.'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'no-store, no-cache',
        ];

        return response()->stream(function () use ($rows) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'ID Kelas',
                'Judul Kelas',
                'ID Bagian',
                'Urutan Bagian',
                'Judul Bagian',
                'ID Materi',
                'Urutan Materi',
                'Judul Materi',
                'Tipe Materi',
                'Durasi Detik',
                'Preview',
                'ID Kuis',
                'Judul Kuis',
                'Tipe Kuis',
                'Durasi Menit',
                'Nilai Lulus',
                'Kuis Aktif',
                'ID Soal',
                'Teks Soal',
                'Nilai Soal',
                'Penjelasan Soal',
                'ID Jawaban',
                'Teks Jawaban',
                'Jawaban Benar',
            ]);

            if ($rows->isEmpty()) {
                fputcsv($handle, ['Data kosong']);
                fclose($handle);
                return;
            }

            foreach ($rows as $row) {
                fputcsv($handle, [
                    $row->id_kelas,
                    $this->sanitizeCsvCell($row->kelas_judul),
                    $row->id_bagian_kelas,
                    $row->bagian_urutan,
                    $this->sanitizeCsvCell($row->bagian_judul),
                    $row->id_materi,
                    $row->materi_urutan,
                    $this->sanitizeCsvCell($row->materi_judul),
                    $this->sanitizeCsvCell($row->materi_tipe),
                    $row->durasi_detik,
                    (int) ($row->preview ?? 0) === 1 ? 'Ya' : 'Tidak',
                    $row->id_kuis,
                    $this->sanitizeCsvCell($row->kuis_judul),
                    $this->sanitizeCsvCell($row->kuis_tipe),
                    $row->durasi_menit,
                    $row->nilai_lulus,
                    (int) ($row->kuis_aktif ?? 0) === 1 ? 'Aktif' : 'Tidak Aktif',
                    $row->id_soal,
                    $this->sanitizeCsvCell($row->teks_soal),
                    $row->soal_nilai,
                    $this->sanitizeCsvCell($row->soal_penjelasan),
                    $row->id_soal_jawaban,
                    $this->sanitizeCsvCell($row->teks_jawaban),
                    (int) ($row->jawaban_benar ?? 0) === 1 ? 'Benar' : 'Salah',
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->kelasService->getDetailData($id, $this->ownerFilters());

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}
