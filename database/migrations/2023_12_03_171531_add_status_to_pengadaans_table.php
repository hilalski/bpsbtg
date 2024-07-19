<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            $table->enum('status', [
                'Diajukan', 'Diterima PPK', 'Ditolak', 'Revisi',
                'Diproses', 'Dilaksanakan', 'Selesai', 'Diserahkan'
            ])->after('penyelenggara')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengadaans', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
