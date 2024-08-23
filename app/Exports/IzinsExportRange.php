<?php

namespace App\Exports;

use App\Models\Izin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class IzinsExportRange implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $tanggalAwal;
    protected $tanggalAkhir;

    public function __construct($tanggalAwal, $tanggalAkhir)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
    }
    public function collection()
    {
        return Izin::with('user')
            ->whereBetween('tanggal', [$this->tanggalAwal, $this->tanggalAkhir])
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
