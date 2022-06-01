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
        Schema::create('detail_mobil', function (Blueprint $table) {
            // $table->unsignedBigInteger('mobil_id');
            // $table->foreign('mobil_id')->references('id')->on('mobil');
            $table->foreignId('mobil_id')->constrained('mobil');
            $table->timestamps();
            $table->integer('volume_bahan_bakar');
            $table->integer('kapasitas_penumpang');
            $table->string('plat_nomor');
            $table->string('nomor_stnk');
            $table->string('kategori_aset');
            $table->string('nama_pemilik');
            $table->string('no_ktp_pemilik');
            $table->string('alamat_pemilik');
            $table->string('no_telp_pemilik');
            $table->date('periode_kontrak_mulai');
            $table->date('periode_kontrak_selesai');
            $table->date('tanggal_terakhir_kali_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_mobil');
    }
};