<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detailBuku;
use App\Models\kategori;
use App\Models\rak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Exports\ExportExcelBuku;
use Maatwebsite\Excel\Facades\Excel;

class laporanBukuAjax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = buku::with(['kategori','rak'])->latest()->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('kategori_id', function ($buku) {
                        return $buku->kategori ? $buku->kategori->nama : '-';
                    })
                    ->addColumn('rak_id', function ($buku) {
                        return $buku->rak ? $buku->rak->nama : '-';
                    })
                    ->make(true);
    }
    public function viewLaporanBuku()
    {
       return view('backend.laporan_buku.data');
    }
    public function exportExcelBuku(){
        return Excel::download(new exportExcelBuku,'Buku.xlsx');
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
