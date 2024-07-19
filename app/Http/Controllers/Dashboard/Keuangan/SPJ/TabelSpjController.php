<?php

namespace App\Http\Controllers\Dashboard\Keuangan\SPJ;

use App\Models\TabelSpj;
use App\Imports\TabelSpjImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TabelSpjController extends Controller
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
        $file->move('DataSPJ', $namaFile);

        Excel::import(new TabelSpjImport(),
         public_path('/DataSPJ/' . $namaFile));
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
     * @param  \App\Models\TabelSpj  $tabelSpj
     * @return \Illuminate\Http\Response
     */
    public function show(TabelSpj $tabelSpj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TabelSpj  $tabelSpj
     * @return \Illuminate\Http\Response
     */
    public function edit(TabelSpj $tabelSpj)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TabelSpj  $tabelSpj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabelSpj $tabelSpj)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TabelSpj  $tabelSpj
     * @return \Illuminate\Http\Response
     */
    public function destroy(TabelSpj $tabelSpj)
    {
        //
    }
}
