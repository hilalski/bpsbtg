<?php

namespace App\Http\Controllers\Dashboard\Perizinan;

use App\Models\Menu;
use App\Models\RapatPerizinanDosen;
use App\Models\RapatPerizinanMahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserMahasiswa;
use Illuminate\Support\Facades\Auth;

class RiwayatPerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('submenu')->get();
        $user = Auth::user();

        if ($user->userMahasiswa) {
            $userData = $user->userMahasiswa->nim;
            $rapatIzin = RapatPerizinanMahasiswa::where('mahasiswa_nim', $userData)->get();
        } elseif ($user->userDosen) {
            $userData = $user->userDosen->nip;
            $rapatIzin = RapatPerizinanDosen::where('dosen_nip', $userData)->get();
        } else {
            $rapatIzin = collect();
        }
    
        return view('dashboard.perizinan.riwayat-perizinan.index', [
            'menu' => $menu,
            'rapatIzin' => $rapatIzin,
        ]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id)
    {
        if ($type == 'dosen') {
            $izin = RapatPerizinanDosen::findOrFail($id);
        } elseif ($type == 'mahasiswa') {
            $izin = RapatPerizinanMahasiswa::findOrFail($id);
        } else {
            abort(404); // Type not recognized
        }

        // Return the view with the izin details
        return view('dashboard.perizinan.riwayat-perizinan.detail', compact('izin'));
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
