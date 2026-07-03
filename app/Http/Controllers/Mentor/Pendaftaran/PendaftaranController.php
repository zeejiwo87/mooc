<?php

namespace App\Http\Controllers\Mentor\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Services\Pendaftaran\PendaftaranService;
use App\Services\Pendaftaran\ProgresKelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('mentor.pendaftaran.index');
    }

    public function list(Request $request): JsonResponse
    {
        $filters = [
            'id_kelas' => $request->input('id_kelas'),
            'status' => $request->input('status'),
            'id_pemilik' => Auth::user()->id_mentor ?? '',
        ];

        return $this->transactionService->handleWithDataTable(
            fn () => $this->PendaftaranService->getListData($filters),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionLink(
                        route('mentor.kelas.progres_kelas.index', $row->id_pendaftaran),
                        'materi',
                        'Progres'
                    ),
                    $this->transactionService->actionButton($row->id_pendaftaran, 'detail'),
                ]),
            ]
        );
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $filters = [
                'id_pemilik' => Auth::user()->id_mentor ?? '',
            ];
            $data = $this->PendaftaranService->getDetailData($id, $filters);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}
