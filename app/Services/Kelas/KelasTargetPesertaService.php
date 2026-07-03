<?php

namespace App\Services\Kelas;

use App\Models\KelasTargetPeserta;
use Illuminate\Support\Collection;

final class KelasTargetPesertaService
{
    public function getListData(string $id, ?array $filters = []): Collection
    {
        return KelasTargetPeserta::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_target_peserta.id_kelas')
            ->select(
                'kelas_target_peserta.*',
                'kelas.judul as kelas_judul'
            )
            ->where('kelas_target_peserta.id_kelas', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('kelas_target_peserta.urutan')
            ->get();
    }

    public function create(array $data): KelasTargetPeserta
    {
        return KelasTargetPeserta::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?KelasTargetPeserta
    {
        return KelasTargetPeserta::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_target_peserta.id_kelas')
            ->select(
                'kelas_target_peserta.*',
                'kelas.judul as kelas_judul'
            )
            ->where('kelas_target_peserta.id_target', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->first();
    }

    public function findById(string $id): ?KelasTargetPeserta
    {
        return KelasTargetPeserta::find($id);
    }

    public function update(KelasTargetPeserta $kelasTargetPeserta, array $data): KelasTargetPeserta
    {
        $kelasTargetPeserta->update($data);

        return $kelasTargetPeserta;
    }

    public function delete(KelasTargetPeserta $kelasTargetPeserta): void
    {
        $kelasTargetPeserta->delete();
    }
}
