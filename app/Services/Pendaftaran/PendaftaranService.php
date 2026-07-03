<?php

namespace App\Services\Pendaftaran;

use App\Models\Pendaftaran;
use Illuminate\Support\Collection;

final class PendaftaranService
{
    public function getListData(array $filters = []): Collection
    {
        $query = Pendaftaran::query()
            ->leftJoin('pengguna', 'pengguna.id_pengguna', '=', 'pendaftaran.id_pengguna')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'pendaftaran.id_kelas')
            ->select(
                'pendaftaran.*',
                'pengguna.nama as pengguna_nama',
                'kelas.banner',
                'kelas.judul as kelas_judul'
            )
            ->orderBy('pendaftaran.terdaftar_pada', 'desc');

        if (! empty($filters['id_kelas'])) {
            $query->where('pendaftaran.id_kelas', $filters['id_kelas']);
        }

        if (! empty($filters['id_pengguna'])) {
            $query->where('pendaftaran.id_pengguna', $filters['id_pengguna']);
        }

        if (! empty($filters['id_pemilik'])) {
            $query->where('kelas.id_pemilik', $filters['id_pemilik']);
        }

        if (! empty($filters['status'])) {
            $query->where('pendaftaran.status', $filters['status']);
        }

        return $query->get();
    }

    public function create(array $data): Pendaftaran
    {
        if (empty($data['terdaftar_pada'])) {
            $data['terdaftar_pada'] = now();
        }

        return Pendaftaran::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?Pendaftaran
    {
        return Pendaftaran::query()
            ->leftJoin('pengguna', 'pengguna.id_pengguna', '=', 'pendaftaran.id_pengguna')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'pendaftaran.id_kelas')
            ->select(
                'pendaftaran.*',
                'pengguna.nama as pengguna_nama',
                'kelas.judul as kelas_judul'
            )
            ->where('pendaftaran.id_pendaftaran', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->when(! empty($filters['id_pengguna']), fn ($q) => $q->where('pendaftaran.id_pengguna', $filters['id_pengguna']))
            ->first();
    }

    public function findById(string $id): ?Pendaftaran
    {
        return Pendaftaran::find($id);
    }

    public function update(Pendaftaran $pendaftaran, array $data): Pendaftaran
    {
        $pendaftaran->update($data);

        return $pendaftaran;
    }

    public function delete(Pendaftaran $pendaftaran): void
    {
        $pendaftaran->delete();
    }
}