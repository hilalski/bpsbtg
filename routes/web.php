<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Dashboard\Profil\ProfilController;

use App\Http\Controllers\Dashboard\Keuangan\SPJ\SPJController;
use App\Http\Controllers\Dashboard\Pengadaan\DokumenController;
use App\Http\Controllers\Dashboard\Keuangan\SPJ\SpjPdController;


use App\Http\Controllers\Dashboard\Keuangan\SPJ\SpjTrController;
use App\Http\Controllers\Dashboard\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Keuangan\SPJ\TabelSpjController;
use App\Http\Controllers\Dashboard\Keuangan\SPJ\TabelSpjPdController;
use App\Http\Controllers\Dashboard\Keuangan\SPJ\TabelSpjTrController;
use App\Http\Controllers\Dashboard\Pengadaan\Unit\PengajuanController;
use App\Http\Controllers\Dashboard\Keuangan\SKP\PengajuanSkpController;
use App\Http\Controllers\Dashboard\Keuangan\SPJ\PengajuanSpjController;
use App\Http\Controllers\Dashboard\Keuangan\SKP\InfoPengajuanSKPController;
use App\Http\Controllers\Dashboard\Keuangan\SPJ\InfoPengajuanSpjController;
use App\Http\Controllers\Dashboard\Pengadaan\Unit\DraftPengajuanController;
use App\Http\Controllers\Dashboard\Keuangan\TimKeuangan\DetailSpjController;
use App\Http\Controllers\Dashboard\Keuangan\SKP\DetailPengajuanSkpController;
use App\Http\Controllers\Dashboard\Keuangan\SPJ\DetailPengajuanSpjController;
use App\Http\Controllers\Dashboard\Pengadaan\PBJ\UpdatingStatusPBJController;
use App\Http\Controllers\Dashboard\Pengadaan\PPK\UpdatingStatusPPKController;
use App\Http\Controllers\Dashboard\Pengadaan\PPK\RevisiPenolakanPPKController;
use App\Http\Controllers\Dashboard\Keuangan\TimKeuangan\KonfirmasiSkpController;
use App\Http\Controllers\Dashboard\Keuangan\TimKeuangan\KonfirmasiSPjController;
use App\Http\Controllers\Dashboard\Pengadaan\Unit\RevisiPenolakanUnitController;
use App\Http\Controllers\Dashboard\SuratTugas\InfoPengajuanSuratTugasController;
use App\Http\Controllers\Dashboard\SuratTugas\PengajuanSuratTugasController;
use App\Http\Controllers\Dashboard\SuratTugas\DetailPengajuanSuratTugasController;
use App\Http\Controllers\Dashboard\SuratTugas\PersetujuanSuratTugas\PersetujuanSuratTugasController;
use App\Http\Controllers\Dashboard\SuratTugas\PersetujuanSuratTugas\DetailPersetujuanSuratTugasController;

use App\Http\Controllers\Dashboard\Operator\PegawaiController;
use App\Http\Controllers\Dashboard\Operator\CekController;
use App\Http\Controllers\Dashboard\Operator\PengecekanSuratTugasController;
use App\Http\Controllers\Dashboard\Operator\RiwayatAllController;
use App\Http\Controllers\Dashboard\Operator\UpdateGajiController;

