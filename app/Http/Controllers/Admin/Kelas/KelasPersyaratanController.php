<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasPersyaratanRequest;
use App\Services\Kelas\KelasPersyaratanService;
use App\Services\Kelas\KelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class KelasPersyaratanController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasPersyaratanService $kelasPersyaratanService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id);

        return view('admin.kelas.kelas_persyaratan.index', ['kelas' => $kelas, 'id' => $id]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasPersyaratanService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_persyaratan, 'detail'),
                    $this->transactionService->actionButton($row->id_persyaratan, 'edit'),
                    $this->transactionService->actionButton($row->id_persyaratan, 'delete'),
                ]),
            ]
        );
    }

    public function store(KelasPersyaratanRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kelas',
                'persyaratan',
                'urutan',
            ]);

            $created = $this->kelasPersyaratanService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KelasPersyaratanRequest $request, string $id): JsonResponse
    {
        $data = $this->kelasPersyaratanService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kelas',
                'persyaratan',
                'urutan',
            ]);

            $updatedData = $this->kelasPersyaratanService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->kelasPersyaratanService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->kelasPersyaratanService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kelasPersyaratanService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}
