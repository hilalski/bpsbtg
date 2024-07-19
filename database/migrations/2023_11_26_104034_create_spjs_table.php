<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spjs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('program');
            $table->string('kegiatan');
            $table->string('kro');
            $table->string('rencana_output');
            $table->string('komponen');
            $table->string('akun');
            $table->string('periode');
            $table->date('tanggal_kegiatan');
            $table->string('jenis_spj');
            $table->string('bendahara');
            $table->string('ppk');
            $table->string('status');
            $table->date('tanggal_transfer')->nullable(); 
            $table->string('keterangan')->default('-');
            $table->bigInteger('total_pajak')->nullable();
            $table->bigInteger('total_bruto')->nullable();
            $table->bigInteger('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spjs');
    }
}
