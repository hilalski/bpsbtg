<?php

namespace App\Exports;

use App\Models\Izin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class IzinsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }
    public function collection()
    {
        return Izin::with('user')
            ->whereMonth('tanggal', $this->bulan)
            ->get()
            ->map(function ($izin) {
                return [
                    'tanggal' => Carbon::parse($izin->tanggal)->isoFormat('dddd, D MMMM YYYY'),
                    'pegawai' => $izin->user->name,
                    'keperluan' => $izin->keperluan,
                    'jam_keluar' => $izin->jam_keluar,
                    'jam_kembali' => $izin->jam_kembali,
                    'durasi' => $izin->durasi,
                    'keterangan' => $izin->keterangan,
                ];
            });

    }

    public function headings(): array
    {
        return [
            'Hari, Tanggal',
            'Pegawai',
            'Keperluan',
            'Jam Keluar',
            'Jam Kembali',
            'Durasi',
            'Keterangan'
        ];
    }
}
