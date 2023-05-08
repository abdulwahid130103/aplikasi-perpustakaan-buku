<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class transaksiAjaxController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showQuery($status)
    {
        $user = Auth::user()->id;
        $data1 = DB::table('buku as b')
        ->join('detail_buku as db', 'b.id', '=', 'db.buku_id')
        ->join('peminjaman as p', 'b.id', '=', 'p.buku_id')
        ->join('users as u', 'p.user_id', '=', 'u.id')
        ->leftJoin('pengembalian as pg', 'p.id', '=', 'pg.peminjaman_id')
        ->where('p.user_id', '=', $user)
        ->where('p.status', '=', $status)
        ->select('b.judul', 'db.desc', 'db.gambar', 'p.status', 'p.tgl_booking','p.id as peminjaman_id','p.tgl_kembali','pg.tgl_pengembalian')
        ->get();
        
        return $data1;
    }

    public function index()
    {
        $data1 = $this->showQuery('diboking');
        $data2 = $this->showQuery('dipinjam');
        $data3 = $this->showQuery('selesai');
        return view('frontend.transaksi.data',[
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
        ]);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        peminjaman::where('id', $id)->delete();
        return response()->json(['success' => "membatalkan booking"]);
    }
}
