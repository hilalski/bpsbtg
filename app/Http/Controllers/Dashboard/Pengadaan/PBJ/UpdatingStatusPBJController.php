<?php

namespace App\Http\Controllers\Dashboard\Pengadaan\PBJ;

use Carbon\Carbon;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use App\Models\StatusPengadaan;
use App\Models\DokumenPengadaan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdatingStatusPBJController extends Controller
{
    public function getColorStatus($status)
    {
        switch ($status) {
            case "Diajukan":
                return "bg-dark-light text-dark pe-none";
                break;
            case "Diterima":
                return "bg-primary text-light pe-none";
                break;
            case "Ditolak":
                return "bg-danger text-light pe-none";
                break;
            case "Revisi":
                return "bg-warning text-dark pe-none";
                break;
            case "Diproses":
                return "bg-info text-dark pe-none";
                break;
            case "Dilaksanakan":
                return "bg-primary-light text-dark pe-none";
                break;
            case "Selesai":
                return "bg-success text-light pe-none";
                break;
            case "Diserahkan":
                return "bg-secondary text-light pe-none";
                break;
            default:
                return "";
        }
    }

    public function index()
    {
        Carbon::setLocale('id');
        $menu = Menu::with('submenu')->get();
        $listPengajuan = Pengadaan::where('penyelenggara', 3)->get();

        foreach ($listPengajuan as $pengajuan) {
            if (!empty($pengajuan->tanggal_pengadaan)) {
                $pengajuan->tanggal_pengadaan_formatted = Carbon::createFromFormat('Y-m-d', $pengajuan->tanggal_pengadaan)
                    ->translatedFormat('j F Y');
            } else {
                $pengajuan->tanggal_pengadaan_formatted = 'Tanggal tidak valid';
            }

            $pengajuan->status_color = $this->getColorStatus($pengajuan->status);
        }

        return view('dashboard.pengadaan.pbj.index', [
            'menu' => $menu,
            'listPengajuan' => $listPengajuan,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $menu = Menu::with('submenu')->get();
        $roles = Role::all();
        $dokumen = Dokumen::find($id);
        $dokumen_pengadaan = DokumenPengadaan::find($id);
        $pengadaan = Pengadaan::where('id', $dokumen->pengadaan_id)->first();

        $statusDokumen = StatusPengadaan::where('pengadaan_id', $id)->get();
        $statusesWithDates = $statusDokumen->mapWithKeys(function ($item) {
            return [$item->status => Carbon::parse($item->changed_at)->translatedFormat('d') . '-' . Carbon::parse($item->changed_at)->translatedFormat('m') . '-' . Carbon::parse($item->changed_at)->translatedFormat('Y')];
        });
        $checkStatuses = ['Diajukan', 'Diterima PPK', 'Ditolak', 'Revisi', 'Diproses', 'Dilaksanakan', 'Selesai', 'Diserahkan'];
        return view('dashboard.pengadaan.pbj.details', [
            'menu' => $menu,
            'dokumen' => $dokumen,
            'roles' => $roles,
            'dokumen_pengadaan' => $dokumen_pengadaan,
            'statusesWithDates' => $statusesWithDates,
            'checkStatuses' => $checkStatuses,
            'pengadaan' => $pengadaan,
            'dokumenPengadaanId' => $dokumen_pengadaan->id
        ]);
    }


    public function download($nama_dokumen, $id)
    {
        $dokumen = Dokumen::find($id);

        if (!$dokumen) {
            abort(404); // Dokumen tidak ditemukan
        }

        if ($nama_dokumen === 'kak') {
            $filePath = public_path("storage/" . $dokumen->kak . ".pdf");
        } elseif ($nama_dokumen === 'bast') {
            $filePath = public_path("storage/" . $dokumen->bast . ".pdf");;
        }

        $headers = ['Content-Type: application/pdf'];
        $fileName = $dokumen->kak . time() . '.pdf';

        return response()->download($filePath, $fileName, $headers);
    }

    public function upload(Request $request)
    {
        try {

            $customMessages = [
                'uploadFile.required' => 'File tidak boleh kosong.',
                'uploadFile.mimes' => 'File harus dalam format PDF.', // Custom message for PDF validation
                'uploadFile.max' => 'Maksimal ukuran file 10MB.', // Custom message for max file size
            ];
            $request->validate([
                'uploadFile' => 'required|file|mimes:pdf|max:10480',
                'documentName' => 'required|string',
                'dokumen_id' => 'required|exists:dokumen_pengadaans,dokumen_id',
            ],  $customMessages);

            $file = $request->file('uploadFile');
            $timestamp = now()->timestamp;
            $fileName = $timestamp . '_' . $file->getClientOriginalName(); // Use the original filename for storage
            Log::info('Uploading file: ' . $fileName); // Log file name

            $filePath = $file->storeAs('public/documents', $fileName);

            $dokumenPengadaan = DokumenPengadaan::where('dokumen_id', $request->dokumen_id)->first();
            if (!$dokumenPengadaan) {
                Log::error('Dokumen Pengadaan not found for dokumen_id: ' . $request->dokumen_id);
                return back()->with('error', 'Dokumen Pengadaan not found.');
            }

            $dokumenPengadaan->{$request->documentName} = $filePath;
            $dokumenPengadaan->save();

            Log::info('File uploaded successfully: ' . $filePath); // Log success message
            return back()->with('success', 'File uploaded successfully.');
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage()); // Log exception
            return back()->withInput()->withErrors($e->validator);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'uploadFile' => 'required|file|max:2048',
            'documentName' => 'required|string',
            'dokumen_id' => 'required|exists:dokumen_pengadaans,dokumen_id',
        ]);

        $file = $request->file('uploadFile');
        $timestamp = now()->timestamp;
        $fileName = $timestamp . '_' . $file->getClientOriginalName(); // Use the original filename for storage

        $filePath = $file->storeAs('public/documents', $fileName);

        $dokumenPengadaan = DokumenPengadaan::where('dokumen_id', $request->dokumen_id)->first();
        if (!$dokumenPengadaan) {
            return back()->with('error', 'Dokumen Pengadaan not found.');
        }

        $dokumenPengadaan->{$request->documentName} = $filePath;
        $dokumenPengadaan->save();

        return back()->with('success', 'File uploaded successfully.');
    }

    public function downloadFile($dokumenId, $documentName)
    {
        // Mencari dokumen pengadaan berdasarkan dokumen_id
        $dokumenPengadaan = DokumenPengadaan::where('dokumen_id', $dokumenId)->first();

        if (!$dokumenPengadaan) {
            // Jika tidak ditemukan, kembalikan error atau lakukan penanganan kesalahan lainnya
            return back()->with('error', 'Dokumen Pengadaan not found.');
        }

        // Mengambil path file dari properti yang dinamis berdasarkan documentName
        $filePath = $dokumenPengadaan->$documentName;

        if (!Storage::exists($filePath)) {
            // Jika file tidak ditemukan di storage, kembalikan error
            return back()->with('error', 'File not found.');
        }

        $fileName = basename($filePath); // Mendapatkan hanya nama file

        // Mengembalikan file untuk di-download
        return Storage::download($filePath, $fileName);
    }

    public function updateStatus(Request $request) {
        $pengadaanId = $request->input('pengadaan_id');
        $pengadaan = Pengadaan::findOrFail($pengadaanId);
        $pengadaan->status = 'Selesai';
        $pengadaan->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
