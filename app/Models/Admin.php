<?php

namespace App\Models;

// Perhatikan bahwa kita menggunakan Authenticatable, bukan Model biasa
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Nama tabel di database
    protected $table = 'admins';

    // Kolom yang diizinkan untuk diisi
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Kolom yang disembunyikan (demi keamanan)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mengamankan format password
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}