<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Models\Menu;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSuratTugas;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF;


// use Config\app;
// use PDF;

class PengecekanSuratTugasController  extends Controller
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
        $pengecekanSuratTugas = PengajuanSuratTugas::where('status_surtug', 1)->whereIn('kode_track', [2, 3, 4])->get();

        return view('dashboard.operator.pengecekan-surat-tugas.index', [ //semacam track lokasi folder file view (dalam hal ini adalah file view index)
            'menu' => $menu,
            'users' => $users,
            'pengecekanSuratTugas' => $pengecekanSuratTugas,
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
        return view('dashboard.operator.pengecekan-surat-tugas.cek', [
            'menu' => $menu,
        ]);
    }

    public function editForm($id)
    {
        $menu = Menu::with('submenu')->get();
        $pengecekanSuratTugas = PengajuanSuratTugas::findOrFail($id);

        return view('dashboard.operator.pengecekan-surat-tugas.cek', [
            'menu' => $menu,
            'pengecekanSuratTugas' => $pengecekanSuratTugas,
        ]);
    }

    public function updateForm(Request $request, $id)
    {
        $pengajuanSuratTugas = PengajuanSuratTugas::findOrFail($id);
        $pengajuanSuratTugas->kode_track = 3;
        $pengajuanSuratTugas->update($request->all());

        // Tambahkan logika untuk mengubah nilai keterangan
        $keterangan = $request->has('name') ? 'Sudah dilengkapi' : 'Belum dilengkapi';
        $pengajuanSuratTugas->update(['keterangan' => $keterangan]);
        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function downloadpdf($id) 
    {
        $data = PengajuanSuratTugas::findOrFail($id);
        $data->update(['kode_track' => 4]);

        if ($data->lampiran == 0) {
            $pdf = PDF::loadView('dashboard.operator.pengecekan-surat-tugas.surtug-tanpa-lampiran-pdf', [
                'data' => $data,
            ]);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('dashboard.operator.pengecekan-surat-tugas.surtug-tanpa-lampiran-pdf');
        }
        elseif ($data->lampiran == 1) {
            $pdf = PDF::loadView('dashboard.operator.pengecekan-surat-tugas.surtug-dalam-kota-pdf', [
                'data' => $data,
            ]);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('dashboard.operator.pengecekan-surat-tugas.surtug-dalam-kota-pdf');
        }
        else {
            $pdf = PDF::loadView('dashboard.operator.pengecekan-surat-tugas.surtug-luar-kota-pdf', [
                'data' => $data,
            ]);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('dashboard.operator.pengecekan-surat-tugas.surtug-luar-kota-pdf');
        } 
    }

    public function selesaiAction($id)
    {
        $pengajuanSuratTugas = PengajuanSuratTugas::find($id);
        $pengajuanSuratTugas->kode_track = 5;
        $pengajuanSuratTugas->save();

        return redirect()->route('pengecekansurtug.index');
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
        // Ambil detail surat tugas berdasarkan ID
        $detailPengecekanSuratTugas = PengajuanSuratTugas::findOrFail($id);

        $menu = Menu::with('submenu')->get();
        $users = User::all();

        // Periksa nilai 'lampiran'
        if ($detailPengecekanSuratTugas->lampiran === 2) {
            return view('dashboard.operator.pengecekan-surat-tugas.cek', [
                'menu' => $menu,
                'users' => $users,
                'detailPengecekanSuratTugas' => $detailPengecekanSuratTugas,
            ]);
        } else {
            // Handle unauthorized access
            abort(403, 'Unauthorized access');
        }
    }

    public function showDalam($id)
    {
        // Ambil detail surat tugas berdasarkan ID
        $detailPengecekanSuratTugasDalam = PengajuanSuratTugas::findOrFail($id);

        // Periksa nilai 'lampiran'
        $menu = Menu::with('submenu')->get();
        $users = User::all();

        if (in_array($detailPengecekanSuratTugasDalam->lampiran, [0, 1])) {
            return view('dashboard.operator.pengecekan-surat-tugas.cek_dalam', [
                'menu' => $menu,
                'users' => $users,
                'detailPengecekanSuratTugasDalam' => $detailPengecekanSuratTugasDalam,
            ]);
        } else {
            // Handle unauthorized access
            abort(403, 'Unauthorized access');
        }
    }

    public function tampil($id)
    {
        // Ambil detail dari database berdasarkan ID
        $detailPengecekanSuratTugas = PengajuanSuratTugas::findOrFail($id);

        $menu = Menu::with('submenu')->get();
        $users = User::all();

        // Periksa nilai 'lampiran'
        if ($detailPengecekanSuratTugas->lampiran == 2) {
            return view('dashboard.operator.pengecekan-surat-tugas.cek', ['menu' => $menu, 'users' => $users, 'detailPengecekanSuratTugas' => $detailPengecekanSuratTugas], compact('detailPengecekanSuratTugas'));
        } else {
            return view('dashboard.operator.pengecekan-surat-tugas.cek_dalam', ['menu' => $menu, 'users' => $users, 'detailPengecekanSuratTugas' => $detailPengecekanSuratTugas] , compact('detailPengecekanSuratTugas'));
        }
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