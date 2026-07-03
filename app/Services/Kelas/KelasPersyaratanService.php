<?php

namespace App\Services\Kelas;

use App\Models\KelasPersyaratan;
use Illuminate\Support\Collection;

final class KelasPersyaratanService
{
    public function getListData(string $id, ?array $filters = []): Collection
    {
        return KelasPersyaratan::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_persyaratan.id_kelas')
            ->select(
                'kelas_persyaratan.*',
                'kelas.judul as kelas_judul'
            )
            ->where('kelas_persyaratan.id_kelas', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('kelas_persyaratan.urutan')
            ->get();
    }

    public function create(array $data): KelasPersyaratan
    {
        return KelasPersyaratan::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?KelasPersyaratan
    {
        return KelasPersyaratan::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_persyaratan.id_kelas')
            ->select(
                'kelas_persyaratan.*',
                'kelas.judul as kelas_judul'
            )
            ->where('kelas_persyaratan.id_persyaratan', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->first();
    }

    public function findById(string $id): ?KelasPersyaratan
    {
        return KelasPersyaratan::find($id);
    }

    public function update(KelasPersyaratan $kelasPersyaratan, array $data): KelasPersyaratan
    {
        $kelasPersyaratan->update($data);

        return $kelasPersyaratan;
    }

    public function delete(KelasPersyaratan $kelasPersyaratan): void
    {
        $kelasPersyaratan->delete();
    }
}
