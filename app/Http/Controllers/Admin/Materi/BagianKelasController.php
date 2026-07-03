<?php

namespace App\Http\Controllers\Admin\Materi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materi\BagianKelasRequest;
use App\Services\Kelas\KelasService;
use App\Services\Materi\BagianKelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class BagianKelasController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly BagianKelasService $bagianKelasService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id);

        return view('admin.kelas.bagian_kelas.index', [
            'kelas' => $kelas,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->bagianKelasService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('admin.materi.materi.index', $row->id_bagian_kelas),
                        'materi',
                        'Materi'
                    ),
                    $this->transactionService->actionButton($row->id_bagian_kelas, 'detail'),
                    $this->transactionService->actionButton($row->id_bagian_kelas, 'edit'),
                    $this->transactionService->actionButton($row->id_bagian_kelas, 'delete'),
                ]),
            ]
        );
    }

    public function store(BagianKelasRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kelas',
                'judul',
                'deskripsi',
                'urutan',
            ]);

            $created = $this->bagianKelasService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(BagianKelasRequest $request, string $id): JsonResponse
    {
        $data = $this->bagianKelasService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kelas',
                'judul',
                'deskripsi',
                'urutan',
            ]);

            $updatedData = $this->bagianKelasService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->bagianKelasService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->bagianKelasService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->bagianKelasService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}
