<?php

namespace App\Imports;

use App\Models\TabelSpjTr;
use App\Models\SpjTr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class TabelSpjTrImport implements ToModel, WithStartRow, WithCalculatedFormulas
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

        $tabelSpj = new TabelSpjTr([
            'user_id' => auth()->id(),
            'spj_id' => $spj_idFromForm,
            'nama' => $row[1] ?? null,
            'transpor_per_hari' => $row[2] ?? null,
            'jumlah_kegiatan' => $row[3] ?? null,
            'jumlah_yang_dibayarkan' => $row[4] ?? null,
            'bank' => $row[5] ?? null,
            'nomor_rekening' => $row[6] ?? null
        ]);

        // Hitung total dan isi atribut total pada model Spj
        $spj = SpjTr::find($spj_idFromForm);
        $spj->total_transpor_per_hari += $tabelSpj->transpor_per_hari;
        $spj->total_jumlah_kegiatan += $tabelSpj->jumlah_kegiatan;
        $spj->total_jumlah_yang_dibayarkan += $tabelSpj->jumlah_yang_dibayarkan;
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
