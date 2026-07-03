<?php

namespace App\Services\Kelas;

use App\Models\KelasTujuanPembelajaran;
use Illuminate\Support\Collection;

final class KelasTujuanPembelajaranService
{
    public function getListData(string $id, ?array $filters = []): Collection
    {
        return KelasTujuanPembelajaran::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_tujuan_pembelajaran.id_kelas')
            ->select(
                'kelas_tujuan_pembelajaran.*',
                'kelas.judul as kelas_judul'
            )
            ->where('kelas_tujuan_pembelajaran.id_kelas', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('kelas_tujuan_pembelajaran.urutan')
            ->get();
    }

    public function create(array $data): KelasTujuanPembelajaran
    {
        return KelasTujuanPembelajaran::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?KelasTujuanPembelajaran
    {
        return KelasTujuanPembelajaran::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_tujuan_pembelajaran.id_kelas')
            ->select(
                'kelas_tujuan_pembelajaran.*',
                'kelas.judul as kelas_judul'
            )
            ->where('kelas_tujuan_pembelajaran.id_tujuan', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->first();
    }

    public function findById(string $id): ?KelasTujuanPembelajaran
    {
        return KelasTujuanPembelajaran::find($id);
    }

    public function update(KelasTujuanPembelajaran $kelasTujuanPembelajaran, array $data): KelasTujuanPembelajaran
    {
        $kelasTujuanPembelajaran->update($data);

        return $kelasTujuanPembelajaran;
    }

    public function delete(KelasTujuanPembelajaran $kelasTujuanPembelajaran): void
    {
        $kelasTujuanPembelajaran->delete();
    }
}
