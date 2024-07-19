<?php

namespace App\Imports;

use App\Models\TabelSpj;
use App\Models\Spj;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class TabelSpjImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // Hentikan proses jika tidak ada data pada baris
        if (empty(array_filter($row))) {
            return null;
        }

        $spj_idFromForm = request('spj_id');

        $tabelSpj = new TabelSpj([
            'user_id' => auth()->id(),
            'spj_id' => $spj_idFromForm,
            'nama_dosen' => $row[1] ?? null,
            'golongan' => $row[2] ?? null,
            'rate_honor' => $row[3] ?? null,
            'sks_wajib' => $row[4] ?? null,
            'sks_hadir' => $row[5] ?? null,
            'sks_dibayar' => $row[6] ?? null,
            'jumlah_bruto' => $row[7] ?? null,
            'pajak' => $row[8] ?? null,
            'jumlah_diterima' => $row[9] ?? null,
            'nomor_rekening' => $row[10] ?? null,
            'nama_rekening' => $row[11] ?? null
        ]);

        // Hitung total dan isi atribut total pada model Spj
        $spj = Spj::find($spj_idFromForm);
        $spj->total += $tabelSpj->jumlah_diterima;
        $spj->total_bruto += $tabelSpj->jumlah_bruto;
        $spj->total_pajak += $tabelSpj->pajak;
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
