<?php

namespace App\Http\Controllers\Content;

use App\Helpers\Tools;
use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use App\Services\App\DashboardService;
use App\Services\Kelas\KategoriService;
use App\Services\Kelas\KelasService;
use App\Services\Tools\ResponseService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class PortalController extends Controller
{
    public function __construct(
        private readonly ResponseService $responseService,
        private readonly KategoriService $kategoriService,
        private readonly KelasService $kelasService,
    ) {}

    public function index(): View
    {
        if (Auth::guard('admin')->check()) {
            $data = DashboardService::getDashboardAdmin();

            return view('admin.dashboard', [
                'data' => $data,
            ]);
        }

        if (Auth::guard('mentor')->check()) {
            $id_mentor = Auth::guard('mentor')->user()->id_mentor;
            $data = DashboardService::getDashboardMentor($id_mentor);

            return view('mentor.dashboard', [
                'data' => $data,
            ]);
        }

        $categories = $this->getCachedCategories();
        $baruClasses = $this->getCachedBaruClasses();

        return view('content.content', compact('categories', 'baruClasses'));
    }

    public function error(Request $request): JsonResponse
    {
        $csrfToken = $request->header('X-CSRF-TOKEN');

        if ($csrfToken !== csrf_token()) {
            return $this->responseService->errorResponse('Token CSRF tidak valid.');
        }

        Log::channel('daily')->error('client-error', [
            'data' => $request->all(),
        ]);

        return $this->responseService->successResponse('Error berhasil dicatat.');
    }

    public function sertifikat_verifikasi(string $id)
    {
        $sertifikat = Sertifikat::query()
            ->where('kode_verifikasi', $id)
            ->first();

        return view('content.sertifikat_verifikasi', [
            'sertifikat' => $sertifikat,
            'status' => $sertifikat ? 'valid' : 'invalid',
            'formattedTanggalSelesai' => $sertifikat?->tanggal_selesai
                ? Tools::formatTanggalIndonesia($sertifikat->tanggal_selesai)
                : null,
            'formattedDiterbitkan' => $sertifikat?->dicetak_pada
                ? Tools::formatTanggalIndonesia($sertifikat->dicetak_pada)
                : null,
            'kode' => $id,
        ]);
    }

    private function getCachedCategories()
    {
        $cached = $this->kategoriService
            ->getListData()
            ->map(fn ($row) => $row->toArray())
            ->all();

        return collect($cached ?? [])->map(fn ($row) => (object) $row);
    }

    private function getCachedBaruClasses(int $limit = 3)
    {
        $cached = $this->kelasService
            ->getbaruClasses($limit)
            ->map(fn ($row) => $row->toArray())
            ->all();

        return collect($cached ?? [])->map(fn ($row) => (object) $row);
    }
}