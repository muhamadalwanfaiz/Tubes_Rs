<?php

namespace App\Exports;

use App\Models\Kunjungan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KunjungansExport implements FromArray, WithHeadings, ShouldAutoSize
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Kunjungan::all();
    // }
    public function array(): array
    {
        $kunjungan = Kunjungan::with('relationToPasien','relationToDokter')->get();
        $dataKunjungan = array();

        for($i=0; $i < count($kunjungan) ; $i++) { 
            $dataKunjungan[$i]['id'] = $kunjungan[$i]->id;
            $dataKunjungan[$i]['relationToPasien'] = $kunjungan[$i]->relationToPasien->nama;
            $dataKunjungan[$i]['relationToDokter'] = $kunjungan[$i]->relationToDokter->spesialis;
            $dataKunjungan[$i]['keterangan'] = $kunjungan[$i]->keterangan;
        }

        return $dataKunjungan;
    }

    public function headings(): array
    {
        return [
            'ID',
            'NAMA PASIEN',
            'SPESIALIS',
            'KETERANGAN',
        ];
    }
}
