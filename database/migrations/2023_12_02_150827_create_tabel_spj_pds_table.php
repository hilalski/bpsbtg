<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelSpjPdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_spj_pds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('spj_id');
            $table->foreign('spj_id')->references('id')->on('spj_pds')->onDelete('cascade');
            $table->string('nama_pelaksanaan_perjalanan_dinas');
            $table->string('gol');
            $table->string('asal_penugasan');
            $table->string('daerah_tujuan_perjalanan_dinas');
            $table->integer('lama_perjalanan');
            $table->bigInteger('uang_harian');
            $table->bigInteger('transport');
            $table->bigInteger('bandara');
            $table->bigInteger('biaya_hotel');
            $table->bigInteger('jumlah_biaya');
            $table->bigInteger('uang_muka');
            $table->bigInteger('kekurangan');
            $table->string('nama_bank');
            $table->string('nomor_rekening');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_spj_pds');
    }
}
