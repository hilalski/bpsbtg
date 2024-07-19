<?php

namespace App\Http\Controllers\Dashboard\SuratTugas;

use App\Models\Menu;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSuratTugas;

class PengajuanSuratTugasController extends Controller
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

        return view('dashboard.surat-tugas.index', [
            'menu' => $menu,
            'users' => $users,
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
        return view('dashboard.surat-tugas.add', [
            'menu' => $menu,
        ]);
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string',
            'golongan' => 'required|string',
            'jabatan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_perdin_mulai' => 'required|date',
            'tanggal_perdin_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'nama_pejabat_ttd' => 'required|string',
            'jabatan_pejabat_ttd' => 'required|string',
            'file_path' => 'required|mimes:pdf,docx|max:10240',
            'lampiran'=> 'required|integer',
            'moda_transportasi' => 'required|string',
        ]);

        $file = $request->file('file_path');
        $file_path = $file->storeAs('public', $file->getClientOriginalName());

        $pengajuanSuratTugas = new PengajuanSuratTugas([
            'user_id' => auth()->user()->id,
            'no_surtug' => $request->input('no_surtug'),
            'name' => $request->input('name'),
            'nip' => $request->input('nip'),
            'golongan' => $request->input('golongan'),
            'jabatan' => $request->input('jabatan'),
            'nama_kegiatan' => $request->input('nama_kegiatan'),
            'lokasi' => $request->input('lokasi'),
            'tanggal_perdin_mulai' => $request->input('tanggal_perdin_mulai'),
            'tanggal_perdin_selesai' => $request->input('tanggal_perdin_selesai'),
            // 'tanggal_ttd' => $request->input('tanggal_ttd'),
            'nama_pejabat_ttd' => $request->input('nama_pejabat_ttd'),
            'jabatan_pejabat_ttd' => $request->input('jabatan_pejabat_ttd'),
            'file_path' => $file_path,
            'lampiran'=> $request->input('lampiran'),
            'moda_transportasi' => $request->input('moda_transportasi'),
        ]);

        $pengajuanSuratTugas->save();

        return back()->with('success', 'Surat tugas berhasil diajukan'); 
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