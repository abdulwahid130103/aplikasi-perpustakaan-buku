<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class detailBukuFrontendAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = buku::find($id);
        // return view('frontend.detail-buku.data',[
        //     'data' => $data
        // ]);
    }


    public function viewDetail($id)
    {
        $data = DB::table('buku as b')
            ->join('detail_buku as db', 'b.id', '=', 'db.buku_id')
            ->join('kategori as k', 'b.kategori_id', '=', 'k.id')
            ->select('b.id as id_buku', 'b.judul', 'b.pengarang', 'b.tahun_terbit', 'b.stok', 'db.isbn', 'db.penerbit', 'db.desc', 'db.jumlah_halaman', 'db.gambar', 'k.nama')
            ->where('b.id', '=', $id)
            ->get();
        $datakomen = comment::with(['buku','user'])->latest()->where('buku_id',$id)->get();
        return view('frontend.detail-buku.data',[
            'data' => $data,
            'dataKomen' => $datakomen
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
