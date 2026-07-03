<?php

namespace App\Http\Controllers\Content;

use App\Helpers\Tools;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pendaftaran\SubmitJawabanKuisRequest;
use App\Http\Requests\Pendaftaran\UpdateProgresRequest;
use App\Models\Kelas;
use App\Models\KelasUsulanPeserta;
use App\Models\Pendaftaran;
use App\Services\Pendaftaran\CoursePlayerService;
use App\Services\Pendaftaran\PendaftaranService;
use App\Services\Pendaftaran\ProgresKelasService;
use App\Services\Tools\FileUploadService;
use App\Services\Tools\ResponseService;
use App\Support\IdCipher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class KelasController extends Controller
{
    public function __construct(
        private readonly PendaftaranService $pendaftaranService,
        private readonly ProgresKelasService $progresKelasService,
        private readonly FileUploadService $fileUploadService,
        private readonly CoursePlayerService $coursePlayerService,
        private readonly ResponseService $responseService,
    ) {}

    public function kelasSaya()
    {
        $pengguna = Auth::guard('pengguna')->user();

        $pendaftaranList = $this->pendaftaranService
            ->getListData(['id_pengguna' => $pengguna->id_pengguna]);

        $kelasIds = $pendaftaranList
            ->pluck('id_kelas')
            ->filter()
            ->unique()
            ->values();

        $ulasanMap = KelasUsulanPeserta::query()
            ->where('id_pengguna', $pengguna->id_pengguna)
            ->whereIn('id_kelas', $kelasIds)
            ->get()
            ->keyBy('id_kelas');

        $kelasSaya = $pendaftaranList->map(function ($item) use ($ulasanMap) {
            $data = $item->toArray();
            $ulasan = $ulasanMap->get((int) $item->id_kelas);

            $data['sudah_rating'] = $ulasan && $ulasan->rating !== null;
            $data['rating_pengguna'] = $ulasan?->rating;
            $data['ulasan_pengguna'] = $ulasan?->ulasan;

            return (object) $data;
        });

        return view('content.pengguna.kelas_saya', compact('kelasSaya'));
    }

    public function coursePlaying(string $token)
    {
        $pendaftaranId = $this->decodeId($token);
        abort_if(! $pendaftaranId, 404);

        $pendaftaran = $this->findPendaftaranOwned($pendaftaranId);
        abort_if(! $pendaftaran, 404);

        $this->coursePlayerService->syncAndGetOrderedMateri($pendaftaran);
        $this->coursePlayerService->refreshPendaftaranProgress($pendaftaran);

        return view('content.pengguna.course_playing', [
            'pendaftaran' => $pendaftaran,
            'pendaftaranToken' => IdCipher::encode($pendaftaran->id_pendaftaran),
        ]);
    }

    public function mulaiBelajar(Request $request, string $token)
    {
        $pendaftaranId = $this->decodeId($token);

        if (! $pendaftaranId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('pengguna.course_playing', $token);
        }

        $pendaftaran = $this->findPendaftaranOwned($pendaftaranId);

        if (! $pendaftaran) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->coursePlayerService->syncAndGetOrderedMateri($pendaftaran);

        $payload = $this->obfuscateProgressPayload(
            $this->coursePlayerService->getProgressPayload($pendaftaran)
        );

        return $this->responseService->successResponse('Data progres berhasil diambil', $payload);
    }

    public function materiBelajar(Request $request, string $token, string $progressToken)
    {
        $pendaftaranId = $this->decodeId($token);
        $progresId = $this->decodeId($progressToken);

        if (! $pendaftaranId || ! $progresId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pendaftaran = $this->findPendaftaranOwned($pendaftaranId);

        if (! $pendaftaran) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->coursePlayerService->syncAndGetOrderedMateri($pendaftaran);

        $forceQuizReview = $request->query('mode') === 'quiz-review'
            || $request->boolean('quiz_review');

        try {
            $payload = $this->obfuscateMateriPayload(
                $this->coursePlayerService->getMateriPayload($pendaftaran, (string) $progresId, $forceQuizReview)
            );
        } catch (RuntimeException $e) {
            $code = $e->getCode() > 0 ? $e->getCode() : 400;

            return $this->responseService->errorResponse($e->getMessage(), $code);
        }

        return $this->responseService->successResponse('Data materi berhasil diambil', $payload);
    }

    public function updateProgres(UpdateProgresRequest $request, string $token, string $progressToken)
    {
        $pendaftaranId = $this->decodeId($token);
        $progresId = $this->decodeId($progressToken);

        if (! $pendaftaranId || ! $progresId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pendaftaran = $this->findPendaftaranOwned($pendaftaranId);

        if (! $pendaftaran) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->coursePlayerService->syncAndGetOrderedMateri($pendaftaran);

        try {
            $payload = $this->coursePlayerService->updateProgres(
                $pendaftaran,
                (string) $progresId,
                (int) $request->input('waktu_belajar_detik', 0),
                (int) $request->input('posisi_video_terakhir', 0),
                (bool) $request->boolean('selesai', false)
            );
        } catch (RuntimeException $e) {
            $code = $e->getCode() > 0 ? $e->getCode() : 400;

            return $this->responseService->errorResponse($e->getMessage(), $code);
        }

        return $this->responseService->successResponse('Progres diperbarui', $payload);
    }

    public function mulaiKuis(Request $request, string $token, string $progressToken)
    {
        $pendaftaranId = $this->decodeId($token);
        $progresId = $this->decodeId($progressToken);

        if (! $pendaftaranId || ! $progresId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if (! $request->expectsJson()) {
            return redirect()->route('pengguna.course_playing', $token);
        }

        $pendaftaran = $this->findPendaftaranOwned($pendaftaranId);

        if (! $pendaftaran) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->coursePlayerService->syncAndGetOrderedMateri($pendaftaran);

        try {
            $payload = $this->coursePlayerService->mulaiTimerKuis(
                $pendaftaran,
                (string) $progresId
            );
        } catch (RuntimeException $e) {
            $code = $e->getCode() > 0 ? $e->getCode() : 400;

            return $this->responseService->errorResponse($e->getMessage(), $code);
        }

        return $this->responseService->successResponse('Timer kuis berhasil dimulai', $payload);
    }

    public function submitJawabanKuis(SubmitJawabanKuisRequest $request, string $token, string $progressToken)
    {
        $pendaftaranId = $this->decodeId($token);
        $progresId = $this->decodeId($progressToken);

        if (! $pendaftaranId || ! $progresId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pendaftaran = $this->findPendaftaranOwned($pendaftaranId);

        if (! $pendaftaran) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $this->coursePlayerService->syncAndGetOrderedMateri($pendaftaran);

        try {
            $payload = $this->coursePlayerService->submitJawabanKuis(
                $pendaftaran,
                (string) $progresId,
                $request->validated()['jawaban']
            );
        } catch (RuntimeException $e) {
            $code = $e->getCode() > 0 ? $e->getCode() : 400;

            return $this->responseService->errorResponse($e->getMessage(), $code);
        }

        if (isset($payload['error'])) {
            $code = $payload['code'] ?? 422;

            return $this->responseService->errorResponse(
                $payload['error'],
                $code,
                [
                    'status' => $payload['status'] ?? null,
                    'riwayat' => $payload['riwayat'] ?? null,
                ]
            );
        }

        $payload['navigasi'] = $this->obfuscateNavigasi($payload['navigasi'] ?? []);

        return $this->responseService->successResponse('Jawaban kuis disimpan', $payload);
    }

    public function simpanRating(Request $request, string $token)
    {
        $pendaftaranId = $this->decodeId($token);

        if (! $pendaftaranId) {
            if ($request->expectsJson()) {
                return $this->responseService->errorResponse('Token kelas tidak valid.', 400);
            }

            return back()->with('error', 'Token kelas tidak valid.');
        }

        $pengguna = Auth::guard('pengguna')->user();

        if (! $pengguna) {
            if ($request->expectsJson()) {
                return $this->responseService->errorResponse('Silakan login terlebih dahulu.', 401);
            }

            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $pendaftaran = $this->findPendaftaranOwned($pendaftaranId);

        if (! $pendaftaran) {
            if ($request->expectsJson()) {
                return $this->responseService->errorResponse('Data kelas tidak ditemukan atau bukan milik akun Anda.', 404);
            }

            return back()->with('error', 'Data kelas tidak ditemukan atau bukan milik akun Anda.');
        }

        /*
        |--------------------------------------------------------------------------
        | Perbaikan penting
        |--------------------------------------------------------------------------
        | Rating tidak lagi hanya bergantung pada status pendaftaran = selesai.
        | Sistem mengecek ulang apakah seluruh materi selesai dan seluruh kuis aktif
        | sudah lulus. Jika layak, status pendaftaran dan sertifikat disinkronkan.
        */
        if (! $this->progresKelasService->isPendaftaranLayakSertifikat($pendaftaranId)) {
            if ($request->expectsJson()) {
                return $this->responseService->errorResponse(
                    'Rating hanya bisa diberikan setelah seluruh materi selesai dan seluruh kuis aktif dinyatakan lulus.',
                    403
                );
            }

            return back()->with(
                'error',
                'Rating hanya bisa diberikan setelah seluruh materi selesai dan seluruh kuis aktif dinyatakan lulus.'
            );
        }

        $this->progresKelasService->cekTunasPendaftaran($pendaftaranId);

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'ulasan' => ['nullable', 'string', 'max:1000'],
        ], [
            'rating.required' => 'Silakan pilih rating terlebih dahulu.',
            'rating.integer' => 'Rating tidak valid.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'ulasan.max' => 'Ulasan maksimal 1000 karakter.',
        ]);

        KelasUsulanPeserta::query()->updateOrCreate(
            [
                'id_kelas' => (int) $pendaftaran->id_kelas,
                'id_pengguna' => (int) $pengguna->id_pengguna,
            ],
            [
                'rating' => (int) $validated['rating'],
                'ulasan' => $validated['ulasan'] ?? null,
            ]
        );

        $this->hitungUlangRatingKelas((int) $pendaftaran->id_kelas);

        if ($request->expectsJson()) {
            return $this->responseService->successResponse('Terima kasih. Rating berhasil disimpan, sertifikat sudah bisa dibuka.', [
                'sertifikat_url' => route('pengguna.sertifikat', $token),
                'download_url' => route('pengguna.sertifikat.download', $token),
                'rating' => (int) $validated['rating'],
                'ulasan' => $validated['ulasan'] ?? null,
            ]);
        }

        return back()->with('success', 'Terima kasih. Rating berhasil disimpan, sertifikat sudah bisa dibuka.');
    }

    public function sertifikat(string $token)
    {
        $pendaftaranId = $this->decodeId($token);

        if (! $pendaftaranId) {
            abort(404, 'Token sertifikat tidak valid.');
        }

        $pengguna = Auth::guard('pengguna')->user();

        if (! $pengguna) {
            abort(403, 'Anda belum login sebagai pengguna.');
        }

        $pendaftaran = Pendaftaran::query()
            ->where('id_pendaftaran', $pendaftaranId)
            ->first();

        if (! $pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        if ((int) $pendaftaran->id_pengguna !== (int) $pengguna->id_pengguna) {
            abort(403, 'Sertifikat ini bukan milik akun pengguna yang sedang login.');
        }

        /*
        |--------------------------------------------------------------------------
        | Perbaikan penting
        |--------------------------------------------------------------------------
        | Sertifikat hanya tersedia jika seluruh materi selesai dan seluruh kuis
        | aktif sudah lulus. Tidak cukup hanya mengecek status pendaftaran.
        */
        if (! $this->progresKelasService->isPendaftaranLayakSertifikat($pendaftaranId)) {
            abort(403, 'Sertifikat hanya tersedia setelah seluruh materi selesai dan seluruh kuis aktif dinyatakan lulus.');
        }

        if (! $this->sudahMemberiRating($pendaftaran, (int) $pengguna->id_pengguna)) {
            return redirect()
                ->route('pengguna.kelas_saya')
                ->with('error', 'Silakan beri rating terlebih dahulu sebelum membuka sertifikat.');
        }

        $sertifikat = $this->progresKelasService->cekTunasPendaftaran($pendaftaranId);

        if (! $sertifikat) {
            abort(404, 'Sertifikat belum tersedia atau gagal dibuat.');
        }

        $pendaftaran->refresh();

        $pdfPreviewUrl = null;

        if (! empty($sertifikat->pdf_url) && Storage::exists($sertifikat->pdf_url)) {
            $pdfPreviewUrl = Storage::url($sertifikat->pdf_url);
        }

        return view('content.pengguna.sertifikat', [
            'pendaftaran' => $pendaftaran,
            'sertifikat' => $sertifikat,
            'token' => $token,
            'downloadUrl' => route('pengguna.sertifikat.download', $token),
            'verifikasiUrl' => ! empty($sertifikat->kode_verifikasi)
                ? route('sertifikat.verifikasi', $sertifikat->kode_verifikasi)
                : null,
            'pdfPreviewUrl' => $pdfPreviewUrl,
            'formattedTanggalSelesai' => $sertifikat?->tanggal_selesai
                ? Tools::formatTanggalIndonesia($sertifikat->tanggal_selesai)
                : null,
            'formattedDiterbitkan' => $sertifikat?->dicetak_pada
                ? Tools::formatTanggalIndonesia($sertifikat->dicetak_pada)
                : null,
        ]);
    }

    public function downloadSertifikat(string $token)
    {
        try {
            $pendaftaranId = $this->decodeId($token);

            if (! $pendaftaranId) {
                return response()->json(['error' => 'Token sertifikat tidak valid'], 400);
            }

            $pengguna = Auth::guard('pengguna')->user();

            if (! $pengguna) {
                return response()->json(['error' => 'Anda belum login sebagai pengguna.'], 403);
            }

            $pendaftaran = Pendaftaran::query()
                ->where('id_pendaftaran', $pendaftaranId)
                ->first();

            if (! $pendaftaran) {
                return response()->json(['error' => 'Pendaftaran tidak ditemukan.'], 404);
            }

            if ((int) $pendaftaran->id_pengguna !== (int) $pengguna->id_pengguna) {
                return response()->json(['error' => 'Sertifikat ini bukan milik akun pengguna yang sedang login.'], 403);
            }

            /*
            |--------------------------------------------------------------------------
            | Perbaikan penting
            |--------------------------------------------------------------------------
            | Download sertifikat juga wajib mengecek kelayakan progres.
            | Jadi pengguna tidak bisa download hanya karena status pendaftaran selesai.
            */
            if (! $this->progresKelasService->isPendaftaranLayakSertifikat($pendaftaranId)) {
                return response()->json([
                    'error' => 'Sertifikat hanya tersedia setelah seluruh materi selesai dan seluruh kuis aktif dinyatakan lulus.',
                ], 403);
            }

            if (! $this->sudahMemberiRating($pendaftaran, (int) $pengguna->id_pengguna)) {
                return redirect()
                    ->route('pengguna.kelas_saya')
                    ->with('error', 'Silakan beri rating terlebih dahulu sebelum mengunduh sertifikat.');
            }

            $sertifikat = $this->progresKelasService->cekTunasPendaftaran($pendaftaranId);

            if (! $sertifikat) {
                return response()->json(['error' => 'Sertifikat tidak ditemukan atau belum memenuhi syarat.'], 404);
            }

            $safeNomor = $this->fileUploadService->generateSafeFileName($sertifikat->nomor_sertifikat);
            $filenamePdf = 'sertifikat-'.$safeNomor;

            if (! empty($sertifikat->pdf_url) && Storage::exists($sertifikat->pdf_url)) {
                return response()->download(Storage::path($sertifikat->pdf_url), $filenamePdf.'.pdf', [
                    'Content-Type' => 'application/pdf',
                ]);
            }

            $templateFile = $this->progresKelasService->templateSertifikat($pendaftaranId);

            if (! $templateFile || ! Storage::exists('sertifikat/'.$templateFile)) {
                return response()->json([
                    'error' => 'Template tidak ditemukan',
                    'template' => $templateFile,
                    'path_dicari' => 'storage/app/sertifikat/'.$templateFile,
                ], 404);
            }

            $urlVerifikasi = ! empty($sertifikat->kode_verifikasi)
                ? route('sertifikat.verifikasi', $sertifikat->kode_verifikasi)
                : '-';

            $placeholders = [
                'nama_penerima' => $sertifikat->nama_penerima ?? '-',
                'judul_kelas' => $sertifikat->judul_kelas ?? '-',
                'tanggal_selesai' => $sertifikat->tanggal_selesai
                    ? Tools::formatTanggalIndonesia($sertifikat->tanggal_selesai)
                    : '-',
                'nomor_sertifikat' => $sertifikat->nomor_sertifikat ?? '-',
                'kode_verifikasi' => $sertifikat->kode_verifikasi ?? '-',
                'url_verifikasi' => $urlVerifikasi,
                'url' => $sertifikat->qr_code_url ?? $urlVerifikasi,
            ];

            $result = $this->fileUploadService->generateSertifikatPdf(
                templatePath: 'sertifikat/'.$templateFile,
                placeholders: $placeholders,
                outputFileName: $filenamePdf,
                outputDirectory: 'sertifikat_pendaftaran'
            );

            if (! $result['success']) {
                return response()->json([
                    'error' => 'Gagal membuat sertifikat',
                    'message' => config('app.debug') ? $result['error'] : null,
                ], 500);
            }

            $sertifikat->pdf_url = $result['pdf_path'];
            $sertifikat->sudah_dicetak = 1;
            $sertifikat->dicetak_pada = now();
            $sertifikat->save();

            return response()->download(Storage::path($result['pdf_path']), $filenamePdf.'.pdf', [
                'Content-Type' => 'application/pdf',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Gagal membuat sertifikat',
                'message' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    private function sudahMemberiRating(Pendaftaran $pendaftaran, int $penggunaId): bool
    {
        return KelasUsulanPeserta::query()
            ->where('id_kelas', (int) $pendaftaran->id_kelas)
            ->where('id_pengguna', $penggunaId)
            ->whereNotNull('rating')
            ->exists();
    }

    private function hitungUlangRatingKelas(int $kelasId): void
    {
        $query = KelasUsulanPeserta::query()
            ->where('id_kelas', $kelasId)
            ->whereNotNull('rating');

        $totalReview = (int) $query->count();
        $ratingRataRata = $totalReview > 0
            ? round((float) $query->avg('rating'), 1)
            : 0;

        Kelas::query()
            ->where('id_kelas', $kelasId)
            ->update([
                'rating' => $ratingRataRata,
                'total_review' => $totalReview,
            ]);
    }

    private function findPendaftaranOwned(int|string $id): ?Pendaftaran
    {
        $pengguna = Auth::guard('pengguna')->user();

        if (! $pengguna) {
            return null;
        }

        return $this->coursePlayerService->getOwnedPendaftaran($id, $pengguna->id_pengguna);
    }

    private function decodeId(?string $token): ?string
    {
        return IdCipher::decode($token);
    }

    private function obfuscateProgressPayload(array $payload): array
    {
        $payload['kelas']['token'] = isset($payload['kelas']['id_pendaftaran'])
            ? IdCipher::encode($payload['kelas']['id_pendaftaran'])
            : null;

        if (isset($payload['kelas']['id_pendaftaran'])) {
            $payload['kelas']['id_pendaftaran_raw'] = $payload['kelas']['id_pendaftaran'];
            $payload['kelas']['id_pendaftaran'] = $payload['kelas']['token'];
        }

        if (isset($payload['progres']) && is_array($payload['progres'])) {
            foreach ($payload['progres'] as &$item) {
                if (! isset($item['bagian']['materi']) || ! is_array($item['bagian']['materi'])) {
                    continue;
                }

                foreach ($item['bagian']['materi'] as &$materi) {
                    if (isset($materi['id_progres_kelas'])) {
                        $token = IdCipher::encode($materi['id_progres_kelas']);
                        $materi['token'] = $token;
                        $materi['id_progres_kelas_raw'] = $materi['id_progres_kelas'];
                        $materi['id_progres_kelas'] = $token;
                    }
                }

                unset($materi);
            }

            unset($item);
        }

        $payload['navigasi'] = $this->obfuscateNavigasi($payload['navigasi'] ?? []);

        return $payload;
    }

    private function obfuscateMateriPayload(array $payload): array
    {
        if (isset($payload['id_progres_kelas'])) {
            $token = IdCipher::encode($payload['id_progres_kelas']);
            $payload['token'] = $token;
            $payload['id_progres_kelas_raw'] = $payload['id_progres_kelas'];
            $payload['id_progres_kelas'] = $token;
        }

        if (isset($payload['progres']['id_progres_kelas'])) {
            $token = IdCipher::encode($payload['progres']['id_progres_kelas']);
            $payload['progres']['token'] = $token;
            $payload['progres']['id_progres_kelas_raw'] = $payload['progres']['id_progres_kelas'];
            $payload['progres']['id_progres_kelas'] = $token;
        }

        $payload['navigasi'] = $this->obfuscateNavigasi($payload['navigasi'] ?? []);

        return $payload;
    }

    private function obfuscateNavigasi(array $navigasi): array
    {
        foreach (['materi_sebelumnya', 'materi_saat_ini', 'materi_selanjutnya'] as $key) {
            if (isset($navigasi[$key]['id_progres_kelas'])) {
                $token = IdCipher::encode($navigasi[$key]['id_progres_kelas']);
                $navigasi[$key]['token'] = $token;
                $navigasi[$key]['id_progres_kelas_raw'] = $navigasi[$key]['id_progres_kelas'];
                $navigasi[$key]['id_progres_kelas'] = $token;
            }
        }

        return $navigasi;
    }
}