<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_siswa');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function history_payments()
    {
        return $this->hasMany(historyPayment::class);
    }

}
