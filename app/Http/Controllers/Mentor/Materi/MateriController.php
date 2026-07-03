<?php

namespace App\Http\Controllers\Mentor\Materi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Materi\MateriRequest;
use App\Services\Materi\BagianKelasService;
use App\Services\Materi\MateriService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class MateriController extends Controller
{
    public function __construct(
        private readonly BagianKelasService $bagianKelasService,
        private readonly MateriService $materiService,
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
        $bagian = $this->bagianKelasService->getDetailData($id, $this->mentorFilters());

        if (! $bagian) {
            abort(404, 'Bagian kelas tidak ditemukan atau bukan milik mentor ini.');
        }

        return view('mentor.materi.materi.index', [
            'bagian_kelas' => $bagian,
            'id' => $id,
        ]);
    }

    public function list(string $id): JsonResponse
    {
        $bagian = $this->bagianKelasService->getDetailData($id, $this->mentorFilters());

        if (! $bagian) {
            return $this->responseService->errorResponse(
                'Bagian kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithDataTable(
            fn () => $this->materiService->getListData($id, $this->mentorFilters()),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('mentor.materi.kuis.index', $row->id_materi),
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
        $bagian = $this->bagianKelasService->getDetailData(
            (string) $request->input('id_bagian_kelas'),
            $this->mentorFilters()
        );

        if (! $bagian) {
            return $this->responseService->errorResponse(
                'Bagian kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

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
        $data = $this->materiService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        $bagian = $this->bagianKelasService->getDetailData(
            (string) $request->input('id_bagian_kelas'),
            $this->mentorFilters()
        );

        if (! $bagian) {
            return $this->responseService->errorResponse(
                'Bagian kelas tidak ditemukan atau bukan milik mentor ini.',
                404
            );
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
            $data = $this->materiService->getDetailData($id, $this->mentorFilters());

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
        $data = $this->materiService->getDetailData($id, $this->mentorFilters());

        if (! $data) {
            return $this->responseService->errorResponse(
                'Data tidak ditemukan atau bukan milik mentor ini.',
                404
            );
        }

        return $this->transactionService->handleWithTransaction(function () use ($data) {
            $this->materiService->delete($data);

            return $this->responseService->successResponse('Data berhasil dihapus');
        });
    }
}