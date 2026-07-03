<?php

namespace App\Http\Controllers\Mentor\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasMentorRequest;
use App\Services\App\MentorService;
use App\Services\Kelas\KelasMentorService;
use App\Services\Kelas\KelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class KelasMentorController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly MentorService $mentorService,
        private readonly KelasMentorService $kelasMentorService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    private function mentorFilters(): array
    {
        return [
            'id_pemilik' => Auth::user()->id_mentor ?? '',
        ];
    }

    public function index(string $id): View
    {
        $kelas = $this->kelasService->getDetailData($id, $this->mentorFilters());

        if (! $kelas) {
            abort(404, 'Kelas tidak ditemukan atau bukan milik mentor ini.');
        }

        return view('mentor.kelas.kelas_mentor.index', [
            'kelas' => $kelas,
            'id' => $id,
        ]);
    }

    public function api(): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () {
            $data = $this->mentorService->getListDataOrdered();

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function list(string $id): JsonResponse
    {
        $kelas = $this->kelasService->getDetailData($id, $this->mentorFilters());

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasMentorService->getListData($id, $this->mentorFilters()),
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
        $kelas = $this->kelasService->getDetailData(
            (string) $request->input('id_kelas'),
            $this->mentorFilters()
        );

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_kelas',
                'id_mentor',
                'peran',
            ]);

            $created = $this->kelasMentorService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KelasMentorRequest $request, string $id): JsonResponse
    {
        $data = $this->kelasMentorService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        $kelas = $this->kelasService->getDetailData(
            (string) $request->input('id_kelas'),
            $this->mentorFilters()
        );

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Kelas tujuan tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_kelas',
                'id_mentor',
                'peran',
            ]);

            $updatedData = $this->kelasMentorService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->kelasMentorService->getDetailData($id, $this->mentorFilters());

            if (! $data) {
                return $this->responseService->errorResponse(
                    'Data tidak ditemukan atau bukan milik mentor ini.',
                    404
                );
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->kelasMentorService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kelasMentorService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}