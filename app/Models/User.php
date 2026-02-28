<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens; // ✅ INI YANG BENAR
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // ✅ SATU BARIS SAJA

    protected $fillable = [
        'username',
        'password',
        'role',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'email',
        'no_hp',
        'alamat',
        'foto',
        'is_banned',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_banned' => 'boolean',
    ];

    public function wishlist()
    {
        return $this->hasMany(\App\Models\Wishlist::class);
    }
}