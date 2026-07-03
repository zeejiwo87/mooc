<?php

namespace App\Http\Controllers\Mentor\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasTujuanPembelajaranRequest;
use App\Services\Kelas\KelasService;
use App\Services\Kelas\KelasTujuanPembelajaranService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class KelasTujuanPembelajaranController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasTujuanPembelajaranService $kelasTujuanPembelajaranService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    private function mentorFilters(): array
    {
        return [
            'id_pemilik' => Auth::user()->id_mentor ?? '',
        ];
    }

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id, $this->mentorFilters());

        if (! $kelas) {
            abort(404, 'Kelas tidak ditemukan atau bukan milik mentor ini.');
        }

        return view('mentor.kelas.kelas_tujuan_pembelajaran.index', [
            'kelas' => $kelas,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        $kelas = $this->kelasService->getDetailData($id, $this->mentorFilters());

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasTujuanPembelajaranService->getListData($id, $this->mentorFilters()),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_tujuan, 'detail'),
                    $this->transactionService->actionButton($row->id_tujuan, 'edit'),
                    $this->transactionService->actionButton($row->id_tujuan, 'delete'),
                ]),
            ]
        );
    }

    public function store(KelasTujuanPembelajaranRequest $request): JsonResponse
    {
        $kelas = $this->kelasService->getDetailData(
            (string) $request->input('id_kelas'),
            $this->mentorFilters()
        );

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kelas',
                'tujuan',
                'urutan',
            ]);

            $created = $this->kelasTujuanPembelajaranService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KelasTujuanPembelajaranRequest $request, string $id): JsonResponse
    {
        $data = $this->kelasTujuanPembelajaranService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        $kelas = $this->kelasService->getDetailData(
            (string) $request->input('id_kelas'),
            $this->mentorFilters()
        );

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kelas',
                'tujuan',
                'urutan',
            ]);

            $updatedData = $this->kelasTujuanPembelajaranService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->kelasTujuanPembelajaranService->getDetailData($id, $this->mentorFilters());

            if (! $data) {
                return $this->responseService->errorResponse(
                    'Data tidak ditemukan atau bukan milik mentor ini.',
                    404
                );
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->kelasTujuanPembelajaranService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kelasTujuanPembelajaranService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}