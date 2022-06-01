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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('foto');
            $table->string('nama');
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('email');
            $table->string('no_telp');
            $table->string('role');
            $table->string('password');
            $table->boolean('verifikasi_email');
            $table->boolean('verifikasi_manager');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};