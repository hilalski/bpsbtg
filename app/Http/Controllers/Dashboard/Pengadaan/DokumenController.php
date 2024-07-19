<?php

namespace App\Http\Controllers\Dashboard\Pengadaan;

use Illuminate\Http\Request;
use App\Models\DokumenPengadaan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class DokumenController extends Controller
{
    public function downloadTemplate($filename)
    {
        $path = 'public/templates-dokumen/' . $filename;
        if (Storage::exists($path)) {
            Log::info('Download File: ' . $filename . ' berhasil');
            return Storage::download($path);
        }

        Log::error('Download File: ' . $filename . '.docx' . ' gagal');
        abort(404, 'File not found');
    }

    public function downloadDokumen($filename)
    {
        $path = 'public/templates-dokumen/' . $filename;
        if (Storage::exists($path)) {
            Log::info('Download File: ' . $filename . ' berhasil');
            return Storage::download($path);
        }

        Log::error('Download File: ' . $filename . '.docx' . ' gagal');
        abort(404, 'File not found');
    }
}
