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
        Schema::create('nota', function (Blueprint $table) {
            $table->integer('nomor_transaksi_nota')->unsigned();
            $table->foreign('nomor_transaksi_nota')->references('id')->on('transaksi');
            $table->timestamps();
            $table->date('tanggal_nota');
            $table->string('nama_customer');
            $table->string('nama_CS');
            $table->string('nama_driver');
            $table->string('promo');
            $table->dateTime('tanggal_mulai', $precision = 0);
            $table->dateTime('tanggal_selesai', $precision = 0);
            $table->dateTime('tanggal_pengembalian', $precision = 0);
            $table->string('nama_mobil');
            $table->float('harga_satuan_mobil');
            $table->float('harga_satuan_driver');
            $table->float('sub_total_mobil');
            $table->float('sub_total_driver');
            $table->float('denda');
            $table->float('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota');
    }
};