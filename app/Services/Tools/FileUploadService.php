<?php

namespace App\Services\Tools;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;
use RuntimeException;

final class FileUploadService
{
    private const ALLOWED_DIRECTORIES = [
        'banner',
        'profil',
        'sertifikat',
        'sertifikat_pendaftaran',
        'soal',
        'dokumen',
        'materi',
        'lampiran',
    ];

    public function viewFile(string $directory, string $fileName)
    {
        $directory = $this->normalizeDirectory($directory);
        $fileName = $this->normalizeFileName($fileName);

        $this->ensureAllowedDirectory($directory);

        $path = $directory.'/'.$fileName;

        if (! Storage::exists($path)) {
            throw new RuntimeException('File not found: '.$path);
        }

        $absolutePath = Storage::path($path);
        $this->ensureFileInsideStorage($absolutePath);

        $mimeType = mime_content_type($absolutePath) ?: 'application/octet-stream';
        $disposition = $this->shouldDisplayInline($mimeType) ? 'inline' : 'attachment';

        return response()->file($absolutePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => $disposition.'; filename="'.addslashes($fileName).'"',
            'Cache-Control' => 'public, max-age=7200',
            'X-Content-Type-Options' => 'nosniff',
            'Expires' => gmdate('D, d M Y H:i:s', time() + 7200).' GMT',
        ]);
    }

    public function deleteFile(string $fileName, string $directory): bool
    {
        try {
            $directory = $this->normalizeDirectory($directory);
            $fileName = $this->normalizeFileName($fileName);

            $this->ensureAllowedDirectory($directory);

            $filePath = $directory.'/'.$fileName;

            if (! Storage::exists($filePath)) {
                return false;
            }

            return Storage::delete($filePath);
        } catch (\Exception) {
            return false;
        }
    }

    public function uploadByType(
        UploadedFile $file,
        string $type,
        ?string $customFileName = null
    ): array {
        return $this->upload($file, $type, $customFileName);
    }

    private function upload(
        UploadedFile $file,
        string $directory,
        ?string $customFileName = null
    ): array {
        $directory = $this->normalizeDirectory($directory);
        $this->ensureAllowedDirectory($directory);

        $fileName = $customFileName
            ? $this->normalizeFileName($customFileName)
            : $this->generateDefaultFileName($file);

        try {
            $path = Storage::putFileAs($directory, $file, $fileName);

            if ($path === false) {
                throw new RuntimeException('Gagal menyimpan file ke storage');
            }

            return [
                'file_name' => $fileName,
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType() ?? 'application/octet-stream',
                'extension' => strtolower($file->getClientOriginalExtension()),
                'url' => Storage::url($path),
            ];
        } catch (\Exception $e) {
            throw new RuntimeException('Gagal mengupload file: '.$e->getMessage(), 0, $e);
        }
    }

    private function generateDefaultFileName(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $uuid = str_replace('-', '', (string) Str::uuid());

        return $uuid.'.'.$extension;
    }

    public function updateFileByType(
        UploadedFile $newFile,
        ?string $oldFileName,
        string $type,
        ?string $customFileName = null
    ): array {
        return $this->updateFile($newFile, $type, $oldFileName, $customFileName);
    }

    private function updateFile(
        UploadedFile $newFile,
        string $directory,
        ?string $oldFileName = null,
        ?string $customFileName = null
    ): array {
        $directory = $this->normalizeDirectory($directory);
        $this->ensureAllowedDirectory($directory);

        $uploadResult = $this->upload($newFile, $directory, $customFileName);

        if ($oldFileName && $oldFileName !== $uploadResult['file_name']) {
            try {
                $this->deleteFile($oldFileName, $directory);
            } catch (\Exception) {
            }
        }

        return $uploadResult;
    }

    private function normalizeDirectory(string $directory): string
    {
        $directory = trim(str_replace('\\', '/', $directory), "/ \t\n\r\0\x0B");

        if (
            $directory === '' ||
            str_contains($directory, '..') ||
            str_contains($directory, '//') ||
            preg_match('/[^A-Za-z0-9_\-\/]/', $directory)
        ) {
            throw new RuntimeException('Invalid directory path');
        }

        return $directory;
    }

    private function normalizeFileName(string $fileName): string
    {
        $fileName = trim(str_replace('\\', '/', $fileName));

        if (
            $fileName === '' ||
            str_contains($fileName, '..') ||
            str_contains($fileName, '/') ||
            str_contains($fileName, "\0") ||
            ! preg_match('/^[A-Za-z0-9][A-Za-z0-9._-]*$/', $fileName)
        ) {
            throw new RuntimeException('Invalid file name');
        }

        return $fileName;
    }

    private function ensureAllowedDirectory(string $directory): void
    {
        if (! in_array($directory, self::ALLOWED_DIRECTORIES, true)) {
            throw new RuntimeException('Directory is not allowed');
        }
    }

    private function ensureFileInsideStorage(string $absolutePath): void
    {
        $storageRoot = realpath(Storage::path(''));
        $realFilePath = realpath($absolutePath);

        if (! $storageRoot || ! $realFilePath || ! str_starts_with($realFilePath, $storageRoot.DIRECTORY_SEPARATOR)) {
            throw new RuntimeException('Invalid file path');
        }
    }

    private function shouldDisplayInline(string $mimeType): bool
    {
        return in_array($mimeType, [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'application/pdf',
        ], true);
    }

    public function generateSertifikatPdf(
        string $templatePath,
        array $placeholders,
        string $outputFileName,
        string $outputDirectory
    ): array {
        $qrRelativePath = null;
        
        try {
            $qrText = $placeholders['url'] ?? null;
            if (! empty($qrText) && $qrText !== '-') {
                $qrApiUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data='.urlencode($qrText);
                $response = Http::timeout(10)->get($qrApiUrl);

                if ($response->successful()) {
                    Storage::makeDirectory('temp/qr/qr');
                    $qrRelativePath = 'temp/qr/qr/qr_'.md5($qrText).'.png';
                    Storage::put($qrRelativePath, $response->body());
                    $qrImagePath = Storage::path($qrRelativePath);
                    $placeholders['qr_code'] = $qrImagePath;
                }
            }

            if (! Storage::exists($templatePath)) {
                throw new RuntimeException('Template tidak ditemukan');
            }

            $templateFullPath = Storage::path($templatePath);
            $templateProcessor = new TemplateProcessor($templateFullPath);

            foreach ($placeholders as $key => $value) {
                try {
                    if ($key === 'qr_code' && is_string($value) && file_exists($value)) {
                        $templateProcessor->setImageValue($key, [
                            'path' => $value,
                            'width' => 120,
                            'height' => 120,
                            'ratio' => false,
                        ]);
                    } else {
                        $templateProcessor->setValue($key, $value);
                    }
                } catch (\Exception $e) {
                    $result = [
                        'success' => false,
                        'error' => $e->getMessage(),
                    ];
                }
            }

            Storage::makeDirectory('temp/sertifikat');
            $docxPath = 'temp/sertifikat/'.$outputFileName.'_'.time().'.docx';
            $docxFullPath = Storage::path($docxPath);
            $templateProcessor->saveAs($docxFullPath);

            if (! file_exists($docxFullPath) || filesize($docxFullPath) < 1000) {
                throw new RuntimeException('File DOCX tidak terbentuk dengan benar');
            }

            $envPath = env('LIBREOFFICE_PATH');
            if ($envPath) {
                $tempPdfPath = $this->convertDocxToPdf($docxFullPath);
            }else{
                $tempPdfPath = $this->convertDocxToPdf2($docxFullPath);

            }

            if (! $tempPdfPath || ! file_exists($tempPdfPath) || filesize($tempPdfPath) < 1000) {
                throw new RuntimeException('Gagal konversi DOCX ke PDF');
            }

            Storage::makeDirectory($outputDirectory);
            $finalPdfRelative = $outputDirectory.'/'.$outputFileName.'.pdf';
            $finalPdfFull = Storage::path($finalPdfRelative);

            if (file_exists($finalPdfFull)) {
                @unlink($finalPdfFull);
            }

            rename($tempPdfPath, $finalPdfFull);

            if (! file_exists($finalPdfFull) || filesize($finalPdfFull) < 1000) {
                throw new RuntimeException('PDF final tidak valid');
            }

            if (file_exists($docxFullPath)) {
                @unlink($docxFullPath);
            }

            $result = [
                'success' => true,
                'pdf_path' => $finalPdfRelative,
                'pdf_url' => Storage::url($finalPdfRelative),
                'file_size' => filesize($finalPdfFull),
            ];
        } catch (\Throwable $e) {
            $result = [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }

        if ($qrRelativePath && Storage::exists($qrRelativePath)) {
            Storage::delete($qrRelativePath);
        }

        return $result;
    }

private function convertDocxToPdf2(string $docxPath): ?string
{
    try {
        $apiToken = env('CONVERTAPI_TOKEN');
        if (empty($apiToken)) {
            \Log::error('ConvertAPI token not configured');
            return null;
        }

        $pdfPath = preg_replace('/\.docx$/i', '.pdf', $docxPath);
        
        // Siapkan curl request ke ConvertAPI
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://v2.convertapi.com/convert/docx/to/pdf');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiToken,
        ]);
        
        // Gunakan \CURLFile dengan backslash (namespace global)
        $curlFile = new \CURLFile($docxPath, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', basename($docxPath));
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'File' => $curlFile,
        ]);
        
        // Eksekusi curl
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        // Cek error curl
        if ($curlError) {
            \Log::error('ConvertAPI curl error: ' . $curlError);
            return null;
        }
        
        // Cek response HTTP
        if ($httpCode !== 200) {
            \Log::error('ConvertAPI HTTP error: ' . $httpCode . ' - Response: ' . $response);
            return null;
        }
        
        // Parse JSON response
        $responseData = json_decode($response, true);
        
        if (!isset($responseData['Files']) || empty($responseData['Files'])) {
            \Log::error('ConvertAPI response missing Files array');
            return null;
        }
        
        // Ambil FileData dari response (base64 encoded) - PERBAIKAN DI SINI
        $fileData = $responseData['Files'][0]['FileData'] ?? null;
        
        if (!$fileData) {
            \Log::error('ConvertAPI response missing FileData');
            return null;
        }
        
        // Decode base64 ke binary
        $pdfContent = base64_decode($fileData);
        
        if ($pdfContent === false) {
            \Log::error('Failed to decode base64 FileData');
            return null;
        }
        
        // Simpan file PDF ke local
        if (file_put_contents($pdfPath, $pdfContent) === false) {
            \Log::error('Failed to save PDF to: ' . $pdfPath);
            return null;
        }
        
        // Verifikasi file PDF valid
        if (file_exists($pdfPath) && filesize($pdfPath) > 1000) {
            return $pdfPath;
        }
        
        return null;
        
    } catch (\Exception $e) {
        \Log::error('ConvertAPI exception: ' . $e->getMessage());
        return null;
    }
}


    private function convertDocxToPdf(string $docxPath): ?string
    {
        try {
            $outputDir = dirname($docxPath);
            $pdfPath = preg_replace('/\.docx$/i', '.pdf', $docxPath);

            $envPath = env('LIBREOFFICE_PATH');
            $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

            $command = null;

            if ($envPath && file_exists($envPath)) {
                if ($isWindows) {
                    $command = sprintf(
                        '"%s" --headless --convert-to pdf --outdir "%s" "%s" 2>&1',
                        $envPath,
                        $outputDir,
                        $docxPath
                    );
                } else {
                    $command = sprintf(
                        '%s --headless --convert-to pdf --outdir %s %s 2>&1',
                        escapeshellcmd($envPath),
                        escapeshellarg($outputDir),
                        escapeshellarg($docxPath)
                    );
                }
            } else {
                if ($isWindows) {
                    $librePaths = [
                        'C:\\Program Files\\LibreOffice\\program\\soffice.exe',
                        'C:\\Program Files (x86)\\LibreOffice\\program\\soffice.exe',
                    ];

                    if (getenv('PROGRAMFILES')) {
                        $librePaths[] = getenv('PROGRAMFILES').'\\LibreOffice\\program\\soffice.exe';
                    }
                    if (getenv('PROGRAMFILES(X86)')) {
                        $librePaths[] = getenv('PROGRAMFILES(X86)').'\\LibreOffice\\program\\soffice.exe';
                    }

                    $soffice = null;
                    foreach ($librePaths as $path) {
                        if (file_exists($path)) {
                            $soffice = $path;
                            break;
                        }
                    }

                    if (! $soffice) {
                        return null;
                    }

                    $command = sprintf(
                        '"%s" --headless --convert-to pdf --outdir "%s" "%s" 2>&1',
                        $soffice,
                        $outputDir,
                        $docxPath
                    );
                } else {
                    $soffice = trim(shell_exec('which libreoffice') ?? '');
                    if ($soffice === '') {
                        $soffice = trim(shell_exec('which soffice') ?? '');
                    }

                    if ($soffice === '') {
                        return null;
                    }

                    $command = sprintf(
                        '%s --headless --convert-to pdf --outdir %s %s 2>&1',
                        escapeshellcmd($soffice),
                        escapeshellarg($outputDir),
                        escapeshellarg($docxPath)
                    );
                }
            }

            if (! $command) {
                return null;
            }

            $output = [];
            $returnCode = 0;
            exec($command, $output, $returnCode);

            $maxWait = $isWindows ? 10 : 5;
            $waited = 0.0;
            $checkInterval = 0.5;

            while (! file_exists($pdfPath) && $waited < $maxWait) {
                usleep((int) ($checkInterval * 1_000_000));
                $waited += $checkInterval;
            }

            if (file_exists($pdfPath) && filesize($pdfPath) > 1000) {
                return $pdfPath;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function generateSafeFileName(string $nomorSertifikat): string
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '-', $nomorSertifikat);
    }
}
