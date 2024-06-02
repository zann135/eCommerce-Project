<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabai extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cabai',
        'nama_cabai',
        'harga_awal',
        'stok',
        'foto_cabai',
    ];
}
