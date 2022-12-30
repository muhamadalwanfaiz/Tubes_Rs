<?php

namespace App\Exports;

use App\Models\Pasien;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PasienExport implements FromArray, WithHeadings, ShouldAutoSize
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // // {
    // //     Sreturn Pasien::all();
    // }

    public function array(): array
    {
        return Pasien::getDataPasiens();
    }

    public function headings(): array
    {
        return [
            'NO',
            'KODE PASIEN',
            'NAMA',
            'JENIS KELAMIN',
            'UMUR',
            'ALAMAT',
            'NO HANDPHONE',
        ];
    }
}
