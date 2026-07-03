<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\App\PenggunaService;
use App\Services\Kelas\KelasService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;

final class PendaftaranController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly PenggunaService $penggunaService,
        private readonly KelasService $kelasService,
        private readonly ResponseService $responseService,
    ) {}

}
