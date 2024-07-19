<?php

namespace App\Http\Controllers\Dashboard\Keuangan\TimKeuangan;

use App\Models\Spj;

use App\Models\Menu;
use App\Models\User;
use App\Models\SpjPd;
use App\Models\SpjTr;
use App\Models\TabelSpj;
use App\Models\TabelSpjTr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TabelSpjPd;
use Illuminate\Support\Facades\Auth;

class KonfirmasiSpjController extends Controller
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
        $spj = Spj::all();
        $spjTr = SpjTr::all();
        $spjPd = SpjPd::all();

        return view('dashboard.keuangan.tim-keuangan.konfirmasi-pengajuan-spj.index', [

            'menu' => $menu,
            'users' => $users,
            'spj' => $spj,
            'spjTr' => $spjTr,
            'spjPd' => $spjPd
        ]);
    }

    public function detail()
    {
        $menu = Menu::with('submenu')->get();
        $users = User::all();
        return view('dashboard.keuangan.tim-keuangan.konfirmasi-pengajuan-spj.detail', [
            'menu' => $menu,
            'users' => $users
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
        try {
            $spj = Spj::findOrFail((int)$id);
            $menu = Menu::with('submenu')->get();
            $tabelspj = TabelSpj::where('spj_id', $spj->id)->get();
            return view('dashboard.keuangan.tim-keuangan.konfirmasi-pengajuan-spj.detail', [
                'menu' => $menu,
                'spj' => $spj,
                'tabelspj'=> $tabelspj]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function showtr($id)
    {
        try {
            $spj = SpjTr::findOrFail((int)$id);
            $menu = Menu::with('submenu')->get();
            $tabelspj = TabelSpjTr::where('spj_id', $spj->id)->get();
            return view('dashboard.keuangan.tim-keuangan.konfirmasi-pengajuan-spj.detailtr', [
                'menu' => $menu,
                'spj' => $spj,
                'tabelspj'=> $tabelspj]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function showpd($id)
    {
        try {
            $spj = SpjPd::findOrFail((int)$id);
            $menu = Menu::with('submenu')->get();
            $tabelspj = TabelSpjPd::where('spj_id', $spj->id)->get();
            return view('dashboard.keuangan.tim-keuangan.konfirmasi-pengajuan-spj.detailpd', [
                'menu' => $menu,
                'spj' => $spj,
                'tabelspj'=> $tabelspj]);
        } catch (\Exception $e) {
            dd($e->getMessage());
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
