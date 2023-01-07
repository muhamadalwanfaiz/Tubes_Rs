<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    public function relationToKunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungans_id');
    }
}
