<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasTagRequest;
use App\Services\Kelas\KelasService;
use App\Services\Kelas\KelasTagService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class KelasTagController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasTagService $kelasTagService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id);

        return view('admin.kelas.kelas_tag.index', ['kelas' => $kelas, 'id' => $id]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasTagService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_kelas.':'.$row->id_tag, 'detail'),
                    $this->transactionService->actionButton($row->id_kelas.':'.$row->id_tag, 'edit'),
                    $this->transactionService->actionButton($row->id_kelas.':'.$row->id_tag, 'delete'),
                ]),
            ]
        );
    }

    public function store(KelasTagRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kelas',
                'id_tag',
            ]);

            if ($this->kelasTagService->exists((int) $payload['id_kelas'], (int) $payload['id_tag'])) {
                return $this->responseService->errorResponse('Relasi sudah ada');
            }

            $created = $this->kelasTagService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KelasTagRequest $request, string $id): JsonResponse
    {
        [$idKelas, $idTag] = $this->parseCompositeId($id);
        $data = $this->kelasTagService->findByIds($idKelas, $idTag);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kelas',
                'id_tag',
            ]);

            $newIdKelas = (int) $payload['id_kelas'];
            $newIdTag = (int) $payload['id_tag'];

            if ($this->kelasTagService->exists($newIdKelas, $newIdTag)) {
                return $this->responseService->errorResponse('Relasi sudah ada');
            }

            // Karena tidak ada primary key, gunakan pendekatan hapus lalu buat ulang
            $this->kelasTagService->delete($data);
            $created = $this->kelasTagService->create($payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $created);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            [$idKelas, $idTag] = $this->parseCompositeId($id);
            $data = $this->kelasTagService->findByIds($idKelas, $idTag);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        [$idKelas, $idTag] = $this->parseCompositeId($id);
        $data = $this->kelasTagService->findByIds($idKelas, $idTag);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kelasTagService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }

    private function parseCompositeId(string $id): array
    {
        $parts = explode(':', $id);
        if (count($parts) !== 2) {
            return [0, 0];
        }

        return [(int) $parts[0], (int) $parts[1]];
    }
}
