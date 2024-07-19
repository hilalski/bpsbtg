<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_pengadaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokumen_id')->constrained()->onDelete('cascade');
            $table->string('dokumen_memo')->nullable();
            $table->string('dokumen_kak')->nullable();
            $table->string('dokumen_identifikasi_kebutuhan')->nullable();
            $table->string('dokumen_perencanaan_pengadaan')->nullable();
            $table->string('dokumen_hps')->nullable();
            $table->string('dokumen_nota_dinas')->nullable();
            $table->string('dokumen_undangan')->nullable();
            $table->string('dokumen_ssuk_sskk')->nullable();
            $table->string('dokumen_ikp')->nullable();
            $table->string('dokumen_ldp_dan_spesifikasi')->nullable();
            $table->string('dokumen_penawaran_pakta_formulir')->nullable();
            $table->string('dokumen_surat_permintaan')->nullable();
            $table->string('dokumen_pengadaan_langsung')->nullable();
            $table->string('dokumen_serah_terima')->nullable();
            $table->string('dokumen_bast')->nullable();
            $table->double('harga_anggaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_pengadaans');
    }
}
