<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    public static function getDataPasiens()
    {
        $pasiens = Pasien::all();

        $pasiens_filter = [];
        $no = 1;
        for ($i=0; $i < $pasiens->count(); $i++) { 
            $pasiens_filter[$i]['no'] = $no++;
            $pasiens_filter[$i]['kodePasien'] = $pasiens[$i]->kodePasien;
            $pasiens_filter[$i]['nama'] = $pasiens[$i]->nama;
            $pasiens_filter[$i]['gender'] = $pasiens[$i]->gender;
            $pasiens_filter[$i]['umur'] = $pasiens[$i]->umur;
            $pasiens_filter[$i]['alamat'] = $pasiens[$i]->alamat;
            $pasiens_filter[$i]['noHp'] = $pasiens[$i]->noHp;
        }

        return $pasiens_filter;
    }

}
