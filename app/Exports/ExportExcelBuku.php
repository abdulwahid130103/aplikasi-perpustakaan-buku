<?php

namespace App\Exports;

use App\Models\buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcelBuku implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $buku = Buku::join('kategori', 'buku.kategori_id', '=', 'kategori.id')
                    ->join('rak', 'buku.rak_id', '=', 'rak.id')
                    ->select('buku.id', 'buku.judul', 'buku.pengarang', 'buku.tahun_terbit', 'buku.stok', 'kategori.nama as kategori', 'rak.nama as rak')
                    ->with(['kategori','rak','detailBuku','peminjaman','keranjang','comment'])
                    ->latest('buku.created_at')
                    ->get();
        $data = [];
        foreach ($buku as $index => $buku) {
            $row = [
                $index + 1,
                $buku->id,
                $buku->judul,
                $buku->pengarang,
                $buku->tahun_terbit,
                $buku->stok,
                $buku->kategori,
                $buku->rak
            ];

            array_push($data, $row);
        }

        return collect($data);
    }
    public function headings(): array
    {
        return [
            'No',
            'Id',
            'Judul',
            'Pengarang',
            'Tahun Terbit',
            'Stok',
            'Kategori',
            'Rak'
        ];
    }
}
