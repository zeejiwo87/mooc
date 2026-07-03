<?php

namespace App\Services\Kelas;

use App\Models\Kategori;
use App\Services\Tools\FileUploadService;
use Illuminate\Support\Collection;

final class KategoriService
{
    public function __construct(
        private readonly FileUploadService $fileUploadService,
    ) {}

    public function getListData(): Collection
    {
        return Kategori::orderBy('urutan')->get();
    }

    public function getListDataOrdered(): Collection
    {
        return Kategori::select('id_kategori', 'nama')->get();
    }

    public function create(array $data): Kategori
    {
        return Kategori::create($data);
    }

    public function getDetailData(string $id): ?Kategori
    {
        return Kategori::find($id);
    }

    public function findById(string $id): ?Kategori
    {
        return Kategori::find($id);
    }

    public function update(Kategori $kategori, array $data): Kategori
    {

        $kategori->update($data);

        return $kategori;
    }

    public function delete(Kategori $kategori): void
    {
        $kategori->delete();
    }
}
