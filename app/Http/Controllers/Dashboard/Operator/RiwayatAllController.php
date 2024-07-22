<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Models\Izin;
use App\Models\Menu;
use App\Models\User;
use App\Exports\IzinsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class RiwayatAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menu = Menu::with('submenu')->get();
        $users = User::all();
        $izins = Izin::orderBy('updated_at', 'desc')->get();
    
        return view('dashboard.operator.riwayat.index', [
            'menu' => $menu,
            'users' => $users,
            'izins' => $izins
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
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $izin = Izin::find($id);
            $menu = Menu::with('submenu')->get();
            $users = User::all();
            return view('dashboard.operator.riwayat.detail', [
                'menu' => $menu,
                'users' => $users,
                'izin' => $izin
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function export(Request $request) 
    {
        $bulan = $request->input('bulan');
        Carbon::setLocale('id');
        $bulanNama = Carbon::createFromFormat('m', $bulan)->translatedFormat('F');
        $fileName = 'Rekap Status Pegawai - ' . $bulanNama . '.xlsx';

        return Excel::download(new IzinsExport($bulan), $fileName);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function edit(Izin $izin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Izin $izin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Izin $izin)
    {
        //
    }
}
