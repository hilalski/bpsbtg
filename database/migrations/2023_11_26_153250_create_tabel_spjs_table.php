<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelSpjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_spjs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('spj_id');
            $table->foreign('spj_id')->references('id')->on('spjs')->onDelete('cascade');
            $table->string('nama_dosen');
            $table->string('golongan');
            $table->bigInteger('rate_honor');
            $table->integer('sks_wajib');
            $table->integer('sks_hadir');
            $table->integer('sks_dibayar');
            $table->bigInteger('jumlah_bruto');
            $table->bigInteger('pajak');
            $table->bigInteger('jumlah_diterima');
            $table->string('nomor_rekening');
            $table->string('nama_rekening')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_spjs');
    }
}
