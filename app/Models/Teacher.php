<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Teacher extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_guru');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
