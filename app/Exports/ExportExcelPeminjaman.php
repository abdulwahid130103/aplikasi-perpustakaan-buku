<?php

namespace App\Exports;

use App\Models\peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcelPeminjaman implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $peminjaman = peminjaman::join('users', 'peminjaman.user_id', '=', 'users.id')
                    ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                    ->select('peminjaman.id', 'users.username as user', 'buku.judul as buku', 'peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'peminjaman.status')
                    ->with(['user','buku','pengembalian'])
                    ->where('status','dipinjam')
                    ->latest('peminjaman.created_at')
                    ->get();
        $data = [];
        foreach ($peminjaman as $index => $peminjaman) {
            $row = [
                $index + 1,
                $peminjaman->id,
                $peminjaman->user,
                $peminjaman->buku,
                $peminjaman->tgl_pinjam,
                $peminjaman->tgl_kembali,
                $peminjaman->status
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
            'User',
            'Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status'
        ];
    }
}
