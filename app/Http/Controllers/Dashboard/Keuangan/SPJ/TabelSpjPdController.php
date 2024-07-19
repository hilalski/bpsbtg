<?php

namespace App\Http\Controllers\Dashboard\Keuangan\SPJ;

use App\Models\TabelSpjPd;
use App\Http\Requests\StoreTabelSpjPdRequest;
use App\Http\Requests\UpdateTabelSpjPdRequest;
use App\Imports\TabelSpjPdImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TabelSpjPdController extends Controller
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

    public function spjimportexcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ], [
            'file.required' => 'File harus diunggah.',
            'file.mimetypes' => 'File harus berupa dokumen Excel.',
        ]);
                
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataSPJPd', $namaFile);

        Excel::import(new TabelSpjPdImport(),
         public_path('/DataSPJPd/' . $namaFile));
        return redirect('dashboard/spj/info-pengajuan-spj')->with('successimport','Dokumen berhasil unggah, silakan tunggu konfirmasi');
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
     * @param  \App\Http\Requests\StoreTabelSpjPdRequest  $request
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
     * @param  \App\Models\TabelSpjPd  $tabelSpjPd
     * @return \Illuminate\Http\Response
     */
    public function show(TabelSpjPd $tabelSpjPd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TabelSpjPd  $tabelSpjPd
     * @return \Illuminate\Http\Response
     */
    public function edit(TabelSpjPd $tabelSpjPd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTabelSpjPdRequest  $request
     * @param  \App\Models\TabelSpjPd  $tabelSpjPd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabelSpjPd $tabelSpjPd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TabelSpjPd  $tabelSpjPd
     * @return \Illuminate\Http\Response
     */
    public function destroy(TabelSpjPd $tabelSpjPd)
    {
        //
    }
}
