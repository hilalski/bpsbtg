<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operatorMenuId = Menu::where('name', 'Operator')->first()->id;
        $unitMenuId = Menu::where('name', 'Unit')->first()->id;
        $pbjMenuId = Menu::where('name', 'PBJ')->first()->id;
        $ppkMenuId = Menu::where('name', 'PPK')->first()->id;
        $spjMenuId = Menu::where('name', 'SPJ')->first()->id;
        $skpMenuId = Menu::where('name', 'SKP')->first()->id;
        $tkuMenuId = Menu::where('name', 'Tim Keuangan')->first()->id;
        $surtugMenuId = Menu::where('name', 'Surat Tugas')->first()->id;
        $persetujuanSurtugMenuId = Menu::where('name', 'Persetujuan Surat Tugas')->first()->id;
        $updateStatusMenuId = Menu::where('name', 'Update Status')->first()->id;

        Submenu::insert([
            [
                'menu_id' => $operatorMenuId,
                'name' => 'Pegawai',
                'url' => Str::slug('Pegawai'),
                'icon' => 'bi bi-people-fill',
            ],
            [
                'menu_id' => $operatorMenuId,
                'name' => 'Pengecekan Surat Tugas',
                'url' => Str::slug('Pengecekan Surtug'),
                'icon' => 'bi bi-info-square-fill',
            ],
            [
                'menu_id' => $operatorMenuId,
                'name' => 'Update Gaji',
                'url' => Str::slug('Update Gaji'),
                'icon' => 'bi bi-cash-coin',
            ],
            [
                'menu_id' => $operatorMenuId,
                'name' => 'Cek Status Pegawai',
                'url' => Str::slug('Cek Status Pegawai'),
                'icon' => 'bi bi-check-circle-fill',
            ],
            [
                'menu_id' => $operatorMenuId,
                'name' => 'Riwayat Status Pegawai',
                'url' => Str::slug('Riwayat Status Pegawai'),
                'icon' => 'bi bi-bootstrap-reboot',
            ],
            [
                'menu_id' => $unitMenuId,
                'name' => 'Pengajuan',
                'url' => Str::slug('Pengajuan'),
                'icon' => 'bi bi-menu-button-wide-fill',
            ],
            [
                'menu_id' => $unitMenuId,
                'name' => 'Revisi & Penolakan',
                'url' => Str::slug('Revisi & Penolakan'),
                'icon' => 'bi bi-menu-button-wide-fill',
            ],
            [
                'menu_id' => $pbjMenuId,
                'name' => 'Updating Status',
                'url' => Str::slug('Updating Status'),
                'icon' => 'bi bi-menu-button-wide-fill',
            ],
            [
                'menu_id' => $ppkMenuId,
                'name' => 'Updating Status',
                'url' => Str::slug('Updating Status'),
                'icon' => 'bi bi-menu-button-wide-fill',
            ],
            [
                'menu_id' => $ppkMenuId,
                'name' => 'Revisi & Penolakan',
                'url' => Str::slug('Revisi & Penolakan'),
                'icon' => 'bi bi-menu-button-wide-fill',
            ],
            [
                'menu_id' => $spjMenuId,
                'name' => 'Pengajuan SPJ Honor Dosen',
                'url' => Str::slug('Pengajuan SPJ'),
                'icon' => 'bi bi-file-earmark-text-fill',
            ],
            [
                'menu_id' => $spjMenuId,
                'name' => 'Pengajuan SPJ Translok',
                'url' => Str::slug('Pengajuan Translok'),
                'icon' => 'bi bi-file-earmark-text-fill',
            ],
            [
                'menu_id' => $spjMenuId,
                'name' => 'Pengajuan SPJ Perjalanan Dinas',
                'url' => Str::slug('Pengajuan Perjalanan Dinas'),
                'icon' => 'bi bi-file-earmark-text-fill',
            ],
            [
                'menu_id' => $spjMenuId,
                'name' => 'Info Pengajuan SPJ',
                'url' => Str::slug('Info Pengajuan SPJ'),
                'icon' => 'bi bi-info-square-fill',
            ],
            [
                'menu_id' => $skpMenuId,
                'name' => 'Pengajuan SKP',
                'url' => Str::slug('Pengajuan SKP'),
                'icon' => 'bi bi-file-earmark-text-fill',
            ],
            [
                'menu_id' => $skpMenuId,
                'name' => 'Info Pengajuan SKP',
                'url' => Str::slug('Info Pengajuan SKP'),
                'icon' => 'bi bi-info-square-fill',
            ],
            [
                'menu_id' => $tkuMenuId,
                'name' => 'Konfirmasi SPJ',
                'url' => Str::slug('Konfirmasi SPJ'),
                'icon' => 'bi bi-menu-button-wide-fill',
            ],
            [
                'menu_id' => $tkuMenuId,
                'name' => 'Konfirmasi SKP',
                'url' => Str::slug('Konfirmasi SKP'),
                'icon' => 'bi bi-menu-button-wide-fill',
            ],
            [
                'menu_id' => $surtugMenuId,
                'name' => 'Pengajuan Surat Tugas',
                'url' => Str::slug('Pengajuan Surtug'),
                'icon' => 'bi bi-envelope-paper-fill',
            ],
            [
                'menu_id' => $surtugMenuId,
                'name' => 'Info Pengajuan Surat Tugas',
                'url' => Str::slug('Info Pengajuan Surtug'),
                'icon' => 'bi bi-info-square-fill',
            ],
            [
                'menu_id' => $persetujuanSurtugMenuId,
                'name' => 'Persetujuan Surat Tugas',
                'url' => Str::slug('Persetujuan Surtug'),
                'icon' => 'bi bi-info-square-fill',
            ],
            [
                'menu_id' => $updateStatusMenuId,
                'name' => 'Perbarui Status',
                'url' => Str::slug('Perbarui Status'),
                'icon' => 'bi bi-file-earmark-text-fill',
            ],
            [
                'menu_id' => $updateStatusMenuId,
                'name' => 'Riwayat Status',
                'url' => Str::slug('Riwayat Status'),
                'icon' => 'bi bi-bootstrap-reboot',
            ]
        ]);

    }
}
