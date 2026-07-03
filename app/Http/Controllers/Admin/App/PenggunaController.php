<?php

namespace App\Http\Controllers\Admin\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\PenggunaStoreRequest;
use App\Http\Requests\App\PenggunaUpdateRequest;
use App\Services\App\PenggunaService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class PenggunaController extends Controller
{
    public function __construct(
        private readonly PenggunaService $penggunaService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(): View
    {
        return view('admin.pengguna.index');
    }

    public function api(): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () {
            $data = $this->penggunaService->getListDataOrdered();

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function list(): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->penggunaService->getListData(),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_pengguna, 'detail'),
                    $this->transactionService->actionButton($row->id_pengguna, 'edit'),
                ]),
            ]
        );
    }

    public function store(PenggunaStoreRequest $request): JsonResponse
    {
        $fotoProfil = $request->file('foto_profil');

        if ($this->penggunaService->checkDuplicateForStore($request->email)) {
            return $this->responseService->errorResponse('Email sudah digunakan.');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $fotoProfil) {
            $payload = $request->only([
                'nama',
                'email',
                'password',
                'bio',
                'telepon',
                'terverifikasi',
            ]);

            $payload['password'] = bcrypt($payload['password']);

            $created = $this->penggunaService->create($payload);

            if ($fotoProfil) {
                $this->penggunaService->handleFileUpload($fotoProfil, $created);
            }

            return $this->responseService->successResponse('Data pengguna berhasil ditambahkan', $created, 201);
        });
    }

    public function update(PenggunaUpdateRequest $request, string $id): JsonResponse
    {
        $data = $this->penggunaService->findById($id);

        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        $fotoProfil = $request->file('foto_profil');

        if ($this->penggunaService->checkDuplicateForUpdate($id, $request->email)) {
            return $this->responseService->errorResponse('Email sudah digunakan.');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data, $fotoProfil) {
            $payload = $request->only([
                'nama',
                'email',
                'bio',
                'telepon',
                'terverifikasi',
            ]);

            if ($request->filled('password')) {
                $payload['password'] = bcrypt($request->input('password'));
            }

            $updatedData = $this->penggunaService->update($data, $payload);

            if ($fotoProfil) {
                $this->penggunaService->handleFileUpload($fotoProfil, $updatedData);
            }

            return $this->responseService->successResponse('Data pengguna berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->penggunaService->getDetailData($id);

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}