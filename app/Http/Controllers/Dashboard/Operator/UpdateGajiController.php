<?php

namespace App\Http\Controllers\Dashboard\Operator;

use App\Models\Menu;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSuratTugas;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;
// use Barryvdh\DomPDF\PDF;


// use Config\app;
// use PDF;

class UpdateGajiController  extends Controller
{
public function index()
{
    $menu = Menu::with('submenu')->get();
    $users = User::all();
        return view('dashboard.operator.pengecekan-surat-tugas.index-gaji', [
            'menu' => $menu,
            'users' => $users,
        ]);
}

public function edit($id)
{
    $menu = Menu::with('submenu')->get();
    $user = User::find($id); // Ganti dengan model user yang sesuai
    return view('dashboard.operator.pengecekan-surat-tugas.update-gaji', [
        'menu' => $menu,
        'user' => $user, // Ubah $users menjadi $user
    ]);
}

public function form($id)
{
        $menu = Menu::with('submenu')->get();
        $user = User::find($id);
        return view('dashboard.operator.pengecekan-surat-tugas.update-gaji', [
            'menu' => $menu,
            'user' => $user,
        ]);
}

public function update(ProfileUpdateRequest $request, $id)
{
    $user = User::find($id);
    $user->fill($request->validated());

    // Logika update lainnya...

    $user->gaji = $request->input('gaji', 0); // Set gaji dari input

    $user->save();

    // return redirect()->route('updategaji.index');
    return back()->with('success', 'Data gaji berhasil diperbarui');
}
}
