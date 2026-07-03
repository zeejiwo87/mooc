<?php

namespace App\Http\Controllers;

use App\Services\Tools\FileUploadService;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function __construct(
        private readonly FileUploadService $fileUploadService,
    ) {}

    public function viewFile(string $dir, string $filename): BinaryFileResponse|StreamedResponse
    {
        try {
            return $this->fileUploadService->viewFile($dir, $filename);
        } catch (Exception $e) {
            Log::error('view-file-error', ['message' => $e->getMessage()]);
            abort(404, 'File not found.');
        }
    }
}
