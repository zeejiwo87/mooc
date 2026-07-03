<?php

namespace App\Http\Controllers\Admin\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\MentorStoreRequest;
use App\Http\Requests\App\MentorUpdateRequest;
use App\Services\App\MentorService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

final class MentorController extends Controller
{
    public function __construct(
        private readonly MentorService $mentorService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
    ) {}

    public function index(): View
    {
        return view('admin.mentor.index');
    }

    public function api(): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () {
            $data = $this->mentorService->getListDataOrdered();

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function list(): JsonResponse
    {
        return $this->transactionService->handleWithDataTable(
            fn () => $this->mentorService->getListData(),
            [
                'action' => fn ($row) => implode(' ', [
                    $this->transactionService->actionButton($row->id_mentor, 'detail'),
                    $this->transactionService->actionButton($row->id_mentor, 'edit'),
                ]),
            ]
        );
    }

    public function store(MentorStoreRequest $request): JsonResponse
    {
        $fotoProfil = $request->file('foto_profil');

        if ($this->mentorService->checkDuplicateForStore($request->email)) {
            return $this->responseService->errorResponse('Email sudah digunakan.');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $fotoProfil) {
            $payload = $request->only([
                'nama',
                'email',
                'password',
                'bio',
                'spesialisasi',
            ]);
            $payload['password']= bcrypt($payload['password']);
            $created = $this->mentorService->create($payload);

            if ($fotoProfil) {
                $uploadResult = $this->mentorService->handleFileUpload($fotoProfil);
                $created->update(['foto_profil' => $uploadResult['file_name']]);
            }

            return $this->responseService->successResponse('Data berhasil dibuat', $created, 201);
        });
    }

    public function update(MentorUpdateRequest $request, string $id): JsonResponse
    {
        $data = $this->mentorService->findById($id);
        if (! $data) {
            return $this->responseService->errorResponse('Data tidak ditemukan');
        }

        $fotoProfil = $request->file('foto_profil');

        if ($this->mentorService->checkDuplicateForUpdate($id, $request->email)) {
            return $this->responseService->errorResponse('Email sudah digunakan.');
        }

        return $this->transactionService->handleWithTransaction(function () use ($request, $data, $fotoProfil) {
            $payload = $request->only([
                'nama',
                'email',
                'bio',
                'spesialisasi',
            ]);

            if ($request->filled('password')) {
                $payload['password'] = bcrypt($request->input('password'));
            }

            $updatedData = $this->mentorService->update($data, $payload);

            if ($fotoProfil) {
                $uploadResult = $this->mentorService->handleFileUpload($fotoProfil, $updatedData);
                $updatedData->update(['foto_profil' => $uploadResult['file_name']]);
            }

            return $this->responseService->successResponse('Data berhasil diperbarui', $updatedData);
        });
    }

    public function show(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->mentorService->getDetailData($id);

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }
}
