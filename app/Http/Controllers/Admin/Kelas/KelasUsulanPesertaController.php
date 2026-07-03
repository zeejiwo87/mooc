<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Services\Kelas\KelasService;
use App\Services\Kelas\KelasUsulanPesertaService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

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
        $kelas = $this->kelasService->getDetailData($id);

        return view('admin.kelas.kelas_usulan.index', ['kelas' => $kelas, 'id' => $id]);
    }

    public function list(string $id): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->kelasUsulanPesertaService->getListData($id)
        );
    }
}
