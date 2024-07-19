<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelSpjTrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_spj_trs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('spj_id');
            $table->foreign('spj_id')->references('id')->on('spj_trs')->onDelete('cascade');
            $table->string('nama');
            $table->bigInteger('transpor_per_hari');
            $table->bigInteger('jumlah_kegiatan');
            $table->bigInteger('jumlah_yang_dibayarkan');
            $table->string('bank');
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
        Schema::dropIfExists('tabel_spj_trs');
    }
}
