<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'password',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'tgl_lahir' => 'date',
            'password' => 'hashed',
        ];
    }

    public function pegawai(): HasOne
    {
        return $this->hasOne(Pegawai::class);
    }
}
