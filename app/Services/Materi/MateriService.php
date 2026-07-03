<?php

namespace App\Services\Materi;

use App\Models\Materi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class MateriService
{
    public function getListData(string $id_bagian_kelas, ?array $filters = []): Collection
    {
        return Materi::query()
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'materi.*',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('materi.id_bagian_kelas', $id_bagian_kelas)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('materi.urutan')
            ->get();
    }

    public function create(array $data): Materi
    {
        return Materi::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?Materi
    {
        return Materi::query()
            ->leftJoin('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'materi.*',
                'bagian_kelas.judul as bagian_kelas_judul',
                'kelas.judul as kelas_judul'
            )
            ->where('materi.id_materi', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->first();
    }

    public function findById(string $id): ?Materi
    {
        return Materi::find($id);
    }

    public function update(Materi $materi, array $data): Materi
    {
        $materi->update($data);

        return $materi;
    }

    public function delete(Materi $materi): void
    {
        DB::transaction(function () use ($materi) {
            $idMateri = (int) $materi->id_materi;

            /*
            |--------------------------------------------------------------------------
            | Ambil semua data turunan materi
            |--------------------------------------------------------------------------
            | Materi bisa punya kuis.
            | Kuis punya soal.
            | Soal punya jawaban.
            | Semua ini bisa sudah terhubung ke progres user.
            */

            $kuisIds = DB::table('kuis')
                ->where('id_materi', $idMateri)
                ->pluck('id_kuis');

            $soalIds = collect();

            if ($kuisIds->isNotEmpty()) {
                $soalIds = DB::table('soal')
                    ->whereIn('id_kuis', $kuisIds)
                    ->pluck('id_soal');
            }

            $soalJawabanIds = collect();

            if ($soalIds->isNotEmpty()) {
                $soalJawabanIds = DB::table('soal_jawaban')
                    ->whereIn('id_soal', $soalIds)
                    ->pluck('id_soal_jawaban');
            }

            /*
            |--------------------------------------------------------------------------
            | Ambil progres kelas dari materi ini
            |--------------------------------------------------------------------------
            | progres_kelas punya foreign key ke materi.
            | Jadi harus dibersihkan sebelum materi dihapus.
            */

            $progresKelasIds = DB::table('progres_kelas')
                ->where('id_materi', $idMateri)
                ->pluck('id_progres_kelas');

            /*
            |--------------------------------------------------------------------------
            | Ambil progres kuis yang terkait materi ini
            |--------------------------------------------------------------------------
            | Bisa terkait lewat id_kuis atau lewat id_progres_kelas.
            */

            $progresKuisQuery = DB::table('progres_kuis');

            $progresKuisQuery->where(function ($query) use ($kuisIds, $progresKelasIds) {
                if ($kuisIds->isNotEmpty()) {
                    $query->whereIn('id_kuis', $kuisIds);
                }

                if ($progresKelasIds->isNotEmpty()) {
                    if ($kuisIds->isNotEmpty()) {
                        $query->orWhereIn('id_progres_kelas', $progresKelasIds);
                    } else {
                        $query->whereIn('id_progres_kelas', $progresKelasIds);
                    }
                }
            });

            $progresKuisIds = ($kuisIds->isNotEmpty() || $progresKelasIds->isNotEmpty())
                ? $progresKuisQuery->pluck('id_progres_kuis')
                : collect();

            /*
            |--------------------------------------------------------------------------
            | Hapus progres jawaban terlebih dahulu
            |--------------------------------------------------------------------------
            | progres_jawaban punya foreign key ke:
            | - progres_kuis
            | - soal
            | - soal_jawaban
            |
            | Kalau soal/jawaban dihapus sebelum progres_jawaban, delete bisa gagal.
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
            | Hapus progres kelas materi
            |--------------------------------------------------------------------------
            */

            if ($progresKelasIds->isNotEmpty()) {
                DB::table('progres_kelas')
                    ->whereIn('id_progres_kelas', $progresKelasIds)
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus soal, jawaban, dan kuis
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

            if ($kuisIds->isNotEmpty()) {
                DB::table('kuis')
                    ->whereIn('id_kuis', $kuisIds)
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Terakhir baru hapus materi
            |--------------------------------------------------------------------------
            */

            $materi->delete();
        });
    }
}