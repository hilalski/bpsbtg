<?php

namespace App\Http\Controllers\Dashboard\Keuangan\TimKeuangan;

use App\Models\Spj;

use App\Models\Menu;
use App\Models\User;
use App\Models\SpjPd;
use App\Models\SpjTr;
use App\Models\TabelSpj;
use Barryvdh\DomPDF\PDF;
use App\Models\TabelSpjPd;
use App\Models\TabelSpjTr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailSpjController extends Controller
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

    public function changeStatusSetuju(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pencairan Dana,Ditolak',
        ]);
    
        $spj = Spj::findOrFail($id);

        $spj->status = $request->status;
        $spj->save();
    
        return redirect()->back()->with('success', 'SPJ berhasil disetujui.');
    }

    public function changeStatusSetujuTr(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pencairan Dana,Ditolak',
        ]);
    
        $spj = SpjTr::findOrFail($id);

        $spj->status = $request->status;
        $spj->save();
    
        return redirect()->back()->with('success', 'SPJ berhasil disetujui.');
    }

    public function changeStatusSetujuPd(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pencairan Dana,Ditolak',
        ]);
    
        $spj = SpjPd::findOrFail($id);

        $spj->status = $request->status;
        $spj->save();
    
        return redirect()->back()->with('success', 'SPJ berhasil disetujui.');
    }

    public function changeStatusTolak(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Ditolak',
            'keterangan' => 'required'
        ]);
    
        $spj = Spj::findOrFail($id);

        $spj->status = $request->status;
        $spj->keterangan = $request->keterangan;
        $spj->save();
    
        return redirect()->back()->with('success', 'SPJ berhasil ditolak.');
    }

    public function changeStatusTolakTr(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Ditolak',
            'keterangan' => 'required'
        ]);
    
        $spj = SpjTr::findOrFail($id);

        $spj->status = $request->status;
        $spj->keterangan = $request->keterangan;
        $spj->save();
    
        return redirect()->back()->with('success', 'SPJ berhasil ditolak.');
    }

    public function changeStatusTolakPd(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Ditolak',
            'keterangan' => 'required'
        ]);
    
        $spj = SpjPd::findOrFail($id);

        $spj->status = $request->status;
        $spj->keterangan = $request->keterangan;
        $spj->save();
    
        return redirect()->back()->with('success', 'SPJ berhasil ditolak.');
    }

    public function konfirmasiTransferSpj(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Selesai',
            'tanggal_transfer' => 'required'
        ]);
    
        $spj = Spj::findOrFail($id);

        $spj->status = $request->status;
        $spj->tanggal_transfer = $request->tanggal_transfer;
        $spj->save();
    
        return redirect()->back()->with('success', 'Berhasil mengonformasi tanggal Pencairan Dana.');
    }

    public function konfirmasiTransferSpjTr(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Selesai',
            'tanggal_transfer' => 'required'
        ]);
    
        $spj = SpjTr::findOrFail($id);

        $spj->status = $request->status;
        $spj->tanggal_transfer = $request->tanggal_transfer;
        $spj->save();
    
        return redirect()->back()->with('success', 'Berhasil mengonformasi tanggal Pencairan Dana.');
    }

    public function konfirmasiTransferSpjPd(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Selesai',
            'tanggal_transfer' => 'required'
        ]);
    
        $spj = SpjPd::findOrFail($id);

        $spj->status = $request->status;
        $spj->tanggal_transfer = $request->tanggal_transfer;
        $spj->save();
    
        return redirect()->back()->with('success', 'Berhasil mengonformasi tanggal Pencairan Dana.');
    }

    public function donwloadPdfSpj($spj)
{
    $spjPdf = Spj::findOrFail($spj);
    $tabelspj = TabelSpj::where('spj_id', $spjPdf->id)->get();

    $pdf = app('dompdf.wrapper');
    $pdf->loadView('dashboard/keuangan/tim-keuangan/konfirmasi-pengajuan-spj/spj-pdf', compact('spjPdf', 'tabelspj'));
    $pdf->setPaper('A4', 'portrait');
    
    //dd($pdf->output());
    return $pdf->stream('spj.pdf');
}

public function donwloadPdfSpjTr($spj)
{
    $spjPdf = SpjTr::findOrFail($spj);
    $tabelspj = TabelSpjTr::where('spj_id', $spjPdf->id)->get();

    $pdf = app('dompdf.wrapper');
    $pdf->loadView('dashboard/keuangan/tim-keuangan/konfirmasi-pengajuan-spj/spjtr-pdf', compact('spjPdf', 'tabelspj'));
    $pdf->setPaper('A4', 'portrait');
    
    //dd($pdf->output());
    return $pdf->stream('spj.pdf');
}

public function donwloadPdfSpjPd($spj)
{
    $spjPdf = SpjPd::findOrFail($spj);
    $tabelspj = TabelSpjPd::where('spj_id', $spjPdf->id)->get();

    $pdf = app('dompdf.wrapper');
    $pdf->loadView('dashboard/keuangan/tim-keuangan/konfirmasi-pengajuan-spj/spjpd-pdf', compact('spjPdf', 'tabelspj'));
    $pdf->setPaper('A4', 'landscape');
    
    //dd($pdf->output());
    return $pdf->stream('spj.pdf');
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
    public function show(Spj $spj)
    {
        //
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
