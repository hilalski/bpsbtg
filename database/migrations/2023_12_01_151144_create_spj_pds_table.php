<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpjPdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spj_pds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('judul');
            $table->string('program');
            $table->string('kegiatan');
            $table->string('kro');
            $table->string('komponen');
            $table->string('akun');
            $table->string('jenis_spj');
            $table->string('bendahara');
            $table->string('ppk');
            $table->date('tanggal_tugas');
            $table->bigInteger('total_uang_harian')->nullable();
            $table->bigInteger('total_transport')->nullable();
            $table->bigInteger('total_bandara')->nullable();
            $table->bigInteger('total_biaya_hotel')->nullable();
            $table->bigInteger('total_jumlah_biaya')->nullable();
            $table->bigInteger('total_uang_muka')->nullable();
            $table->bigInteger('total_kekurangan')->nullable();
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->date('tanggal_transfer')->nullable();
        });

        DB::statement('ALTER TABLE spj_pds AUTO_INCREMENT = 300000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_pds');
    }
}
