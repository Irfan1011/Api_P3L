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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('email');
            $table->string('no_telp');
            $table->string('password');
            $table->string('email_verifikasi_code')->nullable();
            $table->integer('is_verified')->default(0);
            $table->rememberToken();
            $table->boolean('verifikasi_CS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};