<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\App\MentorService;
use App\Services\Kelas\KategoriService;
use App\Services\Kelas\KategoriSubService;
use App\Services\Kelas\TagService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Http\JsonResponse;

final class KelasController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly KategoriService $kategoriService,
        private readonly KategoriSubService $kategoriSubService,
        private readonly TagService $tagService,
        private readonly MentorService $mentorService,
        private readonly ResponseService $responseService,
    ) {}

    public function tag(): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () {
            $data = $this->tagService->getListDataOrdered();

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}
