<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    // use HasFactory;

    public function relationToDokter()
    {
        return $this->belongsTo(Dokter::class, 'dokters_id');
    }
    public function relationToPasien()
    {
        return $this->belongsTo(Pasien::class, 'pasiens_id');
    }
}
