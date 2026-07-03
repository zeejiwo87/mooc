<?php

namespace App\Http\Controllers\Mentor\Materi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materi\KuisRequest;
use App\Services\Materi\KuisService;
use App\Services\Materi\MateriService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class KuisController extends Controller
{
    public function __construct(
        private readonly MateriService $materiService,
        private readonly KuisService $kuisService,
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
        $materi = $this->materiService->getDetailData($id, $this->mentorFilters());

        if (! $materi) {
            abort(404, 'Materi tidak ditemukan atau bukan milik mentor ini.');
        }

        return view('mentor.materi.kuis.index', [
            'materi' => $materi,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        $materi = $this->materiService->getDetailData($id, $this->mentorFilters());

        if (! $materi) {
            return $this->responseService->errorResponse(
                'Materi tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithDataTable(
            fn () => $this->kuisService->getListData($id, $this->mentorFilters()),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('mentor.materi.soal.index', $row->id_kuis),
                        'materi',
                        'Soal'
                    ),
                    $this->transactionService->actionButton($row->id_kuis, 'detail'),
                    $this->transactionService->actionButton($row->id_kuis, 'edit'),
                    $this->transactionService->actionButton($row->id_kuis, 'delete'),
                ]),
            ]
        );
    }

    public function store(KuisRequest $request): JsonResponse
    {
        $materi = $this->materiService->getDetailData(
            (string) $request->input('id_materi'),
            $this->mentorFilters()
        );

        if (! $materi) {
            return $this->responseService->errorResponse(
                'Materi tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = $request->only([
                'id_materi',
                'judul',
                'deskripsi',
                'instruksi',
                'tipe',
                'durasi_menit',
                'nilai_lulus',
                'tampilkan_jawaban_benar',
                'acak_soal',
                'acak_jawaban',
                'aktif',
            ]);

            $created = $this->kuisService->create($payload);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(KuisRequest $request, string $id): JsonResponse
    {
        $data = $this->kuisService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        $materi = $this->materiService->getDetailData(
            (string) $request->input('id_materi'),
            $this->mentorFilters()
        );

        if (! $materi) {
            return $this->responseService->errorResponse(
                'Materi tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = $request->only([
                'id_materi',
                'judul',
                'deskripsi',
                'instruksi',
                'tipe',
                'durasi_menit',
                'nilai_lulus',
                'tampilkan_jawaban_benar',
                'acak_soal',
                'acak_jawaban',
                'aktif',
            ]);

            $updatedData = $this->kuisService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->kuisService->getDetailData($id, $this->mentorFilters());

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
        $data = $this->kuisService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->kuisService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}