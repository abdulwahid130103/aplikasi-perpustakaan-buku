<?php

namespace App\Http\Controllers;


use App\Models\buku;
use App\Models\keranjang;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class peminjamanFrontendAjax extends Controller
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
                'keranjang_id' => 'required',
                'tgl_booking' => 'required|date|after_or_equal:today|before_or_equal:'.date('Y-m-d', strtotime('+7 days')),
            ],[
                'user.required' => 'user harus diisi',
                'keranjang_id.required' => 'keranjang_id harus diisi',
                'tgl_booking.required' => 'tgl_booking harus diisi',
                'tgl_booking.after_or_equal' => 'tgl_booking harus sama atau setelah tanggal hari ini',
                'tgl_booking.before_or_equal' => 'tgl_booking harus dalam rentang 1 minggu kedepan',
            ]);
            
            $panjangBooking = explode(", ", $request->keranjang_id);

            if($validasi->fails()){
                return response()->json(['errors'=> $validasi->errors()]);
            }else{ 
                
                $today = date('Y-m-d');
                $count = DB::table('peminjaman')->where('user_id',$request->user_id)->whereDate('created_at', $today)->count();

                if($count == 2){
                    return response()->json([ "notif" => "maap maksimal 2 buku dalam 1 hari untuk peminjaman"]);
                }
                if(count($panjangBooking) == 1){    
                    $keranjang = keranjang::find($panjangBooking[0]);
                    $idBuku = $keranjang->buku_id;
                    $buku = buku::find($idBuku);
                    $peminjaman = peminjaman::where('user_id', $request->user_id)
                                            ->where('buku_id', $idBuku)
                                            ->first();

                    if($peminjaman && $peminjaman->status == "diboking" || $peminjaman && $peminjaman->status == "dipinjam"){
                        return response()->json([ "notif" => "maap buku sudah anda pinjam"]);
                    } else {
                        $data = [
                            'stok' => $buku->stok - 1,
                        ];
                        $dataPinjam = [
                            'user_id' => $request->user_id,
                            'buku_id' => $buku->id,
                            'tgl_booking' => $request->tgl_booking,
                            'status' => 'diboking',
                        ];
                        peminjaman::create($dataPinjam);
                        buku::where('id', $buku->id)->update($data);
                        keranjang::where('id', $keranjang->id)->delete();
                        return response()->json([ "success" => "Berhasil booking 1 buku"]);
                    }
                }else{
                    $keranjang1 = keranjang::find($panjangBooking[0]);
                    $keranjang2 = keranjang::find($panjangBooking[1]);

                    $buku1 = buku::find($keranjang1->buku_id);
                    $buku2 = buku::find($keranjang2->buku_id);

                    $peminjaman1 = peminjaman::where('user_id', $request->user_id)
                                            ->where('buku_id', $buku1->id)
                                            ->first();
                    $peminjaman2 = peminjaman::where('user_id', $request->user_id)
                                            ->where('buku_id', $buku2->id)
                                            ->first();
                    if($peminjaman1 && $peminjaman1->status == "diboking" || $peminjaman1 && $peminjaman1->status == "dipinjam" || $peminjaman2 && $peminjaman2->status == "diboking" || $peminjaman2 && $peminjaman2->status == "dipinjam"){
                        return response()->json([ "notif" => "maap buku sudah anda pinjam"]);
                    }else{
                        $data1 = [
                            'stok' => $buku1->stok - 1,
                        ];
                        $data2 = [
                            'stok' => $buku2->stok - 1,
                        ];
                        $dataPinjam1 = [
                            'user_id' => $request->user_id,
                            'buku_id' => $buku1->id,
                            'tgl_booking' => $request->tgl_booking,
                            'status' => 'diboking',
                        ];
                        $dataPinjam2 = [
                            'user_id' => $request->user_id,
                            'buku_id' => $buku2->id,
                            'tgl_booking' => $request->tgl_booking,
                            'status' => 'diboking',
                        ];
                        peminjaman::create($dataPinjam1);
                        peminjaman::create($dataPinjam2);
                        buku::where('id', $buku1->id)->update($data1);
                        buku::where('id', $buku2->id)->update($data2);
                        keranjang::where('id', $keranjang1->id)->delete();
                        keranjang::where('id', $keranjang2->id)->delete();
                        return response()->json([ "success" => "Berhasil booking buku 2"]);
                    }
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