use App\Http\Controllers\Dashboard\UpdateStatus\PerbaruiStatus\IzinController;
use App\Http\Controllers\Dashboard\UpdateStatus\PerbaruiStatus\RiwayatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'formatUserName'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home.index');
    // Profil
    Route::controller(ProfilController::class)->name('profil.')->group(function () {
        Route::get('/profil', 'edit')->name('edit');
        Route::put('/profil', 'update')->name('update');
        Route::delete('/profil', 'destroy')->name('destroy');
    });
    Route::get('/download-template/{filename}', [DokumenController::class, 'downloadTemplate'])->name('template.download');
    Route::post('/upload-dokumen', [DokumenController::class, 'uploadDokumen'])->name('upload.dokumen');

    // SPJ Honor Dosen
    Route::resource('/spj/pengajuan-spj', SpjController::class)->middleware('auth');
    Route::get('/spj/pengajuan-spj', [SpjController::class, 'create'])->name('spj.create');
    Route::resource('/spj/info-pengajuan-spj', InfoPengajuanSpjController::class)->middleware('auth');
    Route::get('/spj/info-pengajuan-spj/{spj}', [InfoPengajuanSpjController::class, 'show'])->name('info-pengajuan-spj.show');
    Route::get('/spjtemplatedownload', [InfoPengajuanSpjController::class, 'spjtemplatedownload'])->name('spjtemplatedownload');
    Route::get('/spj/info-pengajuan-spj/detail', [DetailPengajuanSpjController::class, 'index'])->name('spj.detail');
    Route::post('/importspjnew', [TabelSpjController::class, 'spjimportexcel'])->name('importspjnew')->middleware('auth');
    Route::post('/importspjnew', [TabelSpjController::class, 'spjimportexcel'])->name('importspjnew')->middleware('auth');
    Route::delete('/spj/info-pengajuan-spj/hapus-spj/{spj}', [SpjController::class, 'hapusSpj']);
    Route::delete('/spj/info-pengajuan-spj/hapus-unggahan/{spj}', [SpjController::class, 'hapusUnggahan']);

    // SPJ Translok
    Route::resource('/spj/pengajuan-translok', SpjTrController::class)->middleware('auth');
    Route::get('/spj/pengajuan-translok', [SpjTrController::class, 'create'])->name('spj-tr.create');
    Route::post('/spj/pengajuan-translok', [SpjTrController::class, 'store'])->name('spj-tr.store');
    Route::get('/spj/info-pengajuan-spjtr/{spj}', [InfoPengajuanSpjController::class, 'showtr'])->name('info-pengajuan-spjtr.show');
    Route::post('/importspjtrnew', [TabelSpjTrController::class, 'spjimportexcel'])->name('importspjtrnew')->middleware('auth');
    Route::get('/spjtrtemplatedownload', [InfoPengajuanSpjController::class, 'spjtrtemplatedownload'])->name('spjtrtemplatedownload');
    Route::delete('/spj/info-pengajuan-spjtr/hapus-spj/{spj}', [SpjController::class, 'hapusSpjTr']);
    Route::delete('/spj/info-pengajuan-spjtr/hapus-unggahan/{spj}', [SpjController::class, 'hapusUnggahanTr']);

    // SPJ Perjalanan Dinas
    Route::resource('/spj/pengajuan-perjalanan-dinas', SpjPdController::class)->middleware('auth');
    Route::get('/spj/pengajuan-perjalanan-dinas', [SpjPdController::class, 'create'])->name('spj-pd.create');
    Route::post('/spj/pengajuan-perjalanan-dinas', [SpjPdController::class, 'store'])->name('spj-pd.store');
    Route::get('/spj/info-pengajuan-spjpd/{spj}', [InfoPengajuanSpjController::class, 'showpd'])->name('info-pengajuan-spjpd.show');
    Route::post('/importspjpdnew', [TabelSpjPdController::class, 'spjimportexcel'])->name('importspjpdnew')->middleware('auth');
    Route::get('/spjpdtemplatedownload', [InfoPengajuanSpjController::class, 'spjpdtemplatedownload'])->name('spjpdtemplatedownload');
    Route::delete('/spj/info-pengajuan-spjpd/hapus-unggahan/{spj}', [SpjController::class, 'hapusUnggahanPd']);
    Route::delete('/spj/info-pengajuan-spjpd/hapus-spj/{spj}', [SpjController::class, 'hapusSpjPd']);

    // SKP
    Route::get('/skp/info-pengajuan-skp', [InfoPengajuanSKPController::class, 'index'])->name('skp.index');
    Route::get('/skp/pengajuan-skp', [PengajuanSkpController::class, 'create'])->name('skp.create');
    Route::get('/skp/info-pengajuan-skp/detail', [DetailPengajuanSkpController::class, 'index'])->name('skp.detail');

    // Surat Tugas
    Route::get('/surat-tugas/info-pengajuan-surtug', [InfoPengajuanSuratTugasController::class, 'index'])->name('infopengajuansurtug.index');
    Route::get('/surat-tugas/info-pengajuan-surtug/detail/{id}', [DetailPengajuanSuratTugasController::class, 'show'])->name('detailpengajuansurtug.detail');
    Route::get('/surat-tugas/pengajuan-surtug', [PengajuanSuratTugasController::class, 'create'])->name('infopengajuansurtug.create');
    Route::post('/surat-tugas/pengajuan-surtug', [PengajuanSuratTugasController::class, 'submitForm'])->name('pengajuan-surat-tugas.submit');

    // Status 
    Route::get('/update-status/perbarui-status', [IzinController::class, 'index'])->name('update-status.perbarui.index');
    Route::post('/update-status/perbarui-status', [IzinController::class, 'create'])->name('update-status.perbarui.create');

    Route::get('/update-status/riwayat-status', [RiwayatController::class, 'index'])->name('update-status.riwayat.index');
    Route::get('/update-status/riwayat-status/{izins}', [RiwayatController::class, 'show'])->name('update-status.riwayat.show');
    Route::post('dashboard/update-status/riwayat-status/edit/{izins}', [RiwayatController::class, 'edit'])->name('update-status.riwayat.edit');
});

