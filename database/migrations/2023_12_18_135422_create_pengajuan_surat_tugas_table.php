<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_surat_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->string('no_surtug')->nullable(true);
            $table->string('name');
            $table->string('nip');
            $table->string('golongan');
            $table->string('jabatan');
            $table->string('nama_kegiatan');
            $table->string('lokasi');
            $table->date('tanggal_perdin_mulai');
            $table->date('tanggal_perdin_selesai');
            $table->date('tanggal_ttd')->nullable(true);
            $table->string('nama_pejabat_ttd');
            $table->string('jabatan_pejabat_ttd');
            $table->string('file_path');
            $table->integer('status_surtug')->default(0);
            $table->integer('lampiran')->default(0);
            $table->string('moda_transportasi');
            $table->string('kode_program')->default('');
            $table->string('kode_kegiatan')->default('');
            $table->string('kode_output')->default('');
            $table->string('kode_komponen')->default('');
            $table->string('kode_sub_komponen')->default('');
            $table->integer('updated')->default(0);
            $table->string('keterangan')->default('Belum dilengkapi');
            $table->string('ppk')->default('');
            $table->integer('kode_track')->default(1);
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
        Schema::dropIfExists('pengajuan_surat_tugas');
    }
};
