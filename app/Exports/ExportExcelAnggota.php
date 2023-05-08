<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcelAnggota implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = User::select('id', 'username', 'email', 'role')
                    ->with(['peminjaman','keranjang','log_aktivitas_anggota','log_aktivitas_petugas','comment','saran'])
                    ->where('role', 'anggota')
                    ->latest()
                    ->get();
        $data = [];
        foreach ($user as $index => $user) {
            $row = [
                $index + 1,
                $user->id,
                $user->username,
                $user->email,
                $user->role,
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
            'Username',
            'Email',
            'Role',
        ];
    }
}
