<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Exports\ExportExcelPeminjaman;
use Maatwebsite\Excel\Facades\Excel;

class laporanPeminjamanAjax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = peminjaman::with(['user','buku','pengembalian'])->latest()->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user_id', function ($peminjaman) {
                        return $peminjaman->user ? $peminjaman->user->username : '-';
                    })
                    ->addColumn('buku_id', function ($peminjaman) {
                        return $peminjaman->buku ? $peminjaman->buku->judul : '-';
                    })
                    ->make(true);
    }

    public function viewLaporanPeminjaman(){
        return view('backend.laporan_peminjaman.data');
    }
    public function exportExcelPeminjaman(){
        return Excel::download(new exportExcelPeminjaman,'Peminjaman.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
