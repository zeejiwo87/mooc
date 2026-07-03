<?php

namespace App\Services\App;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Mentor;
use App\Models\Pendaftaran;
use App\Models\Pengguna;
use Illuminate\Support\Collection;

final class DashboardService
{
    public static function getDashboardAdmin(): Collection
    {
        return collect([
            'total_pengguna' => Pengguna::count(),
            'total_mentor' => Mentor::count(),
            'total_kursus' => Kelas::count(),
            'total_peserta' => Pendaftaran::count(),
            'pengguna_baru' => Pengguna::latest()->take(5)->get(),
            'kursus_baru' => Kelas::latest()->take(5)->get(),
        ]);
    }

    public static function getDashboardMentor(int $id_mentor): Collection
    {
        $totalKursus = Kelas::query()
            ->where('id_pemilik', $id_mentor)
            ->count();

        $totalMateri = Materi::query()
            ->join('bagian_kelas', 'bagian_kelas.id_bagian_kelas', '=', 'materi.id_bagian_kelas')
            ->join('kelas', 'kelas.id_kelas', '=', 'bagian_kelas.id_kelas')
            ->where('kelas.id_pemilik', $id_mentor)
            ->count('materi.id_materi');

        $totalPeserta = Pendaftaran::query()
            ->join('kelas', 'kelas.id_kelas', '=', 'pendaftaran.id_kelas')
            ->where('kelas.id_pemilik', $id_mentor)
            ->whereIn('pendaftaran.status', ['aktif', 'selesai'])
            ->distinct('pendaftaran.id_pengguna')
            ->count('pendaftaran.id_pengguna');

        return collect([
            'total_kursus' => $totalKursus,
            'total_materi' => $totalMateri,
            'total_peserta' => $totalPeserta,
        ]);
    }
}