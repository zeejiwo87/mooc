<?php

namespace App\Services\Materi;

use App\Models\BagianKelas;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class BagianKelasService
{
    public function getListData(string $id_kelas, ?array $filters = []): Collection
    {
        return BagianKelas::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'bagian_kelas.*',
                'kelas.judul as kelas_judul'
            )
            ->where('bagian_kelas.id_kelas', $id_kelas)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('bagian_kelas.urutan')
            ->get();
    }

    public function create(array $data): BagianKelas
    {
        return BagianKelas::create($data);
    }

    public function getDetailData(string $id, ?array $filters = []): ?BagianKelas
    {
        return BagianKelas::query()
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->select(
                'bagian_kelas.*',
                'kelas.judul as kelas_judul'
            )
            ->where('bagian_kelas.id_bagian_kelas', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->first();
    }

    public function findById(string $id): ?BagianKelas
    {
        return BagianKelas::find($id);
    }

    public function update(BagianKelas $bagianKelas, array $data): BagianKelas
    {
        $bagianKelas->update($data);

        return $bagianKelas;
    }

    public function delete(BagianKelas $bagianKelas): void
    {
        DB::transaction(function () use ($bagianKelas) {
            $idBagianKelas = (int) $bagianKelas->id_bagian_kelas;

            /*
            |--------------------------------------------------------------------------
            | Ambil semua materi dalam bagian kelas
            |--------------------------------------------------------------------------
            */

            $materiIds = DB::table('materi')
                ->where('id_bagian_kelas', $idBagianKelas)
                ->pluck('id_materi');

            /*
            |--------------------------------------------------------------------------
            | Ambil semua kuis dari materi dalam bagian kelas
            |--------------------------------------------------------------------------
            */

            $kuisIds = collect();

            if ($materiIds->isNotEmpty()) {
                $kuisIds = DB::table('kuis')
                    ->whereIn('id_materi', $materiIds)
                    ->pluck('id_kuis');
            }

            /*
            |--------------------------------------------------------------------------
            | Ambil semua soal dari kuis
            |--------------------------------------------------------------------------
            */

            $soalIds = collect();

            if ($kuisIds->isNotEmpty()) {
                $soalIds = DB::table('soal')
                    ->whereIn('id_kuis', $kuisIds)
                    ->pluck('id_soal');
            }

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
            | Ambil progres kelas yang terkait bagian ini
            |--------------------------------------------------------------------------
            | progres_kelas punya foreign key ke:
            | - bagian_kelas
            | - materi
            |
            | Jadi harus dibersihkan sebelum bagian_kelas/materi dihapus.
            */

            $progresKelasIds = DB::table('progres_kelas')
                ->where(function ($query) use ($idBagianKelas, $materiIds) {
                    $query->where('id_bagian_kelas', $idBagianKelas);

                    if ($materiIds->isNotEmpty()) {
                        $query->orWhereIn('id_materi', $materiIds);
                    }
                })
                ->pluck('id_progres_kelas');

            /*
            |--------------------------------------------------------------------------
            | Ambil progres kuis yang terkait bagian ini
            |--------------------------------------------------------------------------
            | progres_kuis bisa terkait lewat:
            | - id_kuis
            | - id_progres_kelas
            */

            $progresKuisIds = collect();

            if ($kuisIds->isNotEmpty() || $progresKelasIds->isNotEmpty()) {
                $progresKuisIds = DB::table('progres_kuis')
                    ->where(function ($query) use ($kuisIds, $progresKelasIds) {
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
                    })
                    ->pluck('id_progres_kuis');
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus progres jawaban dulu
            |--------------------------------------------------------------------------
            | Ini wajib duluan, karena progres_jawaban punya foreign key ke:
            | - progres_kuis
            | - soal
            | - soal_jawaban
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
            | Hapus progres kelas
            |--------------------------------------------------------------------------
            */

            if ($progresKelasIds->isNotEmpty()) {
                DB::table('progres_kelas')
                    ->whereIn('id_progres_kelas', $progresKelasIds)
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus soal jawaban, soal, kuis, materi
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

            if ($materiIds->isNotEmpty()) {
                DB::table('materi')
                    ->whereIn('id_materi', $materiIds)
                    ->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Terakhir hapus bagian kelas
            |--------------------------------------------------------------------------
            */

            $bagianKelas->delete();
        });
    }
}