<?php

namespace App\Services\Materi;

use App\Models\SoalJawaban;
use Illuminate\Support\Collection;

final class SoalJawabanService
{
    public function getListData(string $id_soal, ?array $filters = []): Collection
    {
        return SoalJawaban::query()
            ->leftJoin('soal', 'soal.id_soal', '=', 'soal_jawaban.id_soal')
            ->leftJoin('kuis', 'kuis.id_kuis', '=', 'soal.id_kuis')
            ->leftJoin('materi', 'materi.id_materi', '=', 'kuis.id_materi')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'soal_jawaban.*',
                'soal.teks_soal as soal_teks_soal',
                'kuis.judul as kuis_judul',
                'materi.judul as materi_judul',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('soal_jawaban.id_soal', $id_soal)
            ->when(
                ! empty($filters['id_pemilik']),
                fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik'])
            )
            ->orderBy('soal_jawaban.id_soal_jawaban')
            ->get();
    }

    public function create(array $data): SoalJawaban
    {
        return SoalJawaban::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?SoalJawaban
    {
        return SoalJawaban::query()
            ->leftJoin('soal', 'soal.id_soal', '=', 'soal_jawaban.id_soal')
            ->leftJoin('kuis', 'kuis.id_kuis', '=', 'soal.id_kuis')
            ->leftJoin('materi', 'materi.id_materi', '=', 'kuis.id_materi')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'soal_jawaban.*',
                'soal.teks_soal as soal_teks_soal',
                'kuis.judul as kuis_judul',
                'materi.judul as materi_judul',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('soal_jawaban.id_soal_jawaban', $id)
            ->when(
                ! empty($filters['id_pemilik']),
                fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik'])
            )
            ->first();
    }

    public function findById(string $id): ?SoalJawaban
    {
        return SoalJawaban::find($id);
    }

    public function update(SoalJawaban $soalJawaban, array $data): SoalJawaban
    {
        $soalJawaban->update($data);

        return $soalJawaban;
    }

    public function delete(SoalJawaban $soalJawaban): void
    {
        $soalJawaban->delete();
    }
}