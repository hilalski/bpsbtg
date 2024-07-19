<?php

namespace App\Http\Controllers\Dashboard\SuratTugas;

use App\Models\Menu;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSuratTugas;
// use Illuminate\Support\Facades\Auth;

class DetailPengajuanSuratTugasController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('submenu')->get();
        $users = User::all();
        $detailPengajuanSuratTugas = PengajuanSuratTugas::where('user_id', auth()->user()->id)->select('id')->get();
        return view('dashboard.surat-tugas.detail', [
            'menu' => $menu,
            'users' => $users,
            'detailPengajuanSuratTugas' => $detailPengajuanSuratTugas,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Ambil detail surat tugas berdasarkan ID
        $detailSuratTugas = PengajuanSuratTugas::findOrFail($id);

        // Periksa apakah user yang sedang login memiliki hak akses ke surat tugas tersebut
        if (auth()->user()->id === $detailSuratTugas->user_id) {
            $menu = Menu::with('submenu')->get();
            $users = User::all();

            return view('dashboard.surat-tugas.detail', [
                'menu' => $menu,
                'users' => $users,
                'detailSuratTugas' => $detailSuratTugas,
            ]);
        } else {
            // Handle unauthorized access
            abort(403, 'Unauthorized access');
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
