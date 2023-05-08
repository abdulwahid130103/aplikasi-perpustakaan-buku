<?php

namespace App\Http\Controllers;

use App\Models\keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class keranjangAjaxController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $validasi = Validator::make($request->all(),[
            'user_id' => 'required',
            'buku_id' => 'required',
        ]);

        if($validasi->fails()){
            return response()->json(['errors'=> $validasi->errors()]);
        }else{
            $dataKeranjang = keranjang::where('buku_id',$request->buku_id)->count();
            if($dataKeranjang == 1){
                return response()->json([ "warning" => "buku sudah dikeranjang anda"]);
            }else{
                $data = [
                    'user_id' =>$request->user_id,
                    'buku_id' =>$request->buku_id
                ];
                keranjang::create($data);
                return response()->json([ "success" => "Berhasil memasukkan buku dalam keranjang"]);
            }
        }
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
        $bukuTerbaru = DB::table('buku as b')
                        ->select('b.id as id_buku', 'b.judul', 'db.desc', 'db.gambar', 'k.id as id_keranjang')
                        ->join('detail_buku as db', 'b.id', '=', 'db.buku_id')
                        ->join('keranjang as k', 'b.id', '=', 'k.buku_id')
                        ->get();
    
        return response()->json(['data' => $bukuTerbaru]);
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
        keranjang::where('id', $id)->delete();
        return response()->json(['success' => "berhasil menghapus buku dari keranjang"]);
    }
}
