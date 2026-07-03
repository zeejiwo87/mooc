<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasTujuanPembelajaranRequest;
use App\Services\Kelas\KelasService;
use App\Services\Kelas\KelasTujuanPembelajaranService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class KelasTujuanPembelajaranController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasTujuanPembelajaranService $kelasTujuanPembelajaranService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id);

        return view('admin.kelas.kelas_tujuan_pembelajaran.index', ['kelas' => $kelas, 'id' => $id]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasTujuanPembelajaranService->getListData($id),
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
        $data = $this->kelasTujuanPembelajaranService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
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
            $data = $this->kelasTujuanPembelajaranService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->kelasTujuanPembelajaranService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kelasTujuanPembelajaranService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}
