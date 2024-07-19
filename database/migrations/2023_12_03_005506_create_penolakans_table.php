<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenolakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penolakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengadaan_id')->constrained()->onDelete('cascade');
            $table->text('alasan_penolakan');
            $table->date('tanggal_penolakan');
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
        Schema::dropIfExists('penolakans');
    }
}
