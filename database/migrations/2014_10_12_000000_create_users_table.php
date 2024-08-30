<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->bigInteger('gaji')->nullable();
            $table->string('username')->unique();
            $table->string('nip')->unique();
            $table->string('phone_number')->nullable();
            // $table->string('unit')->nullable();
            // $table->string('picture')->nullable();
            $table->string('role')->nullable();
            $table->string('password');
            // $table->integer('is_kepala_unit')->default(0);
            // $table->integer('is_tim_keuangan')->default(0);
            // $table->integer('is_unit')->default(0);
            $table->integer('is_operator')->default(0);
            // $table->integer('is_pbj')->default(0);
            // $table->integer('is_ppk')->default(0);
            // $table->integer('is_admin')->default(0);
            $table->string('status')->default('Di Kantor');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
