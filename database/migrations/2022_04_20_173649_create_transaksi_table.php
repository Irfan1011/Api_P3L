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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('customer');
            $table->unsignedBigInteger('id_mobil');
            $table->foreign('id_mobil')->references('id')->on('mobil');
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawai');
            $table->unsignedBigInteger('id_driver');
            $table->foreign('id_driver')->references('id')->on('driver');
            $table->string('kode_promo_transaksi');
            $table->foreign('kode_promo_transaksi')->references('kode_promo')->on('promo');
            $table->string('nama_customer');
            $table->string('no_ktp_customer');
            $table->string('no_sim_customer');
            $table->date('tanggal_transaksi');
            $table->dateTime('tanggal_waktu_mulai_sewa');
            $table->dateTime('tanggal_waktu_selesai_sewa');
            $table->string('mobil_yang_disewa');
            $table->string('no_plat_mobil');
            $table->float('harga_sewa_harian');
            $table->string('nama_driver');
            $table->string('no_telp_driver');
            $table->float('tarif_driver_harian');
            $table->string('metode_pembayaran');
            $table->float('ekstensi_peminjaman');
            $table->float('total_pembayaran');
            $table->float('payment');
            $table->float('kembalian');
            $table->float('diskon');
            $table->string('status_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};