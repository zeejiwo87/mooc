<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KategoriRequest;
use App\Services\Kelas\KategoriService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class KategoriController extends Controller
{
    public function __construct(
        private readonly KategoriService $kategoriService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(): View
    {
        return view('admin.kategori.index');
    }

    public function api(): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () {

            $data = $this->kategoriService->getListDataOrdered();

            return $this->responseService->successResponse(
                'Data berhasil diambil',
                $data
            );
        });
    }

    public function list(): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->kategoriService->getListData(),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton(
                        $row->id_kategori,
                        'detail'
                    ),

                    $this->transactionService->actionButton(
                        $row->id_kategori,
                        'edit'
                    ),
                ]),
            ]
        );
    }

    public function store(KategoriRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {

            $payload = $request->only([
                'nama',
                'deskripsi',
                'urutan',
                'aktif',
            ]);

            $created = $this->kategoriService->create($payload);

            return $this->responseService->successResponse(
                'Data berhasil dibuat',
                $created,
                201
            );
        });
    }

    public function update(KategoriRequest $request, string $id): JsonResponse
    {
        $data = $this->kategoriService->findById($id);

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan'
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {

            $payload = $request->only([
                'nama',
                'deskripsi',
                'urutan',
                'aktif',
            ]);

            $updatedData = $this->kategoriService->update(
                $data,
                $payload
            );

            return $this->responseService->successResponse(
                'Data berhasil diperbarui',
                $updatedData
            );
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {

            $data = $this->kategoriService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse(
                    'Data tidak ditemukan'
                );
            }

            return $this->responseService->successResponse(
                'Data berhasil diambil',
                $data
            );
        });
    }
}