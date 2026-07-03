<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasTargetPesertaRequest;
use App\Services\Kelas\KelasService;
use App\Services\Kelas\KelasTargetPesertaService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class KelasTargetPesertaController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasTargetPesertaService $kelasTargetPesertaService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id);

        return view('admin.kelas.kelas_target_peserta.index', ['kelas' => $kelas, 'id' => $id]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasTargetPesertaService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_target, 'detail'),
                    $this->transactionService->actionButton($row->id_target, 'edit'),
                    $this->transactionService->actionButton($row->id_target, 'delete'),
                ]),
            ]
        );
    }

    public function store(KelasTargetPesertaRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kelas',
                'target',
                'urutan',
            ]);

            $created = $this->kelasTargetPesertaService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KelasTargetPesertaRequest $request, string $id): JsonResponse
    {
        $data = $this->kelasTargetPesertaService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kelas',
                'target',
                'urutan',
            ]);

            $updatedData = $this->kelasTargetPesertaService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->kelasTargetPesertaService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->kelasTargetPesertaService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kelasTargetPesertaService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}
