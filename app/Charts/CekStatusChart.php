<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CekStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $cekStatus = User::all();

        $data = [
            $cekStatus->where('status', 'Di Kantor')->count(),
            $cekStatus->where('status', 'Dinas')->count(),
            $cekStatus->where('status', 'Non Dinas')->count(),
            $cekStatus->where('status', 'Istirahat')->count(),
        ];

        $label = [
            'Di Kantor',
            'Dinas',
            'Non Dinas',
            'Istirahat'
        ];

        $colors = [
            '#008000',
            '#56C2FF',
            '#FFA500',
            '#FF0000',

        ];

        // Mengonfigurasi dan membangun grafik donut
        $donutChart = $this->chart->donutChart()
            ->setTitle('')
            ->setSubtitle('')
            ->setColors($colors);

        // Cek apakah ada data surat tugas
        if ($cekStatus->isEmpty()) {
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
