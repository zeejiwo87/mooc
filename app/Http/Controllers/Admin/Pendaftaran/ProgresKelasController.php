<?php

namespace App\Http\Controllers\Admin\Pendaftaran;

use App\Helpers\Tools;
use App\Http\Controllers\Controller;
use App\Services\Pendaftaran\PendaftaranService;
use App\Services\Pendaftaran\ProgresKelasService;
use App\Services\Tools\FileUploadService;
use App\Services\Tools\ResponseService;
use App\Services\Tools\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

final class ProgresKelasController extends Controller
{
    public function __construct(
        private readonly ProgresKelasService $progresKelasService,
        private readonly PendaftaranService $PendaftaranService,
        private readonly TransactionService $transactionService,
        private readonly ResponseService $responseService,
        private readonly FileUploadService $fileUploadService
    ) {}

    public function index(string $id)
    {
        $pendaftaran = $this->PendaftaranService->getDetailData($id);
        if (! $pendaftaran) {
            abort(404);
        }

        $progres = $this->progresKelasService->getListData($id);

        return view('admin.progres_kelas.index', [
            'id' => $id,
            'pendaftaran' => $pendaftaran,
            'progres' => $progres,
        ]);
    }

    public function sync(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->PendaftaranService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            $this->progresKelasService->syncProgresForPendaftaran($data);

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function syncTuntas(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->PendaftaranService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            $this->progresKelasService->syncTunasPendaftaran($id);

            return $this->responseService->successResponse('Data berhasil diambil', $data);
        });
    }

    public function delete(string $id): JsonResponse
    {
        return $this->transactionService->handleWithShow(function () use ($id) {
            $data = $this->PendaftaranService->getDetailData($id);

            if (! $data) {
                return $this->responseService->errorResponse('Data tidak ditemukan');
            }

            $this->progresKelasService->delete($id);

            return $this->responseService->successResponse('Data berhasil hapus', $data);
        });
    }

    public function sertifikat(string $id)
    {
        try {

            $sertifikat = $this->progresKelasService->sertifikat($id);
            if (! $sertifikat) {
                return response()->json(['error' => 'Sertifikat tidak ditemukan'], 404);
            }

            $safeNomor = $this->fileUploadService->generateSafeFileName($sertifikat->nomor_sertifikat);
            $filenamePdf = 'sertifikat-'.$safeNomor;

            if (! empty($sertifikat->pdf_url) && Storage::exists($sertifikat->pdf_url)) {
                return response()->download(Storage::path($sertifikat->pdf_url), $filenamePdf.'.pdf', [
                    'Content-Type' => 'application/pdf',
                ]);
            }

            $templateFile = $this->progresKelasService->templateSertifikat($id);
            if (! $templateFile || ! Storage::exists('sertifikat/'.$templateFile)) {
                return response()->json(['error' => 'Template tidak ditemukan'], 404);
            }

            $placeholders = [
                'nama_penerima' => $sertifikat->nama_penerima ?? '-',
                'judul_kelas' => $sertifikat->judul_kelas ?? '-',
                'tanggal_selesai' => Tools::formatTanggalIndonesia($sertifikat->tanggal_selesai),
                'nomor_sertifikat' => $sertifikat->nomor_sertifikat ?? '-',
                'url' => $sertifikat->qr_code_url ?? '-',
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
}
