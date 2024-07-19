<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Subsubmenu;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SubsubmenuSeeder extends Seeder
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
        $skpMenuId = Menu::where('name', 'SKP')->first()->id;
        $tkuMenuId = Menu::where('name', 'Tim Keuangan')->first()->id;

        $pegawaiOperatorSubmenuId = Submenu::where('name', 'Pegawai')
        ->where('menu_id', $operatorMenuId)
        ->first()->id;
        $updateGajiOperatorSubmenuId = Submenu::where('name', 'Update Gaji')
        ->where('menu_id', $operatorMenuId)
        ->first()->id;
        $pengajuanUnitSubmenuId = Submenu::where('name', 'Pengajuan')
        ->where('menu_id', $unitMenuId)
        ->first()->id;
        $pengajuanPBJSubmenuId = Submenu::where('name', 'Updating Status')
        ->where('menu_id', $pbjMenuId)
        ->first()->id;
        $pengajuanPPKSubmenuId = Submenu::where('name', 'Updating Status')
        ->where('menu_id', $ppkMenuId)
        ->first()->id;

        $infoPengajuanSKPSubmenuId = Submenu::where('name', 'Info Pengajuan SKP')
        ->where('menu_id', $skpMenuId)
        ->first()->id;
        $konfirmasiSKPSubmenuId = Submenu::where('name', 'Konfirmasi SKP')
        ->where('menu_id', $tkuMenuId)
        ->first()->id;

        
        Subsubmenu::insert([
            [
                'submenu_id' => $pegawaiOperatorSubmenuId,
                'name' => 'Tambah Pegawai',
                'url' => Str::slug('Tambah Pegawai'),
            ],
            [
                'submenu_id' => $updateGajiOperatorSubmenuId,
                'name' => 'Edit',
                'url' => Str::slug('Edit'),
            ],
            [
                'submenu_id' => $pengajuanUnitSubmenuId,
                'name' => 'Tambah Pengajuan',
                'url' => Str::slug('Tambah Pengajuan'),
            ],
            [
                'submenu_id' => $pengajuanUnitSubmenuId,
                'name' => 'Detail',
                'url' => Str::slug('Detail'),
            ],
            [
                'submenu_id' => $pengajuanPBJSubmenuId,
                'name' => 'Detail',
                'url' => Str::slug('Detail'),
            ],
            [
                'submenu_id' => $pengajuanPPKSubmenuId,
                'name' => 'Detail',
                'url' => Str::slug('Detail'),
            ],
            [
                'submenu_id' => $infoPengajuanSKPSubmenuId,
                'name' => 'Detail',
                'url' => Str::slug('Detail'),
            ],
            [
                'submenu_id' => $konfirmasiSKPSubmenuId,
                'name' => 'Detail SKP',
                'url' => Str::slug('Detail SKP'),
            ]
        ]);
           
    }
}
