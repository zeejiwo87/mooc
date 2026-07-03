<?php

namespace App\Services\App;

use App\Models\Mentor;
use App\Services\Tools\FileUploadService;
use Illuminate\Support\Collection;

final class MentorService
{
    public function __construct(
        private readonly FileUploadService $fileUploadService,
    ) {}

    public function getListData(): Collection
    {
        return Mentor::query()
            ->select([
                'mentor.id_mentor',
                'mentor.nama',
                'mentor.email',
                'mentor.foto_profil',
                'mentor.bio',
                'mentor.spesialisasi',
                'mentor.deleted_at',
                'mentor.created_at',
                'mentor.updated_at',
            ])
            ->selectSub(function ($query) {
                $query->from('pendaftaran')
                    ->join('kelas', 'kelas.id_kelas', '=', 'pendaftaran.id_kelas')
                    ->whereColumn('kelas.id_pemilik', 'mentor.id_mentor')
                    ->whereIn('pendaftaran.status', ['aktif', 'selesai'])
                    ->selectRaw('COUNT(DISTINCT pendaftaran.id_pengguna)');
            }, 'total_siswa')
            ->selectSub(function ($query) {
                $query->from('kelas_usulan')
                    ->join('kelas', 'kelas.id_kelas', '=', 'kelas_usulan.id_kelas')
                    ->whereColumn('kelas.id_pemilik', 'mentor.id_mentor')
                    ->whereNotNull('kelas_usulan.rating')
                    ->selectRaw('COALESCE(ROUND(AVG(kelas_usulan.rating), 2), 0)');
            }, 'rating_rata')
            ->orderBy('mentor.id_mentor')
            ->get();
    }

    public function getListDataOrdered(): Collection
    {
        return Mentor::query()
            ->select('id_mentor', 'nama')
            ->orderBy('nama')
            ->get();
    }

    public function create(array $data): Mentor
    {
        return Mentor::create($data);
    }

    public function getDetailData(string $id): ?Mentor
    {
        return Mentor::query()
            ->select([
                'mentor.id_mentor',
                'mentor.nama',
                'mentor.email',
                'mentor.foto_profil',
                'mentor.bio',
                'mentor.spesialisasi',
                'mentor.deleted_at',
                'mentor.created_at',
                'mentor.updated_at',
            ])
            ->selectSub(function ($query) {
                $query->from('pendaftaran')
                    ->join('kelas', 'kelas.id_kelas', '=', 'pendaftaran.id_kelas')
                    ->whereColumn('kelas.id_pemilik', 'mentor.id_mentor')
                    ->whereIn('pendaftaran.status', ['aktif', 'selesai'])
                    ->selectRaw('COUNT(DISTINCT pendaftaran.id_pengguna)');
            }, 'total_siswa')
            ->selectSub(function ($query) {
                $query->from('kelas_usulan')
                    ->join('kelas', 'kelas.id_kelas', '=', 'kelas_usulan.id_kelas')
                    ->whereColumn('kelas.id_pemilik', 'mentor.id_mentor')
                    ->whereNotNull('kelas_usulan.rating')
                    ->selectRaw('COALESCE(ROUND(AVG(kelas_usulan.rating), 2), 0)');
            }, 'rating_rata')
            ->where('mentor.id_mentor', $id)
            ->first();
    }

    public function findById(string $id): ?Mentor
    {
        return Mentor::find($id);
    }

    public function update(Mentor $mentor, array $data): Mentor
    {
        $mentor->update($data);

        return $mentor;
    }

    public function delete(Mentor $mentor): void
    {
        $mentor->delete();
    }

    public function checkDuplicateForStore(string $email): bool
    {
        return Mentor::query()
            ->where('email', $email)
            ->exists();
    }

    public function checkDuplicateForUpdate(int $id_mentor, string $email): bool
    {
        return Mentor::query()
            ->where('email', $email)
            ->where('id_mentor', '!=', $id_mentor)
            ->exists();
    }

    public function handleFileUpload($foto_profil, ?Mentor $mentor = null): ?array
    {
        if (! $foto_profil) {
            return null;
        }

        if ($mentor && $mentor->foto_profil) {
            return $this->fileUploadService->updateFileByType(
                $foto_profil,
                $mentor->foto_profil,
                'profil'
            );
        }

        return $this->fileUploadService->uploadByType($foto_profil, 'profil');
    }
}