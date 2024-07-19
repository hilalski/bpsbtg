<?php

namespace App\Imports;

use App\Models\TabelSpjPd;
use App\Models\SpjPd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class TabelSpjPdImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty(array_filter($row))) {
            return null;
        }
    
        $spj_idFromForm = request('spj_id');
    
        $tabelSpj = new TabelSpjPd([
            'user_id' => auth()->id(),
            'spj_id' => $spj_idFromForm,
            'nama_pelaksanaan_perjalanan_dinas' => $row[1] ?? null,
            'gol' => $row[2] ?? null,
            'asal_penugasan' => $row[3] ?? null,
            'daerah_tujuan_perjalanan_dinas' => $row[4] ?? null,
            'lama_perjalanan' => $row[5] ?? null,
            'uang_harian' => $row[6] ?? null,
            'transport' => $row[7] ?? null,
            'bandara' => $row[8] ?? null,
            'biaya_hotel' => $row[9] ?? null,
            'jumlah_biaya' => $row[10] ?? null,
            'uang_muka' => $row[11] ?? null,
            'kekurangan' => $row[12] ?? null,
            'nama_bank' => $row[13] ?? null,
            'nomor_rekening' => $row[14] ?? null
        ]);

        // Hitung total dan isi atribut total pada model Spj
        $spj = SpjPd::find($spj_idFromForm);
        $spj->total_uang_harian += $tabelSpj->uang_harian;
        $spj->total_transport += $tabelSpj->transport;
        $spj->total_bandara += $tabelSpj->bandara;
        $spj->total_biaya_hotel += $tabelSpj->biaya_hotel;
        $spj->total_jumlah_biaya += $tabelSpj->jumlah_biaya;
        $spj->total_uang_muka += $tabelSpj->uang_muka;
        $spj->total_kekurangan += $tabelSpj->kekurangan;
        $spj->save();
        // dd($spj->total);

        return $tabelSpj;
    }

    public function startRow(): int
    {
        // Specify the starting row (e.g., row 3)
        return 3;
    }
}   