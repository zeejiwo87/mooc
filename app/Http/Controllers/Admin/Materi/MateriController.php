<?php

namespace App\Http\Controllers\Admin\Materi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materi\MateriRequest;
use App\Services\Materi\BagianKelasService;
use App\Services\Materi\MateriService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class MateriController extends Controller
{
    public function __construct(
        private readonly BagianKelasService $bagianKelasService,
        private readonly MateriService $materiService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $bagian = $this->bagianKelasService->getDetailData($id);

        return view('admin.materi.materi.index', [
            'bagian_kelas' => $bagian,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->materiService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('admin.materi.kuis.index', $row->id_materi),
                        'materi',
                        'Kuis'
                    ),
                    $this->transactionService->actionButton($row->id_materi, 'detail'),
                    $this->transactionService->actionButton($row->id_materi, 'edit'),
                    $this->transactionService->actionButton($row->id_materi, 'delete'),
                ]),
            ]
        );
    }

    public function store(MateriRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_bagian_kelas',
                'judul',
                'tipe',
                'content',
                'url_video',
                'url_lampiran',
                'urutan',
                'durasi_detik',
                'preview',
            ]);

            $created = $this->materiService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(MateriRequest $request, string $id): JsonResponse
    {
        $data = $this->materiService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_bagian_kelas',
                'judul',
                'tipe',
                'content',
                'url_video',
                'url_lampiran',
                'urutan',
                'durasi_detik',
                'preview',
            ]);

            $updatedData = $this->materiService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->materiService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->materiService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->materiService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}
