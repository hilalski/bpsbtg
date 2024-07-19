<?php

namespace App\Http\Controllers\Dashboard\Perizinan;

use App\Models\Menu;
use App\Models\RapatPerizinanDosen;
use App\Models\RapatPerizinanMahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RapatPresensiMahasiswa;
use App\Models\UserMahasiswa;

class KonfirmasiPerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('submenu')->get();

        // Fetch perizinan data for dosen with status 'Menunggu'
        $perizinanDosenMenunggu = RapatPerizinanDosen::where('status', 'Menunggu')->get();

        // Fetch perizinan data for mahasiswa with status 'Menunggu'
        $perizinanMahasiswaMenunggu = RapatPerizinanMahasiswa::where('status', 'Menunggu')->get();

        // $nim = $perizinanMahasiswaMenunggu->mahasiswa_nim;
        // $mahasiswa = UserMahasiswa::where('nim',$nim)->first;

        // Fetch perizinan data for dosen with statuses 'Diterima' and 'Ditolak'
        $perizinanDosenRiwayat = RapatPerizinanDosen::whereIn('status', ['Diterima', 'Ditolak'])->get();

        // Fetch perizinan data for mahasiswa with statuses 'Diterima' and 'Ditolak'
        $perizinanMahasiswaRiwayat = RapatPerizinanMahasiswa::whereIn('status', ['Diterima', 'Ditolak'])->get();

        return view('dashboard.perizinan.konfirmasi-perizinan.index', [
            'menu' => $menu,
            'perizinanDosenMenunggu' => $perizinanDosenMenunggu,
            'perizinanMahasiswaMenunggu' => $perizinanMahasiswaMenunggu,
            'perizinanDosenRiwayat' => $perizinanDosenRiwayat,
            'perizinanMahasiswaRiwayat' => $perizinanMahasiswaRiwayat,
        ]);
    }

    public function status($id){
        $menu = Menu::with('submenu')->get();
        $rapat = RapatPerizinanMahasiswa::where('id',$id)->first();
        $nim = $rapat->mahasiswa_nim;
        // $mahasiswa = RapatPresensiMahasiswa::where('mahasiswa_nim',$nim);
        RapatPresensiMahasiswa::where('mahasiswa_nim', $nim)->update(['persentase' => 100]);
        // $mahasiswa->persentase = 100;
        $rapat->status = 'Diterima';
        $rapat->save();

        return redirect()->route('konfirmasi.index');
    }

    public function ditolak($id){
        $menu = Menu::with('submenu')->get();
        $rapat = RapatPerizinanMahasiswa::where('id',$id)->first();
        $rapat->status = 'Ditolak';
        $rapat->save();

        return redirect()->route('konfirmasi.index');
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
