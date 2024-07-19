<?php

namespace App\Http\Controllers\Dashboard\Keuangan\SPJ;

use App\Models\Spj;
use App\Models\Menu;
use App\Models\User;
use App\Models\SpjPd;
use App\Models\SpjTr;
use App\Models\TabelSpj;
use App\Models\TabelSpjPd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TabelSpjTr;
use Illuminate\Support\Facades\Auth;

class InfoPengajuanSpjController extends Controller
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
    
    $spj = Spj::where('user_id', Auth::id())->get();
    $spjTr = SpjTr::where('user_id', Auth::id())->get();
    $spjPd = SpjPd::where('user_id', Auth::id())->get();

    // Gabungkan ketiga koleksi menjadi satu koleksi
    // $allSpj = $spj->merge($spjTr)->merge($spjPd);

    return view('dashboard.keuangan.spj.index', [
        'menu' => $menu,
        'users' => $users,
        'spj' => $spj,
        'spjTr' => $spjTr,
        'spjPd' => $spjPd
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
     * @param  \App\Models\Spj  $spj
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $spj = Spj::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $menu = Menu::with('submenu')->get();
            $tabelspj = TabelSpj::where('spj_id', $spj->id)->get();
            return view('dashboard.keuangan.spj.detail', [
                'menu' => $menu,
                'spj' => $spj,
                'tabelspj'=> $tabelspj
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function showtr($id)
    {
        try {
            $spj = SpjTr::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $menu = Menu::with('submenu')->get();
            $tabelspj = TabelSpjTr::where('spj_id', $spj->id)->get();
            return view('dashboard.keuangan.spj-tr.detail', [
                'menu' => $menu,
                'spj' => $spj,
                'tabelspj'=> $tabelspj
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function showpd($id)
    {
        try {
            $spj = SpjPd::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $menu = Menu::with('submenu')->get();
            $tabelspj = TabelSpjPd::where('spj_id', $spj->id)->get();
            return view('dashboard.keuangan.spj-pd.detail', [
                'menu' => $menu,
                'spj' => $spj,
                'tabelspj'=> $tabelspj
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function spjtemplatedownload()
    {
        $path = public_path('download\template-spj honor dosen.xlsx');
        $fileName = 'template-spj honor dosen.xlsx';

        return response()->download($path, $fileName, ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }

    public function spjtrtemplatedownload()
    {
        $path = public_path('download\template-spj translok.xlsx');
        $fileName = 'template-spj translok.xlsx';

        return response()->download($path, $fileName, ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }
    
    public function spjpdtemplatedownload()
    {
        $path = public_path('download\template-spj perjalanan dinas.xlsx');
        $fileName = 'template-spj perjalanan dinas.xlsx';

        return response()->download($path, $fileName, ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spj  $spj
     * @return \Illuminate\Http\Response
     */
    public function edit(Spj $spj)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spj  $spj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spj $spj)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spj  $spj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spj $spj)
    {
        //
    }
}
