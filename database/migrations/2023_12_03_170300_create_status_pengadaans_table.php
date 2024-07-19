<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pengadaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengadaan_id')->constrained('pengadaans');
            $table->enum('status', [
                'Diajukan', 'Diterima PPK', 'Ditolak', 'Revisi',
                'Diproses', 'Dilaksanakan', 'Selesai', 'Diserahkan'
            ]);
            $table->timestamp('changed_at')->useCurrent();
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
        Schema::dropIfExists('status_pengadaans');
    }
}
