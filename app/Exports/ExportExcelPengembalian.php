<?php

namespace App\Exports;

use App\Models\pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcelPengembalian implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pengembalian = pengembalian::select('id', 'peminjaman_id', 'tgl_pengembalian', 'denda')
                    ->with('peminjaman')
                    ->latest()
                    ->get();
        $data = [];
        foreach ($pengembalian as $index => $pengembalian) {
            if($pengembalian->denda == 0){
                $row = [
                    $index + 1,
                    $pengembalian->id,
                    $pengembalian->peminjaman_id,
                    $pengembalian->tgl_pengembalian,
                    "Tidak ada denda"
                ];
            }else{
                $row = [
                    $index + 1,
                    $pengembalian->id,
                    $pengembalian->peminjaman_id,
                    $pengembalian->tgl_pengembalian,
                    $pengembalian->denda
                ];
            }

            array_push($data, $row);
        }

        return collect($data);
    }
    public function headings(): array
    {
        return [
            'No',
            'Id',
            'Peminjaman',
            'Tanggal Pengembalian',
            'Denda'
        ];
    }
}
