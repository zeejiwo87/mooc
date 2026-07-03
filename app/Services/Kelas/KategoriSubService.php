<?php

namespace App\Services\Kelas;

use App\Models\KategoriSub;
use App\Services\Tools\FileUploadService;
use Illuminate\Support\Collection;

final class KategoriSubService
{
    public function __construct(
        private readonly FileUploadService $fileUploadService,
    ) {}

    public function getListData(): Collection
    {
        return KategoriSub::query()
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'kategori_sub.id_kategori')
            ->select(
                'kategori_sub.*',
                'kategori.nama as kategori_nama',
            )
            ->orderBy('kategori_sub.urutan')
            ->get();
    }

    public function getListDataOrdered(string $idKategori): Collection
    {
        return KategoriSub::select('id_kategori_sub', 'nama')
            ->where('id_kategori', $idKategori)
            ->get();
    }

    public function create(array $data): KategoriSub
    {

        return KategoriSub::create($data);
    }

    public function getDetailData(string $id): ?KategoriSub
    {
        return KategoriSub::query()
            ->leftJoin('kategori', 'kategori.id_kategori', '=', 'kategori_sub.id_kategori')
            ->select(
                'kategori_sub.*',
                'kategori.nama as kategori_nama',
            )
            ->where('kategori_sub.id_kategori_sub', $id)
            ->first();
    }

    public function findById(string $id): ?KategoriSub
    {

        return KategoriSub::find($id);
    }

    public function update(KategoriSub $kategoriSub, array $data): KategoriSub
    {

        $kategoriSub->update($data);

        return $kategoriSub;
    }

    public function delete(KategoriSub $kategoriSub): void
    {
        $kategoriSub->delete();
    }
}
