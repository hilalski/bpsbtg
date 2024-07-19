<?php

namespace App\Http\Controllers\Dashboard\SuratTugas\PersetujuanSuratTugas;

use App\Models\Menu;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSuratTugas;
use Illuminate\Support\Facades\Auth;

class PersetujuanSuratTugasController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('submenu')->get();
        $users = User::all();
        $persetujuanSuratTugas = PengajuanSuratTugas::where('status_surtug', 0)->where('nama_pejabat_ttd', auth()->user()->name)->get();
        return view('dashboard.surat-tugas.persetujuan-surat-tugas.index', [ //semacam track lokasi folder file view (dalam hal ini adalah file view index)
            'menu' => $menu,
            'users' => $users,
            'persetujuanSuratTugas' => $persetujuanSuratTugas,
        ]);
    }

    public function setujuiAction($id)
    {
        $pengajuanSuratTugas = PengajuanSuratTugas::find($id);

        if (!$pengajuanSuratTugas->no_surtug) {
            $pengajuanSuratTugas->no_surtug = $this->generateNoSurtug();
        }

        $pengajuanSuratTugas->status_surtug = 1; // Ubah status_surtug menjadi 1 (disetujui)
        $pengajuanSuratTugas->kode_track = 2;
        $pengajuanSuratTugas->save();

        return response()->json(['message' => 'Surat tugas disetujui!']);
    }

    public function tolakAction($id)
    {
        $pengajuanSuratTugas = PengajuanSuratTugas::find($id);
        $pengajuanSuratTugas->kode_track = 0;
        $pengajuanSuratTugas->status_surtug = 2; // Ubah status_surtug menjadi 2 (ditolak)
        $pengajuanSuratTugas->save();

        return response()->json(['message' => 'Surat tugas ditolak!']);
    }

    protected function generateNoSurtug()
    {
        // Logika untuk menghasilkan nomor surat tugas baru
        // Misalnya, Anda dapat mengambil tahun dan jumlah surat tugas disetujui saat ini
        $tahun = date('Y');
        $bulan = date('m');
        $jumlahSuratTugas = PengajuanSuratTugas::where('status_surtug', 1)->count() + 1;

        // Format nomor surat tugas
        $jumlahSuratTugasFormatted = str_pad($jumlahSuratTugas, 3, '0', STR_PAD_LEFT);

        $noSurtug = "B-$jumlahSuratTugasFormatted/02722/KU.300/$bulan/$tahun";

        return $noSurtug;
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
