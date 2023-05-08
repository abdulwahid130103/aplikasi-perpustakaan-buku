<?php

namespace App\Http\Controllers;

use App\Models\pengembalian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Exports\ExportExcelPengembalian;
use Maatwebsite\Excel\Facades\Excel;

class laporanPengembalianAjax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pengembalian::with(['peminjaman'])->latest()->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('peminjaman_id', function ($pengembalian) {
                        return $pengembalian->peminjaman ? $pengembalian->peminjaman->id : '-';
                    })
                    ->make(true);
    }

    public function viewLaporanPengembalian(){
        return view('backend.laporan_pengembalian.data');
    }
    public function exportExcelPengembalian(){
        return Excel::download(new exportExcelPengembalian,'Pengembalian.xlsx');
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
