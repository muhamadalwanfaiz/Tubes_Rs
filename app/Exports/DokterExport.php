<?php

namespace App\Exports;

use App\Models\Dokter;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DokterExport implements FromArray, WithHeadings, ShouldAutoSize
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
        // return Dokter::all();
    // }

    public function array(): array
    {
        return Dokter::getDataDokters();
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA',
            'SPESIALIS',
        ];
    }
}
