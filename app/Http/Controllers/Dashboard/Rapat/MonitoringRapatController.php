<?php

namespace App\Http\Controllers\Dashboard\Rapat;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Rapat;
use App\Models\Tempat;
use App\Models\UserDosen;
use App\Models\RisetBidang;
use Illuminate\Http\Request;
use App\Models\UserMahasiswa;
use App\Models\RapatPresensiDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RapatPresensiMahasiswa;

class MonitoringRapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rapat = Rapat::orderBy('waktu_mulai', 'desc')->get();
        foreach ($rapat as $r) {
            $tempat = Tempat::find($r->tempat_id);
            $r->nama_tempat = $tempat ? $tempat->nama_tempat : null;
            $r->hari_tanggal = Carbon::parse($r->waktu_mulai)->timezone('Asia/Jakarta')->translatedFormat('l, d-m-Y');
            $r->waktu_mulai = Carbon::parse($r->waktu_mulai)->timezone('Asia/Jakarta')->translatedFormat('H:i');
            $r->waktu_selesai = Carbon::parse($r->waktu_selesai)->timezone('Asia/Jakarta')->translatedFormat('H:i');

            $waktuSelesai = Carbon::parse($r->waktu_selesai, 'Asia/Jakarta');
            if ($waktuSelesai > now('Asia/Jakarta')) {
                $r->borderClass = 'border-primary';
            } elseif ($waktuSelesai->diffInDays(now('Asia/Jakarta'), false) <= 2) {
                $r->borderClass = 'border-success';
            } else {
                $r->borderClass = 'border-secondary';
            }
        }
        $menu = Menu::with('submenu')->get();
        $userMahasiswa = null;

        if (Auth::check()) {
            $userId = Auth::id();
            $userMahasiswa = UserMahasiswa::where('user_id', $userId)->first();
        }

        return view('dashboard.rapat.monitoring-rapat.index', [
            'menu' => $menu,
            'rapat' => $rapat,
            'userMahasiswa' => $userMahasiswa,
        ]);
    }

    public function detail($id)
    {
        $menu = Menu::with('submenu')->get();
        $rapat = Rapat::findOrFail($id); // Fetch the meeting details

        $rapat = Rapat::with(['rapatPresensiMahasiswa.mahasiswa', 'rapatPresensiDosen.dosen', 'tempat'])
        ->findOrFail($id);

        return view('dashboard.rapat.monitoring-rapat.detail', [
            'rapat' => $rapat,
            'menu' => $menu,
            'rapat_presensi_mahasiswa' => $rapat->rapatPresensiMahasiswa,
            'rapat_presensi_dosen' => $rapat->rapatPresensiDosen,
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
        $risetBidang = RisetBidang::all();

        return view('dashboard.rapat.monitoring-rapat.add', [
            'menu' => $menu,
            'riset_bidang' => $risetBidang,
        ]);
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
