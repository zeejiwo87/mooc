<?php

namespace App\Http\Controllers\Mentor\Kelas;

use App\Http\Controllers\Controller;
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
        return view('mentor.kategori_sub.index');
    }

    public function list(): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->KategoriSubService->getListData(),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_kategori_sub, 'detail'),
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
