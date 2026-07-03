<?php

namespace App\Services\App;

use App\Models\Pendaftaran;
use App\Models\Pengguna;
use App\Services\Tools\FileUploadService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

final class PenggunaService
{
    public function __construct(
        private readonly FileUploadService $fileUploadService,
    ) {}

    private function penggunaWithStatsQuery(): Builder
    {
        return Pengguna::query()
            ->select('pengguna.*')
            ->selectSub(function ($query) {
                $query->from('pendaftaran')
                    ->whereColumn('pendaftaran.id_pengguna', 'pengguna.id_pengguna')
                    ->where('pendaftaran.status', 'selesai')
                    ->selectRaw('COUNT(DISTINCT pendaftaran.id_kelas)');
            }, 'total_kelas_selesai')
            ->selectSub(function ($query) {
                $query->from('pendaftaran')
                    ->whereColumn('pendaftaran.id_pengguna', 'pengguna.id_pengguna')
                    ->whereIn('pendaftaran.status', ['aktif', 'selesai'])
                    ->selectRaw('COUNT(DISTINCT pendaftaran.id_kelas)');
            }, 'total_kelas_diikuti');
    }

    public function registerPengguna(array $data): Pengguna
    {
        return Pengguna::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'telepon' => $data['telepon'],
            'password' => Hash::make($data['password']),
            'terverifikasi' => 0,
        ]);
    }

    public function sendVerificationEmailToPengguna(Pengguna $user): void
    {
        try {
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(5),
                ['id' => $user->id_pengguna]
            );

            Mail::send('emails.verify_pengguna', [
                'user' => $user,
                'url' => $verificationUrl,
            ], function ($message) use ($user) {
                $message->to($user->email, $user->nama)
                    ->subject('Verifikasi Email Akun MOOC');
            });
        } catch (Exception $e) {
            Log::error('send-verification-email-failed', [
                'user_id' => $user->id_pengguna,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function sendResetEmailToPengguna(Pengguna $user): void
    {
        try {
            $resetUrl = URL::temporarySignedRoute(
                'reset_password',
                now()->addMinutes(15),
                ['id' => $user->id_pengguna]
            );

            Mail::send('emails.reset_password_pengguna', [
                'user' => $user,
                'url' => $resetUrl,
            ], function ($message) use ($user) {
                $message->to($user->email, $user->nama)
                    ->subject('Reset Password Akun MOOC');
            });
        } catch (Exception $e) {
            Log::error('send-reset-password-email-failed', [
                'user_id' => $user->id_pengguna,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getListData(): Collection
    {
        return $this->penggunaWithStatsQuery()
            ->orderBy('pengguna.id_pengguna')
            ->get();
    }

    public function getListDataOrdered(): Collection
    {
        return Pengguna::query()
            ->select('id_pengguna', 'nama')
            ->orderBy('nama')
            ->get();
    }

    public function create(array $data): Pengguna
    {
        return Pengguna::create($data);
    }

    public function getDetailData(string $id): ?Pengguna
    {
        return $this->penggunaWithStatsQuery()
            ->where('pengguna.id_pengguna', $id)
            ->first();
    }

    public function findById(string $id): ?Pengguna
    {
        return Pengguna::find($id);
    }

    public function update(Pengguna $pengguna, array $data): Pengguna
    {
        $pengguna->update($data);

        return $pengguna;
    }

    public function delete(Pengguna $pengguna): void
    {
        $pengguna->delete();
    }

    public function checkDuplicateForStore(string $email): bool
    {
        return Pengguna::query()
            ->where('email', $email)
            ->exists();
    }

    public function checkDuplicateForUpdate(int $id_pengguna, string $email): bool
    {
        return Pengguna::query()
            ->where('email', $email)
            ->where('id_pengguna', '!=', $id_pengguna)
            ->exists();
    }

    public function getProfilData(string $id_pengguna): array
    {
        $pengguna = Pengguna::find($id_pengguna);

        if (! $pengguna) {
            return [
                'pengguna' => null,
                'totalKelasSelesai' => 0,
                'totalKelas' => 0,
            ];
        }

        $totalKelasSelesai = Pendaftaran::query()
            ->where('id_pengguna', $pengguna->id_pengguna)
            ->where('status', 'selesai')
            ->distinct('id_kelas')
            ->count('id_kelas');

        $totalKelas = Pendaftaran::query()
            ->where('id_pengguna', $pengguna->id_pengguna)
            ->whereIn('status', ['aktif', 'selesai'])
            ->distinct('id_kelas')
            ->count('id_kelas');

        return [
            'pengguna' => $pengguna,
            'totalKelasSelesai' => $totalKelasSelesai,
            'totalKelas' => $totalKelas,
        ];
    }

    public function updatePassword(Pengguna $user, string $oldPassword, string $newPassword): bool
    {
        if (! Hash::check($oldPassword, $user->password)) {
            return false;
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return true;
    }

    public function handleFileUpload($foto_profil, ?Pengguna $pengguna = null): array
    {
        $result = $pengguna && $pengguna->foto_profil
            ? $this->fileUploadService->updateFileByType($foto_profil, $pengguna->foto_profil, 'profil')
            : $this->fileUploadService->uploadByType($foto_profil, 'profil');

        if ($pengguna) {
            $pengguna->foto_profil = $result['file_name'];
            $pengguna->save();
        }

        return [
            'file_name' => $result['file_name'],
            'file_url' => asset('storage/profil/' . $result['file_name']),
        ];
    }
}