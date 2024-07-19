<?php

namespace App\Http\Controllers\Dashboard\Pengadaan\PPK;

use Carbon\Carbon;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Pengadaan;
use App\Models\Penolakan;
use Illuminate\Http\Request;
use App\Models\StatusPengadaan;
use App\Models\DokumenPengadaan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdatingStatusPPKController extends Controller
{
    public function getColorStatus($status)
    {
        switch ($status) {
            case "Diajukan":
                return "bg-dark-light text-dark pe-none";
                break;
            case "Diterima PPK":
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
        $listPengajuan = Pengadaan::all();

        foreach ($listPengajuan as $pengajuan) {

            if (!empty($pengajuan->tanggal_pengadaan)) {
                $pengajuan->tanggal_pengadaan_formatted = Carbon::createFromFormat('Y-m-d', $pengajuan->tanggal_pengadaan)
                    ->translatedFormat('j F Y');
            } else {
                $pengajuan->tanggal_pengadaan_formatted = 'Tanggal tidak valid';
            }

            $pengajuan->status_color = $this->getColorStatus($pengajuan->status);
        }

        $listPenolakan = Penolakan::all();
        foreach ($listPenolakan as $penolakan) {

            if (!empty($penolakan->pengadaan->tanggal_pengadaan)) {
                $penolakan->pengadaan->tanggal_pengadaan_formatted = Carbon::createFromFormat('Y-m-d', $penolakan->pengadaan->tanggal_pengadaan)
                    ->translatedFormat('j F Y');
            } else {
                $penolakan->pengadaan->tanggal_pengadaan_formatted = 'Tanggal tidak valid';
            }
            $penolakan->pengadaan->status_color = $this->getColorStatus($penolakan->pengadaan->status);
        }

        return view('dashboard.pengadaan.ppk.index', [
            'menu' => $menu,
            'listPengajuan' => $listPengajuan,
            'listPenolakan' => $listPenolakan,
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
        $roles = Role::whereIn('name', ['Unit', 'PPK', 'PBJ'])->get();

        $pengadaan = Pengadaan::findOrFail($pengadaanId);
        $dokumenId = Dokumen::where('pengadaan_id', $pengadaan->id)->pluck('id')->first();

        $dokumenPengadaans = DokumenPengadaan::where('dokumen_id', $dokumenId)->first();

        //Cek Semua Status Dokumen
        $statusDokumen = StatusPengadaan::where('pengadaan_id', $pengadaanId)->get();
        $statusesWithDates = $statusDokumen->mapWithKeys(function ($item) {
            return [$item->status => Carbon::parse($item->changed_at)->translatedFormat('d') . '-' . Carbon::parse($item->changed_at)->translatedFormat('m') . '-' . Carbon::parse($item->changed_at)->translatedFormat('Y')];
        });
        $checkStatuses = ['Diajukan', 'Diterima PPK', 'Ditolak', 'Revisi', 'Diproses', 'Dilaksanakan', 'Selesai', 'Diserahkan'];


        return view('dashboard.pengadaan.ppk.details', [
            'menu' => $menu,
            'roles' => $roles,
            'statusesWithDates' => $statusesWithDates,
            'checkStatuses' => $checkStatuses,
            'dokumenPengadaans' => $dokumenPengadaans,
            'pengadaan' => $pengadaan,
            // 'dokumenPengadaans' => $dokumenPengadaans,
        ]);
    }

    public function updateStatus($pengadaanId, $penyelenggara)
    {
        $pengadaan = Pengadaan::findOrFail($pengadaanId);
        try {
            switch ($pengadaan->status) {
                case 'Diajukan':
                    $newStatus = 'Diterima PPK';
                    break;
                case 'Diterima PPK':
                    $newStatus = 'Diproses';
                    if ($penyelenggara == 3) {
                        $pengadaan->penyelenggara = 3;
                        $pengadaan->save();
                    } elseif ($penyelenggara == 4) {
                        $pengadaan->penyelenggara = 4;
                        $pengadaan->save();
                    }
                    break;
                case 'Diproses':
                    $newStatus = 'Dilaksanakan';
                    break;
                case 'Dilaksanakan':
                    $newStatus = "Selesai";
                    break;
                case 'Selesai':
                    $newStatus = "Diserahkan";
                    break;
                case 'Revisi':
                    $newStatus = "Diajukan";
                    $pengadaan->status = $newStatus;
                    $pengadaan->save();

                    // Mencatat status baru ke tabel status_pengadaan
                    $statusPengadaan = new StatusPengadaan;
                    $statusPengadaan->pengadaan_id = $pengadaanId;
                    $statusPengadaan->status = $newStatus;
                    $statusPengadaan->changed_at = now();
                    $statusPengadaan->save();
                    return redirect()->route('unit.pengajuan.index');
                default:
                    // Handle other cases or do nothing
                    return abort(404);
            }
            $statusPengadaan = new StatusPengadaan;
            $statusPengadaan->pengadaan_id = $pengadaanId;
            $statusPengadaan->status = $newStatus;
            $statusPengadaan->changed_at = now();
            $statusPengadaan->save();
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function tolak(Request $request)
    {
        // Membuat penolakan baru
        try {
            $penolakan = new Penolakan();
            $penolakan->pengadaan_id = $request->input('pengadaan_id');
            $penolakan->alasan_penolakan = $request->input('alasan_penolakan');
            $penolakan->tanggal_penolakan = now(); // Atau tanggal spesifik jika ada
            $penolakan->save();

            $statusPengadaan = new StatusPengadaan();
            $statusPengadaan->pengadaan_id = $request->input('pengadaan_id');
            $statusPengadaan->status = $request->has('dengan_revisi') ? 'Revisi' : 'Ditolak';
            $statusPengadaan->changed_at = now();
            $statusPengadaan->save();
        } catch (\Exception $e) {

            abort(404);
        }
        // Redirect atau response lainnya
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Download the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function uploadFiles(Request $request)
    {
        $request->validate([
            'uploadedFile.*' => 'required|mimes:pdf|max:2048', // Batas maksimum 2MB
        ]);

        foreach ($request->file('uploadedFile') as $file) {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public', $fileName);

            // Simpan nama file ke database
            Dokumen::create(['file_name' => $fileName]);
        }
    }
}
