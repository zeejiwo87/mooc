<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KategoriSubRequest;
use App\Services\Kelas\KategoriSubService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class KategoriSubController extends Controller
{
    public function __construct(
        private readonly KategoriSubService $KategoriSubService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(): View
    {
        return view('admin.kategori_sub.index');
    }

    public function list(): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->KategoriSubService->getListData(),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_kategori_sub, 'detail'),
                    $this->transactionService->actionButton($row->id_kategori_sub, 'edit'),
                ]),
            ]
        );
    }

    public function api(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->KategoriSubService->getListDataOrdered($id);

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function store(KategoriSubRequest $request): JsonResponse
    {

        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kategori',
                'nama',
                'deskripsi',
                'urutan',
                'aktif',
            ]);

            $created = $this->KategoriSubService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KategoriSubRequest $request, string $id): JsonResponse
    {
        $data = $this->KategoriSubService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kategori',
                'nama',
                'deskripsi',
                'urutan',
                'aktif',
            ]);

            $updatedData = $this->KategoriSubService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->KategoriSubService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}
