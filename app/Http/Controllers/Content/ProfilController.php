<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pengguna\UpdateBiodataRequest;
use App\Http\Requests\Pengguna\UpdateFotoRequest;
use App\Http\Requests\Pengguna\UpdatePasswordRequest;
use App\Services\App\PenggunaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function __construct(
        private readonly PenggunaService $penggunaService,
    ) {}

    public function profil(): View
    {
        $pengguna = Auth::guard('pengguna')->user();

        $data = $this->penggunaService->getProfilData($pengguna->id_pengguna);

        $data = json_decode(json_encode($data), true) ?? [];

        return view('content.pengguna.profil', $data);
    }

    public function updateBiodata(UpdateBiodataRequest $request): RedirectResponse
    {
        $user = Auth::guard('pengguna')->user();

        $this->penggunaService->update(
            $user,
            $request->validated()
        );

        return redirect()
            ->back()
            ->with('success', 'Biodata berhasil diperbarui.');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $user = Auth::guard('pengguna')->user();

        $updated = $this->penggunaService->updatePassword(
            $user,
            $request->input('password_lama'),
            $request->input('password_baru')
        );

        if (! $updated) {
            return redirect()
                ->back()
                ->withErrors([
                    'password_lama' => 'Password lama tidak sesuai.',
                ])
                ->withInput();
        }

        return redirect()
            ->back()
            ->with('success', 'Password berhasil diperbarui.');
    }

    public function updateFoto(UpdateFotoRequest $request): RedirectResponse
    {
        $user = Auth::guard('pengguna')->user();

        $foto = $request->file('foto_profil');

        $this->penggunaService->handleFileUpload($foto, $user);

        return redirect()
            ->back()
            ->with('success', 'Foto profil berhasil diperbarui.');
    }
}