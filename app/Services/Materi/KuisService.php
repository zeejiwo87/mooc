<?php

namespace App\Services\Materi;

use App\Models\Kuis;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class KuisService
{
    public function getListData(string $id_materi, ?array $filters = []): Collection
    {
        return Kuis::query()
            ->leftJoin('materi', 'materi.id_materi', '=', 'kuis.id_materi')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'kuis.*',
                'materi.judul as materi_judul',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('kuis.id_materi', $id_materi)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('kuis.id_kuis')
            ->get();
    }

    public function create(array $data): Kuis
    {
        return Kuis::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?Kuis
    {
        return Kuis::query()
            ->leftJoin('materi', 'materi.id_materi', '=', 'kuis.id_materi')
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'kuis.*',
                'materi.judul as materi_judul',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('kuis.id_kuis', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->first();
    }

    public function findById(string $id): ?Kuis
    {
        return Kuis::find($id);
    }

    public function update(Kuis $kuis, array $data): Kuis
    {
        $kuis->update($data);

        return $kuis;
    }

    public function delete(Kuis $kuis): void
    {
        DB::transaction(function () use ($kuis) {
            $idKuis = (int) $kuis->id_kuis;

            /*
            |--------------------------------------------------------------------------
            | Ambil semua soal dari kuis
            |--------------------------------------------------------------------------
            */

            $soalIds = DB::table('soal')
                ->where('id_kuis', $idKuis)
                ->pluck('id_soal');

            /*
            |--------------------------------------------------------------------------
            | Ambil semua jawaban dari soal
            |--------------------------------------------------------------------------
            */

            $soalJawabanIds = collect();

            if ($soalIds->isNotEmpty()) {
                $soalJawabanIds = DB::table('soal_jawaban')
                    ->whereIn('id_soal', $soalIds)
                    ->pluck('id_soal_jawaban');
            }

            /*
            |--------------------------------------------------------------------------
            | Ambil progres kuis
            |--------------------------------------------------------------------------
            | progres_kuis punya foreign key ke kuis.
            | Jadi harus dibersihkan sebelum kuis dihapus.
            */

            $progresKuisIds = DB::table('progres_kuis')
                ->where('id_kuis', $idKuis)
                ->pluck('id_progres_kuis');

            /*
            |--------------------------------------------------------------------------
            | Hapus progres jawaban dulu
            |--------------------------------------------------------------------------
            | progres_jawaban punya foreign key ke:
            | - progres_kuis
            | - soal
            | - soal_jawaban
            |
            | Kalau soal/jawaban/progres_kuis dihapus duluan, delete bisa gagal.
            */

            if ($progresKuisIds->isNotEmpty() || $soalIds->isNotEmpty() || $soalJawabanIds->isNotEmpty()) {
                DB::table('progres_jawaban')
                    ->where(function ($query) use ($progresKuisIds, $soalIds, $soalJawabanIds) {
                        if ($progresKuisIds->isNotEmpty()) {
                            $query->whereIn('id_progres_kuis', $progresKuisIds);
                        }

                        if ($soalIds->isNotEmpty()) {
                            if ($progresKuisIds->isNotEmpty()) {
                                $query->orWhereIn('id_soal', $soalIds);
                            } else {
                                $query->whereIn('id_soal', $soalIds);
                            }
                        }

                        if ($soalJawabanIds->isNotEmpty()) {
                            if ($progresKuisIds->isNotEmpty() || $soalIds->isNotEmpty()) {
                                $query->orWhereIn('id_soal_jawaban', $soalJawabanIds);
                            } else {
                                $query->whereIn('id_soal_jawaban', $soalJawabanIds);
                            }
                        }
                    })
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus histori progres kuis
            |--------------------------------------------------------------------------
            */

            if ($progresKuisIds->isNotEmpty()) {
                DB::table('progres_kuis_histori')
                    ->whereIn('id_progres_kuis', $progresKuisIds)
                    ->delete();

                DB::table('progres_kuis')
                    ->whereIn('id_progres_kuis', $progresKuisIds)
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus jawaban soal dan soal
            |--------------------------------------------------------------------------
            */

            if ($soalIds->isNotEmpty()) {
                DB::table('soal_jawaban')
                    ->whereIn('id_soal', $soalIds)
                    ->delete();

                DB::table('soal')
                    ->whereIn('id_soal', $soalIds)
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Terakhir hapus kuis
            |--------------------------------------------------------------------------
            */

            $kuis->delete();
        });
    }
}