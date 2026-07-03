<?php

namespace App\Services\Materi;

use App\Models\Soal;
use App\Services\Tools\FileUploadService;
use Illuminate\Support\Collection;

final class SoalService
{
    public function __construct(
        private readonly FileUploadService $fileUploadService,
    ) {}

    public function getListData(string $id_kuis, ?array $filters = []): Collection
    {
        return Soal::query()
            ->leftJoin('kuis', 'kuis.id_kuis', '=', 'soal.id_kuis')
            ->leftJoin('materi', 'materi.id_materi', '=', 'kuis.id_materi')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'soal.*',
                'kuis.judul as kuis_judul',
                'materi.judul as materi_judul',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('soal.id_kuis', $id_kuis)
            ->when(
                ! empty($filters['id_pemilik']),
                fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik'])
            )
            ->orderBy('soal.id_soal')
            ->get();
    }

    public function create(array $data): Soal
    {
        return Soal::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?Soal
    {
        return Soal::query()
            ->leftJoin('kuis', 'kuis.id_kuis', '=', 'soal.id_kuis')
            ->leftJoin('materi', 'materi.id_materi', '=', 'kuis.id_materi')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'soal.*',
                'kuis.judul as kuis_judul',
                'materi.judul as materi_judul',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('soal.id_soal', $id)
            ->when(
                ! empty($filters['id_pemilik']),
                fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik'])
            )
            ->first();
    }

    public function findById(string $id): ?Soal
    {
        return Soal::find($id);
    }

    public function update(Soal $soal, array $data): Soal
    {
        $soal->update($data);

        return $soal;
    }

    public function delete(Soal $soal): void
    {
        $soal->delete();
    }

    public function handleFileUpload($gambar_soal, ?Soal $soal = null): ?array
    {
        if (! $gambar_soal) {
            return null;
        }

        if ($soal && $soal->gambar_soal) {
            return $this->fileUploadService->updateFileByType($gambar_soal, $soal->gambar_soal, 'soal');
        }

        return $this->fileUploadService->uploadByType($gambar_soal, 'soal');
    }
}