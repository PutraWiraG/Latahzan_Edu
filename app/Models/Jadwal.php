<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_guru');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'id_jadwal');
    }
}