// Tim Keuangan
Route::middleware(['can:tim keuangan', 'formatUserName'])->prefix('dashboard')->group(function () {
    Route::get('/tim-keuangan/konfirmasi-spj', [KonfirmasiSPjController::class, 'index'])->name('konfirmasipengajuanspj.index');
    Route::get('/tim-keuangan/konfirmasi-spj/detail-spj', [KonfirmasiSPjController::class, 'detail'])->name('konfirmasipengajuanspj.detail');
    Route::get('/tim-keuangan/konfirmasi-spj/{spj}', [KonfirmasiSPjController::class, 'show'])->name('konfirmasi-spj.show');
    Route::post('/tim-keuangan/konfirmasi-spj/setujui-spj/{spj}', [DetailSpjController::class, 'changeStatusSetuju']);
    Route::post('/tim-keuangan/konfirmasi-spj/tolak-spj/{spj}', [DetailSpjController::class, 'changeStatusTolak']);
    Route::post('/tim-keuangan/konfirmasi-spj/transfer-spj/{spj}', [DetailSpjController::class, 'konfirmasiTransferSpj']);
    Route::get('/tim-keuangan/konfirmasi-spj/download-spj-pdf/{spj}', [DetailSpjController::class, 'donwloadPdfSpj']);

    Route::get('/tim-keuangan/konfirmasi-spjtr/{spj}', [KonfirmasiSPjController::class, 'showtr'])->name('konfirmasi-spjtr.show');
    Route::post('/tim-keuangan/konfirmasi-spjtr/setujui-spj/{spj}', [DetailSpjController::class, 'changeStatusSetujuTr']);
    Route::post('/tim-keuangan/konfirmasi-spjtr/tolak-spj/{spj}', [DetailSpjController::class, 'changeStatusTolakTr']);
    Route::post('/tim-keuangan/konfirmasi-spjtr/transfer-spj/{spj}', [DetailSpjController::class, 'konfirmasiTransferSpjTr']);
    Route::get('/tim-keuangan/konfirmasi-spjtr/download-spj-pdf/{spj}', [DetailSpjController::class, 'donwloadPdfSpjTr']);

    Route::get('/tim-keuangan/konfirmasi-spjpd/{spj}', [KonfirmasiSPjController::class, 'showpd'])->name('konfirmasi-spjpd.show');
    Route::post('/tim-keuangan/konfirmasi-spjpd/setujui-spj/{spj}', [DetailSpjController::class, 'changeStatusSetujuPd']);
    Route::post('/tim-keuangan/konfirmasi-spjpd/tolak-spj/{spj}', [DetailSpjController::class, 'changeStatusTolakPd']);
    Route::post('/tim-keuangan/konfirmasi-spjpd/transfer-spj/{spj}', [DetailSpjController::class, 'konfirmasiTransferSpjPd']);
    Route::get('/tim-keuangan/konfirmasi-spjpd/download-spj-pdf/{spj}', [DetailSpjController::class, 'donwloadPdfSpjPd']);

    Route::get('/tim-keuangan/konfirmasi-skp', [KonfirmasiSKpController::class, 'index'])->name('konfirmasipengajuanskp.index');
    Route::get('/tim-keuangan/konfirmasi-skp/detail-skp', [KonfirmasiSKpController::class, 'detail'])->name('konfirmasipengajuanskp.detail');
});


