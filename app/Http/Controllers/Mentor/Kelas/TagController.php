<?php

namespace App\Http\Controllers\Mentor\Kelas;

use App\Http\Controllers\Controller;
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
        return view('mentor.tag.index');
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
                ]),
            ]
        );
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
