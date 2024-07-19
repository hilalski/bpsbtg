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

class RevisiPenolakanPPKController extends Controller
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

        $listPenolakan = Penolakan::all();
        foreach ($listPenolakan as $penolakan) {
            // Pastikan kolom tanggal pengadaan ada dan bukan null
            if (!empty($penolakan->pengadaan->tanggal_pengadaan)) {
                // Parse tanggal dan ubah formatnya ke 'tanggal bulan(tulisan) tahun'
                // contoh: '1 Januari 2023'
                $penolakan->pengadaan->tanggal_pengadaan_formatted = Carbon::createFromFormat('Y-m-d', $penolakan->pengadaan->tanggal_pengadaan)
                    ->translatedFormat('j F Y');
            } else {
                // Jika tanggal tidak ada atau null, tetapkan nilai default atau tampilkan pesan error
                $penolakan->pengadaan->tanggal_pengadaan_formatted = 'Tanggal tidak valid';
            }

            // Tidak perlu menetapkan kembali ke objek $pengajuan karena kita hanya menambahkan properti baru
            $penolakan->pengadaan->status_color = $this->getColorStatus($penolakan->pengadaan->status);
        }

        return view('dashboard.pengadaan.ppk.revisi-penolakan', [
            'menu' => $menu,
            'listPenolakan' => $listPenolakan,
        ]);
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
}
