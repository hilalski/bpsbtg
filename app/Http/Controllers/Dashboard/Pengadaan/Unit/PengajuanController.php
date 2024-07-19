<?php

namespace App\Http\Controllers\Dashboard\Pengadaan\Unit;

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
use Illuminate\Support\Facades\Validator;

class PengajuanController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('id');
        $menu = Menu::with('submenu')->get();
        $userId = Auth::id();
        // Pengadaan yang diajukan oleh user yang sedang login
        $listPengajuan = Pengadaan::where('user_id', $userId)->get();


        foreach ($listPengajuan as $pengajuan) {
            // Pastikan kolom tanggal pengadaan ada dan bukan null
            if (!empty($pengajuan->tanggal_pengadaan)) {
                // Parse tanggal dan ubah formatnya ke 'tanggal bulan(tulisan) tahun'
                // contoh: '1 Januari 2023'
                $pengajuan->tanggal_pengadaan_formatted = Carbon::createFromFormat('Y-m-d', $pengajuan->tanggal_pengadaan)
                    ->translatedFormat('j F Y');
            } else {
                // Jika tanggal tidak ada atau null, tetapkan nilai default atau tampilkan pesan error
                $pengajuan->tanggal_pengadaan_formatted = 'Tanggal tidak valid';
            }

            // Tidak perlu menetapkan kembali ke objek $pengajuan karena kita hanya menambahkan properti baru
            $pengajuan->status_color = $this->getColorStatus($pengajuan->status);
        }

        return view('dashboard.pengadaan.unit.index', [
            'menu' => $menu,
            'listPengajuan' => $listPengajuan,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($pengadaanId)
    {
        $menu = Menu::with('submenu')->get();
        $pengadaan = Pengadaan::findOrFail($pengadaanId);
        $dokumenId = Dokumen::where('pengadaan_id', $pengadaan->id)->pluck('id')->first();
        $dokumenPengadaans = DokumenPengadaan::where('dokumen_id', $dokumenId)->first();

        $statusDokumen = StatusPengadaan::where('pengadaan_id', $pengadaanId)->get();
        $statusesWithDates = $statusDokumen->mapWithKeys(function ($item) {
            return [$item->status => Carbon::parse($item->changed_at)->translatedFormat('d') . '-' . Carbon::parse($item->changed_at)->translatedFormat('m') . '-' . Carbon::parse($item->changed_at)->translatedFormat('Y')];
        });
        $checkStatuses = ['Diajukan', 'Diterima PPK', 'Ditolak', 'Revisi', 'Diproses', 'Dilaksanakan', 'Selesai', 'Diserahkan'];
        // Mengambil dokumen pengadaan terkait dengan pengadaan yang dipilih
        //$dokumenPengadaans = $pengadaan->dokumenPengadaans;

        return view('dashboard.pengadaan.unit.details', [
            'menu' => $menu,
            'pengadaan' => $pengadaan,
            'statusesWithDates' => $statusesWithDates,
            'checkStatuses' => $checkStatuses,
            'dokumenPengadaans' => $dokumenPengadaans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::with('submenu')->get();
        $roles = Role::all();

        return view('dashboard.pengadaan.unit.add', [
            'menu' => $menu,
            'roles' => $roles,
        ]);
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'uploadFile' => 'required|file|max:2048',
                'documentName' => 'required|string',
                'dokumen_id' => 'required|exists:dokumen_pengadaans,dokumen_id',
            ]);

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
            return back()->with('error', 'File upload failed.');
        }
    }

    public function kirimForm(Request $request)
{
    $validatedData = Validator::make($request->all(), [
        'role_id' => 'required|numeric',
        'nama_pengadaan' => 'required|string',
        'tanggal_pengadaan' => 'required|date',
        'dokumen_kak' => 'required|mimes:pdf',
        'dokumen_memo' => 'nullable|mimes:pdf',
    ], [
        'role_id.required' => 'Unit tidak boleh kosong (pilih unit)',
        'role_id.numeric' => 'Pilih nama unit',
        'nama_pengadaan.required' => 'Nama pengadaan tidak boleh kosong',
        'tanggal_pengadaan.required' => 'Tanggal pengadaan tidak boleh kosong',
        'dokumen_kak.required' => 'Dokumen KAK tidak boleh kosong',
        'dokumen_kak.mimes' => 'Dokumen harus dalam format PDF',
        'dokumen_memo.mimes' => 'Dokumen harus dalam format PDF',
    ]);

    if ($validatedData->fails()) {
        return redirect()->back()->withErrors($validatedData)->withInput();
    } else {
        try {
            $validatedData = $validatedData->validated();
            $pengajuan = new Pengadaan;
            $pengajuan->user_id = auth()->user()->id;
            $pengajuan->nama_pengadaan = $validatedData['nama_pengadaan'];
            $pengajuan->tanggal_pengadaan = $validatedData['tanggal_pengadaan'];
            $pengajuan->penyelenggara = 4;

            if($pengajuan->save()){
                $statusPengadaan = new StatusPengadaan;
                $statusPengadaan->pengadaan_id = $pengajuan->id;
                $statusPengadaan->status = 'Diajukan';
                $statusPengadaan->changed_at = now();
                $statusPengadaan->save();
            }

            $dokumen = new Dokumen;
            $dokumen->pengadaan_id = $pengajuan->id;

            // Selalu ada dokumen KAK
            $pathKak = $request->file('dokumen_kak')->store('public/dokumen/pengadaan/kak');
            $dokumenPengadaan = new DokumenPengadaan;
            $dokumenPengadaan->dokumen_kak = $pathKak;

            // Cek apakah ada dokumen memo
            if ($request->hasFile('dokumen_memo')) {
                $pathMemo = $request->file('dokumen_memo')->store('public/dokumen/pengadaan/memo');
                $dokumenPengadaan->dokumen_memo = $pathMemo;
            }

            $dokumen->save();
            $dokumenPengadaan->dokumen_id = $dokumen->id;
            $dokumenPengadaan->save();

        return redirect()->route('unit.pengajuan.index')->with('success', 'Pengajuan pengadaan berhasil disimpan.');

        } catch (\Exception $e) {
            Log::error('Kesalahan saat menyimpan data: ' . $e->getMessage());
            return back()->with('status.error', 'Terjadi kesalahan saat mengirim form: ' . $e->getMessage());
        }
    }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
