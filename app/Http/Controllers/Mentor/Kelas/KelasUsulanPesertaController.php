<?php

namespace App\Http\Controllers\Mentor\Kelas;

use App\Http\Controllers\Controller;
use App\Services\Kelas\KelasService;
use App\Services\Kelas\KelasUsulanPesertaService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class KelasUsulanPesertaController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService,
        private readonly KelasUsulanPesertaService $kelasUsulanPesertaService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(string $id): View
    {
        $filters = [
            'id_pemilik' => Auth::user()->id_mentor ?? '',
        ];

        $kelas = $this->kelasService->getDetailData($id, $filters);

        return view('mentor.kelas.kelas_usulan.index', ['kelas' => $kelas, 'id' => $id]);
    }

    public function list(string $id): JsonResponse
    {
        $filters = [
            'id_pemilik' => Auth::user()->id_mentor ?? '',
        ];

        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasUsulanPesertaService->getListData($id, $filters)
        );
    }
}
