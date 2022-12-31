<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokter extends Model
{
    //use HasFactory;

    public static function getDataDokters()
    {
        $dokters = Dokter::all();

        $dokters_filter = [];
        $no = 1;
        for ($i=0; $i < $dokters->count(); $i++) { 
            $dokters_filter[$i]['no'] = $no++;
            $dokters_filter[$i]['nama'] = $dokters[$i]->nama;
            $dokters_filter[$i]['spesialis'] = $dokters[$i]->spesialis;
        }

        return $dokters_filter;
    }
    
}
