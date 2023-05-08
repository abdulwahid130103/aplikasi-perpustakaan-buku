<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\keranjang;
use App\Models\peminjaman;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class peminjamanAjaxController extends Controller
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
                    ->addColumn('action', function($data){
                        $btn = '';
                        if ($data->status == 'diboking') {
                            $btn ='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Acc" style="padding:5px 13px;" class="edit btn btn-warning btn-sm tombol-acc me-1"><ion-icon style="font-size: 25px;" name="checkmark-outline"></ion-icon></a>';
                        }else if ($data->status == 'dipinjam') {
                            $btn ='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="AccPengembalian" style="padding:5px 13px;" class="edit btn btn-warning btn-sm tombol-acc-pengembalian me-1"><ion-icon style="font-size: 25px;" name="checkmark-outline"></ion-icon></a>';
                        }else{
                            $btn = "Complete";
                        }
                        
                        
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function viewPeminjaman(){
        return view('backend.peminjaman.data');
    }

    public function accPeminjaman($id)
    {
            $tanggalSekarang = Carbon::now();
            $tanggalDuaHariKedepan = $tanggalSekarang->addDays(2)->format('Y-m-d');
        
            $data = [
                'tgl_pinjam' => $tanggalSekarang,
                'tgl_kembali' => $tanggalDuaHariKedepan,
                'status' => 'dipinjam',
            ];
            peminjaman::where('id', $id)->update($data);
            return response()->json([ "success" => "Berhasil melakukan acc peminjaman"]);
    }
    public function accPengembalian($id)
    {
        $peminjaman = peminjaman::find($id);
        $tanggalSekarang = Carbon::now();
        $tanggalPengembalian = Carbon::parse($peminjaman->tgl_kembali);
        $denda = 0;
        
        if ($tanggalSekarang->greaterThan($tanggalPengembalian)) {
            $selisihHari = $tanggalSekarang->diffInDays($tanggalPengembalian, false);
            $denda = $selisihHari * -5000;
        }
        $data = [
            'peminjaman_id' => $id,
            'tgl_pengembalian' => $tanggalSekarang,
            'denda' => $denda,
        ];
        pengembalian::create($data);

        $buku = buku::find($peminjaman->buku_id);
        $dataBuku = [
            'stok' => $buku->stok + 1,
        ];
        $dataPeminjaman = [
            'status' => 'selesai',
        ];
        buku::where('id', $id)->update($dataBuku);
        peminjaman::where('id', $id)->update($dataPeminjaman);
        return response()->json([ "success" => "Berhasil melakukan pengembalian buku"]);
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
