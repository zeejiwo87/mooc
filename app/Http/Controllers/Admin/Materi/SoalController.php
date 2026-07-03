<?php

namespace App\Http\Controllers\Admin\Materi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materi\SoalRequest;
use App\Services\Materi\KuisService;
use App\Services\Materi\SoalImportService;
use App\Services\Materi\SoalService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

final class SoalController extends Controller
{
    public function __construct(
        private readonly KuisService $kuisService,
        private readonly SoalService $soalService,
        private readonly SoalImportService $soalImportService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $kuis = $this->kuisService->getDetailData($id);

        return view('admin.materi.soal.index', [
            'kuis' => $kuis,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->soalService->getListData($id),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('admin.materi.jawaban.index', $row->id_soal),
                        'materi',
                        'Jawaban'
                    ),
                    $this->transactionService->actionButton($row->id_soal, 'detail'),
                    $this->transactionService->actionButton($row->id_soal, 'edit'),
                    $this->transactionService->actionButton($row->id_soal, 'delete'),
                ]),
            ]
        );
    }

    public function store(SoalRequest $request): JsonResponse
    {
        $gambarSoal = $request->file('gambar_soal');

        return $this->transactionService->handleWithTransaction(function () use ($request, $gambarSoal) {
            $payload = $request->only([
                'id_kuis',
                'teks_soal',
                'nilai',
                'penjelasan',
            ]);

            $created = $this->soalService->create($payload);

            $uploadResult = $this->soalService->handleFileUpload($gambarSoal, $created);

            if ($uploadResult) {
                $created->update(['gambar_soal' => $uploadResult['file_name']]);
            }

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function import(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'template_soal' => 'required|string',
        ], [
            'template_soal.required' => 'Template soal wajib diisi.',
        ]);

        return $this->transactionService->handleWithTransaction(function () use ($request, $id) {
            $kuis = $this->kuisService->findById($id);

            if (! $kuis) {
                return $this->responseService->errorResponse('Kuis tidak ditemukan.');
            }

            try {
                $result = $this->soalImportService->importFromText((int) $id, (string) $request->input('template_soal'));
            } catch (InvalidArgumentException $e) {
                return $this->responseService->errorResponse($e->getMessage());
            }

            return $this->responseService->successResponse(
                'Import soal berhasil',
                $result,
                201
            );
        });
    }

    public function update(SoalRequest $request, string $id): JsonResponse
    {
        $data = $this->soalService->findById($id);

        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        $gambarSoal = $request->file('gambar_soal');

        return $this->transactionService->handleWithTransaction(function () use ($request, $data, $gambarSoal) {
            $payload = $request->only([
                'id_kuis',
                'teks_soal',
                'nilai',
                'penjelasan',
            ]);

            $updatedData = $this->soalService->update($data, $payload);

            $uploadResult = $this->soalService->handleFileUpload($gambarSoal, $updatedData);

            if ($uploadResult) {
                $updatedData->update(['gambar_soal' => $uploadResult['file_name']]);
            }

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->soalService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        $data = $this->soalService->findById($id);

        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->soalService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}