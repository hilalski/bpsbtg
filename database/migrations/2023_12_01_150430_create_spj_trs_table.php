<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpjTrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spj_trs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('bulan');
            $table->string('judul');
            $table->string('kegiatan');
            $table->string('program');
            $table->string('kro');
            $table->string('rencana_output');
            $table->string('komponen');
            $table->string('akun');
            $table->date('tanggal_kegiatan');
            $table->string('jenis_spj');
            $table->string('bendahara');
            $table->string('ppk');
            $table->string('status');
            $table->date('tanggal_transfer')->nullable(); 
            $table->string('keterangan')->default('-');
            $table->bigInteger('total_transpor_per_hari')->nullable();
            $table->bigInteger('total_jumlah_kegiatan')->nullable();
            $table->bigInteger('total_jumlah_yang_dibayarkan')->nullable();
        });

        DB::statement('ALTER TABLE spj_trs AUTO_INCREMENT = 100000;');

    // Add a check constraint to limit the auto-increment values
    // DB::statement('ALTER TABLE spj_trs ADD CONSTRAINT check_id_range CHECK (id <= 200000);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj_trs');
    }
}
