<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
    'is_banned', // ✅ harus sama dengan DB
];

protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
    'is_banned' => 'boolean', // ✅ sama dengan DB
];

// Accessor untuk cek banned
public function getIsBannedAttribute($value)
{
    return $value;
}

// Toggle ban (misal di UserController Admin)
public function toggleBan(User $user)
{
    if ($user->role === 'admin') {
        return back()->withErrors([
            'banned' => 'Admin tidak bisa dibanned.'
        ]);
    }

    $user->update([
        'is_banned' => !$user->is_banned // ✅ pakai is_banned
    ]);

    $statusText = $user->is_banned ? 'dibanned' : 'aktif';
    return back()->with('success', "User berhasil diubah statusnya menjadi: $statusText.");
}

}
