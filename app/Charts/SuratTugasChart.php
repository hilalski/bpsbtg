<?php

namespace App\Charts;

use App\Models\PengajuanSuratTugas;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SuratTugasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $suratTugas = PengajuanSuratTugas::where('user_id', auth()->user()->id)->get();

        $data = [
            $suratTugas->where('status_surtug', 0)->count(),
            $suratTugas->where('status_surtug', 1)->count(),
            $suratTugas->where('status_surtug', 2)->count(),
        ];

        $label = [
            'Diajukan',
            'Disetujui',
            'Ditolak',
        ];

        // Mengonfigurasi dan membangun grafik donut
        $donutChart = $this->chart->donutChart()
            ->setTitle('')
            ->setSubtitle('');

        // Cek apakah ada data surat tugas
        if ($suratTugas->isEmpty()) {
            // Jika tidak ada data, tampilkan pesan alternatif
            $donutChart->addData([1]) // Menambahkan nilai fiktif agar donut tetap terlihat
                ->setColors(['#F0F8FF'])
                ->setSubtitle('Belum ada riwayat pengajuan surat tugas')
                ->setLabels(['']);
        } else {
            // Jika ada data, tambahkan data dan label sebagaimana biasa
            $donutChart->addData($data)
                ->setLabels($label);
        }

        return $donutChart;
    }
}
