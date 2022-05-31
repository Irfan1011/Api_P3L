<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nota extends Model
{
    use HasFactory;
    protected $table='nota';
    protected $fillable = [
        'nomor_transaksi_nota',
        'tanggal_nota',
        'nama_customer',
        'nama_CS',
        'nama_driver',
        'promo',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_pengembalian',
        'nama_mobil',
        'harga_satuan_mobil',
        'harga_satuan_driver',
        'sub_total_mobil',
        'sub_total_driver',
        'denda',
        'total',
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