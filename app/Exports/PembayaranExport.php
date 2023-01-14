<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PembayaranExport implements FromArray, WithHeadings, ShouldAutoSize
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     //
    // }
    public function array(): array
    {
        $pembayaran = Pembayaran::with('relationToKunjungan')->get();
        $dataPembayaran = array();

        for($i=0; $i < count($pembayaran) ; $i++) { 
            $dataPembayaran[$i]['id'] = $pembayaran[$i]->id;
            $dataPembayaran[$i]['relationToKunjungan'] = $pembayaran[$i]->relationToKunjungan->relationToPasien->nama;
            $dataPembayaran[$i]['noRek'] = $pembayaran[$i]->noRek;
            $dataPembayaran[$i]['jmlPembayaran'] = $pembayaran[$i]->jmlPembayaran;
        }

        return $dataPembayaran;
    }

    public function headings(): array
    {
        return [
            'ID',
            'NAMA PASIEN',
            'NO REKENING',
            'PEMBAYARAN',
        ];
    }
}
