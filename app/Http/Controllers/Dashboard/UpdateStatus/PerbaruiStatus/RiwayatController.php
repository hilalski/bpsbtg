<?php

namespace App\Http\Controllers\Dashboard\UpdateStatus\PerbaruiStatus;

use App\Models\Izin;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
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
    $izins = Izin::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
    
        return view('dashboard.update-status.riwayat.index', [
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
            $izins = Izin::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $menu = Menu::with('submenu')->get();
            return view('dashboard.update-status.riwayat.detail', [
                'menu' => $menu,
                'izins' => $izins
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
{
    $data1 = $request->all();

    $izins = Izin::findOrFail($id);
    $jam_keluar = $izins->jam_keluar;
    $jam_kembali = $request->input('jam_kembali');
    
    if (!$jam_kembali) {
        $currentTime = \Carbon\Carbon::now();
        $createdAt = $izins->created_at;
        $createdDate = $createdAt->toDateString();
        $currentDate = $currentTime->toDateString();
        
        if ($currentDate !== $createdDate) {
            // If the current date is different from the creation date
            $jam_kembali = '16:00:00';
        } else {
            // If the current date is the same as the creation date
            if ($currentTime->hour >= 16) {
                $jam_kembali = '16:00:00';
            } else {
                $jam_kembali = $currentTime->format('H:i:s');
            }
        }
    }
    $izins->jam_kembali = $jam_kembali;

    if ($jam_keluar && $jam_kembali) {
        $keluar = \Carbon\Carbon::createFromFormat('H:i:s', $jam_keluar);
        $kembali = \Carbon\Carbon::createFromFormat('H:i:s', $jam_kembali);
        $duration = $keluar->diff($kembali)->format('%H:%I:%S');
        $izins->durasi = $duration;
    }

    $izins->save();

    $user = auth()->user();
    if ($user instanceof User) {
        $user->status = $data1['status'];
        $user->save();
    } else {
        return redirect()->route('update-status.riwayat.index')->with('error', 'User tidak valid');
    }

    return redirect()->route('update-status.riwayat.index')->with('success', 'Berhasil memperbarui status!');
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
