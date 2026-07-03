<?php

namespace App\Services\Kelas;

use App\Models\KelasUsulanPeserta;
use Illuminate\Support\Collection;

final class KelasUsulanPesertaService
{
    public function getListData(string $id, ?array $filters = []): Collection
    {
        return KelasUsulanPeserta::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_usulan.id_kelas')
            ->leftJoin('pengguna', 'pengguna.id_pengguna', '=', 'kelas_usulan.id_pengguna')
            ->select(
                'kelas_usulan.*',
                'kelas.judul as kelas_judul',
                'pengguna.nama as pengguna_nama'
            )
            ->where('kelas_usulan.id_kelas', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('kelas_usulan.id_kelas_usulan')
            ->get();
    }

    public function create(array $data): KelasUsulanPeserta
    {
        return KelasUsulanPeserta::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?KelasUsulanPeserta
    {
        return KelasUsulanPeserta::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_usulan.id_kelas')
            ->leftJoin('pengguna', 'pengguna.id_pengguna', '=', 'kelas_usulan.id_pengguna')
            ->select(
                'kelas_usulan.*',
                'kelas.judul as kelas_judul',
                'pengguna.nama as pengguna_nama'
            )
            ->where('kelas_usulan.id_kelas_usulan', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->first();
    }

    public function findById(string $id): ?KelasUsulanPeserta
    {
        return KelasUsulanPeserta::find($id);
    }

    public function update(KelasUsulanPeserta $kelasUsulanPeserta, array $data): KelasUsulanPeserta
    {
        $kelasUsulanPeserta->update($data);

        return $kelasUsulanPeserta;
    }

    public function delete(KelasUsulanPeserta $kelasUsulanPeserta): void
    {
        $kelasUsulanPeserta->delete();
    }
}
