<?php

namespace App\Http\Controllers\Mentor\Materi;

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
use Illuminate\Support\Facades\Auth;
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

    private function ownerFilters(): array
    {
        return [
            'id_pemilik' => Auth::user()->id_mentor ?? '',
        ];
    }

    public function index(string $id): View
    {
        $kuis = $this->kuisService->getDetailData($id, $this->ownerFilters());

        if (! $kuis) {
            abort(404, 'Kuis tidak ditemukan atau bukan milik mentor ini.');
        }

        return view('mentor.materi.soal.index', [
            'kuis' => $kuis,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        $kuis = $this->kuisService->getDetailData($id, $this->ownerFilters());

        if (! $kuis) {
            return $this->responseService->errorResponse(
                'Kuis tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithDataTable(
            fn () => $this->soalService->getListData($id, $this->ownerFilters()),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('mentor.materi.jawaban.index', $row->id_soal),
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
        $kuis = $this->kuisService->getDetailData(
            (string) $request->input('id_kuis'),
            $this->ownerFilters()
        );

        if (! $kuis) {
            return $this->responseService->errorResponse(
                'Kuis tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

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
                $created->update([
                    'gambar_soal' => $uploadResult['file_name'],
                ]);
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

        $kuis = $this->kuisService->getDetailData($id, $this->ownerFilters());

        if (! $kuis) {
            return $this->responseService->errorResponse(
                'Kuis tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $id) {
            try {
                $result = $this->soalImportService->importFromText(
                    (int) $id,
                    (string) $request->input('template_soal')
                );
            } catch (InvalidArgumentException $e) {
                return $this->responseService->errorResponse($e->getMessage());
            }

            return $this->responseService->successResponse('Import soal berhasil', $result, 201);
        });
    }

    public function update(SoalRequest $request, string $id): JsonResponse
    {
        $data = $this->soalService->getDetailData($id, $this->ownerFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        $kuis = $this->kuisService->getDetailData(
            (string) $request->input('id_kuis'),
            $this->ownerFilters()
        );

        if (! $kuis) {
            return $this->responseService->errorResponse(
                'Kuis tidak ditemukan atau bukan milik mentor ini.',
                404
            );
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
                $updatedData->update([
                    'gambar_soal' => $uploadResult['file_name'],
                ]);
            }

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->soalService->getDetailData($id, $this->ownerFilters());

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
        $data = $this->soalService->getDetailData($id, $this->ownerFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->soalService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}