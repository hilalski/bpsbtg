<?php

namespace App\Http\Controllers\Dashboard\Keuangan\SPJ;

use App\Models\TabelSpjTr;
use App\Imports\TabelSpjTrImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class TabelSpjTrController extends Controller
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
        $file->move('DataSPJTr', $namaFile);

        Excel::import(new TabelSpjTrImport(),
         public_path('/DataSPJTr/' . $namaFile));
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
     * @param  \App\Models\TabelSpjTr  $tabelSpjTr
     * @return \Illuminate\Http\Response
     */
    public function show(TabelSpjTr $tabelSpjTr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TabelSpjTr  $tabelSpjTr
     * @return \Illuminate\Http\Response
     */
    public function edit(TabelSpjTr $tabelSpjTr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
       * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TabelSpjTr  $tabelSpjTr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabelSpjTr $tabelSpjTr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TabelSpjTr  $tabelSpjTr
     * @return \Illuminate\Http\Response
     */
    public function destroy(TabelSpjTr $tabelSpjTr)
    {
        //
    }
}
