<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\TagRequest;
use App\Services\Kelas\TagService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class TagController extends Controller
{
    public function __construct(
        private readonly TagService $TagService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(): View
    {
        return view('admin.tag.index');
    }

    public function api(): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () {
            $data = $this->TagService->getListDataOrdered();

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function list(): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->TagService->getListData(),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_tag, 'detail'),
                    $this->transactionService->actionButton($row->id_tag, 'edit'),
                ]),
            ]
        );
    }

    public function store(TagRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'nama',
                'slug',
            ]);

            $created = $this->TagService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(TagRequest $request, string $id): JsonResponse
    {
        $data = $this->TagService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'nama',
                'slug',
                'deskripsi',
                'urutan',
                'aktif',
            ]);

            $updatedData = $this->TagService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->TagService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}
