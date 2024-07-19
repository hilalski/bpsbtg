<?php

namespace App\Http\Controllers\Dashboard\UpdateStatus\PerbaruiStatus;

use App\Models\Izin;
use App\Models\Menu;
use App\Models\User;
use App\Http\Requests\StoreIzinRequest;
use App\Http\Requests\UpdateIzinRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
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
        $users = auth()->user();
        $izins = Izin::where('user_id', $users->id)
        ->latest()
        ->first(); 


        return view('dashboard.update-status.perbarui.index', [
            'menu' => $menu,
            'users' => $users,
            'izins' => $izins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {
        //
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['tanggal'] = $request->input('tanggal', null);
        $data['keperluan'] = $request->input('keperluan', null);
        $data['jam_keluar'] = $request->input('jam_keluar', null);
        
        // Membuat data izin
        $izin = Izin::create($data);
    
        $user = auth()->user();
        if ($user instanceof User) {
            $user->status = $data['keperluan']; 
    
            $user->save();
        } else {
            return redirect('update-status.riwayat.index')->with('error', 'User tidak valid');
        }
    
        return redirect()->route('update-status.riwayat.index')->with('success', 'Berhasil memperbarui status!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIzinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIzinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function show(Izin $izin)
    {
        //
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
     * @param  \App\Http\Requests\UpdateIzinRequest  $request
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIzinRequest $request, Izin $izin)
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