// Unit
Route::middleware(['formatUserName'])->prefix('dashboard/unit')->name('unit.')->group(function () {
    Route::controller(PengajuanController::class)->group(function () {
        Route::get('/pengajuan', 'index')->name('pengajuan.index');
        Route::get('/pengajuan/detail/{id}', 'details')->name('pengajuan.details');
        Route::get('/pengajuan/tambah-pengajuan', 'create')->name('pengajuan.add');
        Route::post('/pengajuan/kirim-form', 'kirimForm')->name('pengajuan.kirim-form');
        Route::get('/revisi-penolakan', [RevisiPenolakanUnitController::class, 'index'])->name('revisi-penolakanunit.index');

        // Unit -> download template
        Route::get('/download-template/{filename}', 'downloadTemplate')->name('template.download');
        Route::get('/download-template/{filename}', [DokumenController::class, 'downloadTemplate'])->name('template.download');
    });
});

Route::middleware(['can:pbj', 'formatUserName'])->group(function () {
    // PBJ
    Route::get('/dashboard/pbj/updating-status', [UpdatingStatusPBJController::class, 'index'])->name('updatingstatuspbj.index');
    Route::get('/dashboard/pbj/updating-status/detail/{id}', [UpdatingStatusPBJController::class, 'details'])->name('updatingstatuspbj.details');
    Route::get('/dashboard/pbj/updating-status/download/{nama_dokumen}/{id}', [UpdatingStatusPBJController::class, 'download'])->name('updatingstatuspbj.download');
    Route::get('/download-template/{filename}', [DokumenCOntroller::class, 'downloadTemplate'])->name('template.download');
    Route::post('/upload-dokumens', [UpdatingStatusPBJController::class, 'upload'])->name('upload-dokumens');
    Route::get('/download/{dokumenId}/{documentName}', [UpdatingStatusPBJController::class, 'downloadFile'])->name('downloadFile');
    Route::post('/update-status', [UpdatingStatusPBJController::class, 'updateStatus'])->name('updateStatus');
});

Route::middleware(['can:ppk', 'formatUserName'])->prefix('dashboard')->group(function () {
    // PPK
    Route::get('/ppk/updating-status', [UpdatingStatusPPKController::class, 'index'])->name('updatingstatusppk.index');
    Route::get('/ppk/revisi-penolakan', [RevisiPenolakanPPKController::class, 'index'])->name('revisi-penolakanppk.index');
    Route::get('/ppk/updating-status/detail/{id}', [UpdatingStatusPPKController::class, 'details'])->name('updatingstatusppk.details');
    Route::get('/download-template/{filename}', [DokumenController::class, 'downloadTemplate'])->name('template.download');
    Route::post('/update-status/{pengadaan}/{penyelenggara}', [UpdatingStatusPPKController::class, 'updateStatus'])->name('update-status');
    Route::post('/update-status/penolakan', [UpdatingStatusPPKController::class, 'tolak'])->name('tolak');
    Route::post('/upload-dokumens', [UpdatingStatusPBJController::class, 'upload'])->name('upload.dokumens');
    Route::get('/download/{dokumenId}/{documentName}', [UpdatingStatusPBJController::class, 'downloadFile'])->name('downloadFile');
});

