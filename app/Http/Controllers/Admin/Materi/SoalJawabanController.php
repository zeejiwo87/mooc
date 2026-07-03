<?php

namespace App\Http\Controllers\Admin\Materi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materi\SoalJawabanRequest;
use App\Services\Materi\SoalJawabanService;
use App\Services\Materi\SoalService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class SoalJawabanController extends Controller
{
    public function __construct(
        private readonly SoalService $soalService,
        private readonly SoalJawabanService $soalJawabanService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $soal = $this->soalService->getDetailData($id);

        return view('admin.materi.soal_jawaban.index', [
            'soal' => $soal,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->soalJawabanService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_soal_jawaban, 'detail'),
                    $this->transactionService->actionButton($row->id_soal_jawaban, 'edit'),
                    $this->transactionService->actionButton($row->id_soal_jawaban, 'delete'),
                ]),
            ]
        );
    }

    public function store(SoalJawabanRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_soal',
                'teks_jawaban',
                'benar',
            ]);

            $created = $this->soalJawabanService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(SoalJawabanRequest $request, string $id): JsonResponse
    {
        $data = $this->soalJawabanService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_soal',
                'teks_jawaban',
                'benar',
            ]);

            $updatedData = $this->soalJawabanService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->soalJawabanService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->soalJawabanService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->soalJawabanService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}
