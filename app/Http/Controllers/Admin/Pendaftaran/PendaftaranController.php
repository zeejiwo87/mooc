<?php

namespace App\Http\Controllers\Admin\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pendaftaran\PendaftaranRequest;
use App\Services\Pendaftaran\PendaftaranService;
use App\Services\Pendaftaran\ProgresKelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PendaftaranController extends Controller
{
    public function __construct(
        private readonly PendaftaranService $PendaftaranService,
        private readonly ProgresKelasService $progresKelasService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(): View
    {
        return view('admin.pendaftaran.index');
    }

    public function list(Request $request): JsonResponse
    {
        $filters = [
            'id_kelas' => $request->input('id_kelas'),
            'status' => $request->input('status'),
        ];

        return $this->transactionService->handleWithDataTable(
            fn () => $this->PendaftaranService->getListData($filters),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('admin.kelas.progres_kelas.index', $row->id_pendaftaran),
                        'materi',
                        'Progres'
                    ),
                    $this->transactionService->actionButton($row->id_pendaftaran, 'detail'),
                    $this->transactionService->actionButton($row->id_pendaftaran, 'edit'),
                ]),
            ]
        );
    }

    public function store(PendaftaranRequest $request): JsonResponse
    {
        return $this->transactionService->handleWithTransaction(function () use ($request) {
            $payload = [
                'id_pengguna' => $request->input('id_pengguna'),
                'id_kelas' => $request->input('id_kelas'),
                'status' => $request->input('status', 'aktif'),
            ];

            if ($request->filled('terdaftar_pada')) {
                $payload['terdaftar_pada'] = $request->input('terdaftar_pada');
            }

            $created = $this->PendaftaranService->create($payload);
            $this->progresKelasService->syncProgresForPendaftaran($created);

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(PendaftaranRequest $request, string $id): JsonResponse
    {
        $data = $this->PendaftaranService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        $newKelasId = (int) $request->input('id_kelas');
        $oldKelasId = (int) $data->id_kelas;

        if ($newKelasId !== $oldKelasId) {
            if ($this->progresKelasService->hasProgres($id)) {
                return $this->responseService->errorResponse(
                    'Tidak dapat mengubah kelas karena progres materi sudah ada. '.
                        'Hapus progres terlebih dahulu jika ingin memindahkan ke kelas lain.'
                );
            }
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data) {
            $payload = [
                'id_pengguna' => $request->input('id_pengguna'),
                'id_kelas' => $request->input('id_kelas'),
                'status' => $request->input('status', $data->status),
            ];

            if ($request->filled('terdaftar_pada')) {
                $payload['terdaftar_pada'] = $request->input('terdaftar_pada');
            }

            $updatedData = $this->PendaftaranService->update($data, $payload);

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->PendaftaranService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}
