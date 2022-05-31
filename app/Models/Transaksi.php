<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;
    protected $table='transaksi';
    protected $fillable = [
        'id_customer',
        'id_mobil',
        'id_pegawai',
        'id_driver',
        'kode_promo_transaksi',
        'nama_customer',
        'no_ktp_customer',
        'no_sim_customer',
        'tanggal_transaksi',
        'tanggal_waktu_mulai_sewa',
        'tanggal_waktu_selesai_sewa',
        'mobil_yang_disewa',
        'no_plat_mobil',
        'harga_sewa_harian',
        'nama_driver',
        'no_telp_driver',
        'tarif_driver_harian',
        'metode_pembayaran',
        'biaya_sewa_mobil',
        'ekstensi_peminjaman',
        'total_pembayaran',
        'payment',
        'kembalian',
        'status_transaksi',
    ];

    public function getCreatedAtAttribute()
    {
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttributes()
    {
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}