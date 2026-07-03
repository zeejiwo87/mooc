<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\ForgotPasswordRequest;
use App\Http\Requests\App\LoginRequest;
use App\Http\Requests\App\ResetPasswordRequest;
use App\Http\Requests\Pendaftaran\DaftarRequest;
use App\Models\Pengguna;
use App\Services\App\PenggunaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

final class AuthController extends Controller
{
    private const LOGIN_MAX_ATTEMPTS = 5;
    private const LOGIN_DECAY_SECONDS = 300;

    private const VERIFICATION_MAX_ATTEMPTS = 3;
    private const VERIFICATION_DECAY_SECONDS = 300;

    private const FORGOT_PASSWORD_MAX_ATTEMPTS = 5;
    private const FORGOT_PASSWORD_DECAY_SECONDS = 900;

    public function __construct(
        private readonly PenggunaService $penggunaService,
    ) {}

    public function login(): View
    {
        return view('portal');
    }

    public function logindb(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $email = trim((string) $validated['email']);
        $password = $validated['password'];
        $remember = false;

        $loginRateLimitKey = $this->loginRateLimitKey($email, $request);

        if (RateLimiter::tooManyAttempts($loginRateLimitKey, self::LOGIN_MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($loginRateLimitKey);

            return back()
                ->with(
                    'error',
                    "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik."
                )
                ->withInput($request->only('email'));
        }

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        foreach (['admin', 'mentor', 'pengguna'] as $guard) {
            if (Auth::guard($guard)->attempt($credentials, $remember)) {
                RateLimiter::clear($loginRateLimitKey);

                $user = Auth::guard($guard)->user();

                $roleLabel = match ($guard) {
                    'admin' => 'Admin',
                    'mentor' => 'Mentor',
                    'pengguna' => 'Pengguna',
                    default => ucfirst($guard),
                };

                if ($guard === 'pengguna') {
                    if (! $user->terverifikasi) {
                        Auth::guard('pengguna')->logout();

                        return redirect()
                            ->route('verification.notice')
                            ->with(
                                'error',
                                'Akun belum diverifikasi. Silakan cek email Anda.'
                            );
                    }

                    Pengguna::where('id_pengguna', $user->id_pengguna)->update([
                        'last_login' => now(),
                    ]);

                    return redirect()
                        ->route('pengguna.kelas_saya')
                        ->with(
                            'successlogin',
                            "Selamat datang! {$user->nama}-{$roleLabel}"
                        );
                }

                return redirect()
                    ->route('index')
                    ->with(
                        'successlogin',
                        "Selamat datang! {$user->nama}-{$roleLabel}"
                    );
            }
        }

        RateLimiter::hit($loginRateLimitKey, self::LOGIN_DECAY_SECONDS);

        return back()
            ->with('error', 'Username atau password salah.')
            ->withInput($request->only('email'));
    }

    public function daftar(): View
    {
        return view('daftar');
    }

    public function daftardb(DaftarRequest $request): RedirectResponse
    {
        $user = $this->penggunaService
            ->registerPengguna($request->validated());

        Auth::guard('pengguna')->login($user);

        $this->penggunaService
            ->sendVerificationEmailToPengguna($user);

        return redirect()
            ->route('verification.notice')
            ->with(
                'success',
                'Akun berhasil dibuat! Silakan cek email Anda untuk verifikasi.'
            );
    }

    public function verification_notice(): View|RedirectResponse
    {
        $user = Auth::guard('pengguna')->user();

        if (! $user) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Silakan masuk terlebih dahulu untuk melanjutkan verifikasi.'
                );
        }

        if ($user->terverifikasi) {
            return redirect()
                ->route('index')
                ->with(
                    'success',
                    'Email Anda sudah terverifikasi.'
                );
        }

