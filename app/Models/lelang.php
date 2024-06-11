<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lelang extends Model
{
    use HasFactory;
    protected $table = 'lelang';
    protected $fillable = [
        'id_lelang',
        'nama_lelang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_lelang',
        'id_tengkulak',
        'id_customer',
        'open_bid',
        'kelipatan_bid',
        'harga_akhir',
        'id_cabai',
    ];
}
