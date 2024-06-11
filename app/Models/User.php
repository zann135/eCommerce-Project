<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'username', // field baru
        'level', // field baru
        'password',
    ];
}
