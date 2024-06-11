<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pembayaran',
        'id_lelang',
        'id_tengkulak',
        'id_customer',
        'bukti_pembayaran',
        'status_pembayaran',
    ];
}
