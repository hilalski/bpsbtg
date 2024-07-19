<?php

namespace App\Http\Controllers\Dashboard\Keuangan\SPJ;

use App\Models\SpjPd;
use App\Http\Requests\StoreSpjPdRequest;
use App\Http\Requests\UpdateSpjPdRequest;
use App\Models\Menu;
use App\Models\User;
use App\Models\TabelSpjPd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;

class SpjPdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $menu = Menu::with('submenu')->get();
        $users = User::all();
        return view('dashboard.keuangan.spj-pd.add', [
            'menu' => $menu,
            'user' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $spj = SpjPd::create($data);

        return redirect('dashboard/spj/info-pengajuan-spj')->with('success','Pengajuan berhasil dibuat, silakan unggah dokumen');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpjPd  $spjPd
     * @return \Illuminate\Http\Response
     */
    public function show(SpjPd $spj)
    {
        //
        $menu = Menu::with('submenu')->get();
        $users = User::all();
        $tabelspj = TabelSpjPd::where('spj_id', $spj->id)->get();

        return view('dashboard.keuangan.spj.detail', [
            'menu' => $menu,
            'users' => $users,
            'spj' => $spj,
            'tabelspj' => $tabelspj
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpjPd  $spjPd
     * @return \Illuminate\Http\Response
     */
    public function edit(SpjPd $spjPd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpjPdRequest  $request
     * @param  \App\Models\SpjPd  $spjPd
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpjPdRequest $request, SpjPd $spjPd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpjPd  $spjPd
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpjPd $spjPd)
    {
        //
    }
}
