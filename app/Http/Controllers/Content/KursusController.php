<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use App\Services\Kelas\KelasService;
use App\Services\Pendaftaran\PendaftaranService;
use App\Support\IdCipher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KursusController extends Controller
{
    public function __construct(
        private readonly KelasService $kelasService
    ) {}

    public function index(Request $request)
    {
        if (! $request->has('filter_bahasa')) {
            $request->merge(['filter_bahasa' => 'ID']);
        } else {
            $request->merge([
                'filter_bahasa' => strtoupper($request->input('filter_bahasa')),
            ]);
        }

        $kursus = $this->kelasService->getFilteredKursusForContent($request);
        $kategoriList = Kategori::orderBy('nama')->get();

        return view('content.kursus.index', compact('kursus', 'kategoriList'));
    }

    public function filter(Request $request)
    {
        if (! $request->has('filter_bahasa')) {
            $request->merge(['filter_bahasa' => 'ID']);
        } else {
            $request->merge([
                'filter_bahasa' => strtoupper($request->input('filter_bahasa')),
            ]);
        }

        $kursus = $this->kelasService->getFilteredKursusForContent($request);

        $response = [
            'total' => $kursus->total(),
            'html' => view('content.kursus._courses_list', compact('kursus'))->render(),
            'pagination' => $kursus->appends($request->query())
                ->links('content.kursus.pagination')
                ->toHtml(),
        ];

        return response()->json($response);
    }

    public function detail(string $slug)
    {
        $data = $this->kelasService->getDetailForContent($slug);

        return view('content.kursus.detail', $data);
    }

    public function enroll(Request $request, Kelas $kelas)
    {
        $pengguna = $request->user('pengguna');

        if (! $pengguna) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk mendaftar kelas.');
        }

        $isEnrolled = Pendaftaran::where('id_pengguna', $pengguna->id_pengguna)
            ->where('id_kelas', $kelas->id_kelas)
            ->first();

        if ($isEnrolled) {
            return redirect()->route('pengguna.mulai_belajar', [
                'token' => IdCipher::encode($isEnrolled->id_pendaftaran),
            ]);
        }

        return view('content.kursus.enroll', compact('kelas'));
    }

    public function enrollProcess(
        Request $request,
        Kelas $kelas,
        PendaftaranService $pendaftaranService
    ) {
        $pengguna = $request->user('pengguna');

        if (! $pengguna) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk mendaftar kelas.');
        }

        $isEnrolled = Pendaftaran::where('id_pengguna', $pengguna->id_pengguna)
            ->where('id_kelas', $kelas->id_kelas)
            ->first();

        if ($isEnrolled) {
            return redirect()->route('pengguna.mulai_belajar', [
                'token' => IdCipher::encode($isEnrolled->id_pendaftaran),
            ]);
        }

        try {
            $pendaftaran = DB::transaction(function () use (
                $pendaftaranService,
                $pengguna,
                $kelas
            ) {
                $existingPendaftaran = Pendaftaran::where('id_pengguna', $pengguna->id_pengguna)
                    ->where('id_kelas', $kelas->id_kelas)
                    ->lockForUpdate()
                    ->first();

                if ($existingPendaftaran) {
                    return $existingPendaftaran;
                }

                return $pendaftaranService->create([
                    'id_pengguna' => $pengguna->id_pengguna,
                    'id_kelas' => $kelas->id_kelas,
                    'terdaftar_pada' => now(),
                ]);
            });
        } catch (\Throwable $e) {
            Log::error(
                'Enrollment process failed for user ' .
                ($pengguna->id_pengguna ?? '-') .
                ' and course ' .
                ($kelas->id_kelas ?? '-') .
                ': ' .
                $e->getMessage(),
                [
                    'exception' => $e,
                ]
            );

            return redirect()
                ->route('kursus.enroll', ['kelas' => $kelas->slug])
                ->with(
                    'error',
                    'Terjadi kesalahan internal saat proses pendaftaran. Silakan coba beberapa saat lagi.'
                );
        }

        return redirect()->route('pengguna.mulai_belajar', [
            'token' => IdCipher::encode($pendaftaran->id_pendaftaran),
        ])->with(
            'success',
            'Selamat! Anda telah berhasil mendaftar. Selamat belajar!'
        );
    }
}