// Pimpinan (Surat Tugas)
Route::middleware(['can:pimpinan', 'formatUserName'])->prefix('dashboard')->group(function () {
    // Persetujuan Surat Tugas
    Route::get('/persetujuan-surat-tugas/persetujuan-surtug', [PersetujuanSuratTugasController::class, 'index'])->name('persetujuansurtug.index');
    Route::get('/persetujuan-surat-tugas/persetujuan-surtug/detail/{id}', [DetailPersetujuanSuratTugasController::class, 'show'])->name('detailpersetujuansurtug.detail');
    Route::get('/persetujuan-surat-tugas/persetujuan-surtug/detail/setujui/{id}', [PersetujuanSuratTugasController::class, 'setujuiAction'])->name('setujuiAction');
    Route::get('/persetujuan-surat-tugas/persetujuan-surtug/detail/tolak/{id}', [PersetujuanSuratTugasController::class, 'tolakAction'])->name('tolakAction');
});

// Operator (Surat Tugas)
Route::middleware(['can:operator', 'formatUserName'])->prefix('dashboard')->group(function () {
    // Operator
        // Pegawai
    Route::get('/operator/pegawai', [PegawaiController::class, 'index'])->name('operator.pegawai.index');
    Route::get('/operator/pegawai/tambah-pegawai', [PegawaiController::class, 'create'])->name('operator.pegawai.add');
    Route::post('/operator/pegawai/tambah-pegawai', [PegawaiController::class, 'store'])->name('operator.pegawai.store');
    Route::get('/operator/cek-status-pegawai', [CekController::class, 'index'])->name('operator.cek.index');
    Route::get('/operator/riwayat-status-pegawai', [RiwayatAllController::class, 'index'])->name('operator.riwayat.index');
    Route::get('/operator/riwayat-status-pegawai/{izins}', [RiwayatAllController::class, 'show'])->name('operator.riwayat.show');
    Route::get('export-izins', [RiwayatAllController::class, 'export'])->name('izins.export');

        // Pengecekan Surat Tugas dan Update Gaji
    Route::get('/operator/pengecekan-surtug', [PengecekanSuratTugasController::class, 'index'])->name('pengecekansurtug.index');
    Route::get('/operator/pengecekan-surtug/cek/{id}', [PengecekanSuratTugasController::class, 'editForm'])->name('pengecekansurtug.cek');
    Route::put('/operator/pengecekan-surtug/{id}', [PengecekanSuratTugasController::class, 'updateForm'])->name('pengecekansurtug.update');
    Route::get('/operator/pengecekan-surtug/cek/{id}', [PengecekanSuratTugasController::class, 'tampil'])->name('pengecekansurtug.cek');
    Route::get('/operator/pengecekan-surtug/{id}', [PengecekanSuratTugasController::class, 'selesaiAction'])->name('surtug.selesai');
    Route::get('/operator/update-gaji', [UpdateGajiController::class, 'index'])->name('updategaji.index');
    Route::get('/operator/update-gaji/edit/{id}', [UpdateGajiController::class, 'edit'])->name('updategaji.edit');
    Route::get('/operator/update-gaji/form/{id}', [UpdateGajiController::class, 'form'])->name('updategaji.form');
    Route::put('/operator/update-gaji/update/{id}', [UpdateGajiController::class, 'update'])->name('updategaji.update');

    // Download Surat Tugas
    // Route::get('/download-surat-tugas-pdf', [PengecekanSuratTugasController::class, 'downloadpdf'])->name('surtug.download');
    Route::get('/download-surat-tugas-pdf/{id}', [PengecekanSuratTugasController::class, 'downloadpdf'])->name('surtug.download');
});

require __DIR__ . '/auth.php';