        return view('verification_notice', [
            'user' => $user,
        ]);
    }

    public function sendVerificationEmail(Request $request): RedirectResponse
    {
        $user = Auth::guard('pengguna')->user();

        if (! $user) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Silakan masuk terlebih dahulu untuk mengirim ulang email verifikasi.'
                );
        }

        if ($user->terverifikasi) {
            return redirect()
                ->route('index')
                ->with(
                    'success',
                    'Email Anda sudah terverifikasi.'
                );
        }

        $verificationRateLimitKey = $this->verificationRateLimitKey($user->id_pengguna, $request);

        if (RateLimiter::tooManyAttempts($verificationRateLimitKey, self::VERIFICATION_MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($verificationRateLimitKey);

            return back()
                ->with(
                    'error',
                    "Terlalu sering mengirim ulang email verifikasi. Silakan coba lagi dalam {$seconds} detik."
                );
        }

        RateLimiter::hit($verificationRateLimitKey, self::VERIFICATION_DECAY_SECONDS);

        $this->penggunaService
            ->sendVerificationEmailToPengguna($user);

        return back()
            ->with(
                'success',
                'Email verifikasi telah dikirim ulang. Silakan cek inbox email Anda.'
            );
    }

    public function verifyEmail(
        Request $request,
        string $id
    ): RedirectResponse {
        if (! URL::hasValidSignature($request)) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Link verifikasi tidak valid atau sudah kadaluarsa.'
                );
        }

        $user = Pengguna::find($id);

        if (! $user) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun yang akan diverifikasi tidak ditemukan.'
                );
        }

        if (! $user->terverifikasi) {
            $user->terverifikasi = 1;
        }

        $user->last_login = now();
        $user->save();

        Auth::guard('pengguna')->login($user);

        return redirect()
            ->route('pengguna.kelas_saya')
            ->with(
                'successlogin',
                "Selamat datang! {$user->nama}-Pengguna"
            );
    }

    public function lupa_password(): View
    {
        return view('lupa_password');
    }

    public function lupa_password_db(
        ForgotPasswordRequest $request
    ): RedirectResponse {
        $email = trim((string) $request->validated()['email']);
        $forgotPasswordRateLimitKey = $this->forgotPasswordRateLimitKey($email, $request);

        if (RateLimiter::tooManyAttempts($forgotPasswordRateLimitKey, self::FORGOT_PASSWORD_MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($forgotPasswordRateLimitKey);

            return back()
                ->with(
                    'error',
                    "Terlalu sering meminta reset password. Silakan coba lagi dalam {$seconds} detik."
                )
                ->withInput($request->only('email'));
        }

        RateLimiter::hit($forgotPasswordRateLimitKey, self::FORGOT_PASSWORD_DECAY_SECONDS);

        $user = Pengguna::where('email', $email)->first();

        if ($user) {
            $this->penggunaService
                ->sendResetEmailToPengguna($user);
        }

        return back()
            ->with(
                'success',
                'Jika email terdaftar, link reset password sudah dikirim. Silakan cek inbox email Anda.'
            );
    }

    public function reset_password(
        Request $request,
        string $id
    ): View|RedirectResponse {
        if (! URL::hasValidSignature($request)) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Link reset password tidak valid atau sudah kadaluarsa.'
                );
        }

        $user = Pengguna::find($id);

        if (! $user) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun tidak ditemukan.'
                );
        }

        return view('reset_password', [
            'user' => $user,
        ]);
    }

    public function reset_password_db(
        ResetPasswordRequest $request,
        string $id
    ): RedirectResponse {
        if (! URL::hasValidSignature($request)) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Link reset password tidak valid atau sudah kadaluarsa.'
                );
        }

        $validated = $request->validated();

        $user = Pengguna::find($id);

        if (! $user) {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun tidak ditemukan.'
                );
        }

        $user->password = Hash::make($validated['password']);
        $user->last_login = now();
        $user->save();

        Auth::guard('pengguna')->login($user);

        return redirect()
            ->route('pengguna.kelas_saya')
            ->with(
                'successlogin',
                "Selamat datang! {$user->nama}-Pengguna"
            );
    }

    public function logout(Request $request): RedirectResponse
    {
        $guards = ['admin', 'mentor', 'pengguna'];

        foreach ($guards as $guard) {
            Auth::guard($guard)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('index')
            ->with(
                'successlogin',
                'Anda telah berhasil keluar.'
            );
    }

    private function loginRateLimitKey(string $email, Request $request): string
    {
        return 'login:' . sha1(Str::lower($email) . '|' . $request->ip());
    }

    private function verificationRateLimitKey(int|string $userId, Request $request): string
    {
        return 'verification-email:' . sha1((string) $userId . '|' . $request->ip());
    }

    private function forgotPasswordRateLimitKey(string $email, Request $request): string
    {
        return 'forgot-password:' . sha1(Str::lower($email) . '|' . $request->ip());
    }
}