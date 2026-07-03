<?php

namespace App\Http\Controllers\Mentor\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\KelasTagRequest;
use App\Services\Kelas\KelasService;
use App\Services\Kelas\KelasTagService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class KelasTagController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasTagService $kelasTagService,
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

        return view('mentor.kelas.kelas_tag.index', [
            'kelas' => $kelas,
            'id' => $id,
        ]);
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
            fn () => $this->kelasTagService->getListData($id, $this->mentorFilters()),
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
        $idKelas = (string) $request->input('id_kelas');

        $kelas = $this->kelasService->getDetailData($idKelas, $this->mentorFilters());

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

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

        $kelasLama = $this->kelasService->getDetailData((string) $idKelas, $this->mentorFilters());

        if (! $kelasLama) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        $data = $this->kelasTagService->findByIds($idKelas, $idTag);

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan.',
                404
            );
        }

        $newIdKelas = (int) $request->input('id_kelas');
        $newIdTag = (int) $request->input('id_tag');

        $kelasBaru = $this->kelasService->getDetailData((string) $newIdKelas, $this->mentorFilters());

        if (! $kelasBaru) {
            return $this->responseService->errorResponse(
                'Kelas tujuan tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data, $idKelas, $idTag, $newIdKelas, $newIdTag) {
            $payload = $request->only([
                'id_kelas',
                'id_tag',
            ]);

            $isSameRelation = $idKelas === $newIdKelas && $idTag === $newIdTag;

            if (! $isSameRelation && $this->kelasTagService->exists($newIdKelas, $newIdTag)) {
                return $this->responseService->errorResponse('Relasi sudah ada');
            }

            if ($isSameRelation) {
                return $this->responseService->successResponse('Data berhasil diperbarui', $data);
            }

            $this->kelasTagService->delete($data);
            $created = $this->kelasTagService->create($payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $created);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            [$idKelas, $idTag] = $this->parseCompositeId($id);

            $kelas = $this->kelasService->getDetailData((string) $idKelas, $this->mentorFilters());

            if (! $kelas) {
                return $this->responseService->errorResponse(
                    'Data tidak ditemukan atau bukan milik mentor ini.',
                    404
                );
            }

            $data = $this->kelasTagService->findByIds($idKelas, $idTag);

            if (! $data) {
                return $this->responseService->errorResponse(
                    'Data tidak ditemukan.',
                    404
                );
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        [$idKelas, $idTag] = $this->parseCompositeId($id);

        $kelas = $this->kelasService->getDetailData((string) $idKelas, $this->mentorFilters());

        if (! $kelas) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        $data = $this->kelasTagService->findByIds($idKelas, $idTag);

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan.',
                404
            );
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