<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasMentorRequest;
use App\Services\Kelas\KelasMentorService;
use App\Services\Kelas\KelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class KelasMentorController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasMentorService $kelasMentorService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id);

        if (! $kelas) {
            abort(404, 'Kelas tidak ditemukan.');
        }

        return view('admin.kelas.kelas_mentor.index', [
            'kelas' => $kelas,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasMentorService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_kelas_mentor, 'detail'),
                    $this->transactionService->actionButton($row->id_kelas_mentor, 'edit'),
                    $this->transactionService->actionButton($row->id_kelas_mentor, 'delete'),
                ]),
            ]
        );
    }

    public function store(KelasMentorRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kelas',
                'id_mentor',
                'peran',
            ]);

            $created = $this->kelasMentorService->create($payload);

            return $this->responseService->successResponse(
                'Asisten mentor berhasil ditambahkan.',
                $created,
                201
            );
        });
    }

    public function update(KelasMentorRequest $request, string $id): JsonResponse
    {
        $data = $this->kelasMentorService->findById($id);

        if (! $data) {
            return $this->responseService->errorResponse('Asisten mentor tidak ditemukan.');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kelas',
                'id_mentor',
                'peran',
            ]);

            $updatedData = $this->kelasMentorService->update($data, $payload);

            return $this->responseService->successResponse(
                'Asisten mentor berhasil diperbarui.',
                $updatedData
            );
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->kelasMentorService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Asisten mentor tidak ditemukan.');
            }

            return $this->responseService->successResponse(
                'Data asisten mentor berhasil diambil.',
                $data
            );
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->kelasMentorService->findById($id);

        if (! $data) {
            return $this->responseService->errorResponse('Asisten mentor tidak ditemukan.');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kelasMentorService->delete($data);

            return $this->responseService->successResponse(
                'Asisten mentor berhasil dihapus.'
            );
        });
    }
}