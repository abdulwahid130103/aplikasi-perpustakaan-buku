<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detailBuku;
use App\Models\kategori;
use App\Models\rak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class bukuAjaxController extends Controller
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
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Show" style="padding:5px 13px; margin-right:4px;" class="btn btn-danger btn-sm show-buku"><ion-icon style="font-size: 25px;" name="alert-circle-outline"></ion-icon></a>';
                        $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" style="padding:5px 13px;" class="edit btn btn-primary btn-sm tombol-edit"><ion-icon style="font-size: 25px;" name="create-outline"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" style="padding:5px 13px;" class="btn btn-danger btn-sm tombol-del"><ion-icon style="font-size: 25px;" name="trash-outline"></ion-icon></a>';

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }
    public function viewBuku()
    {
      $dataKategori = kategori::all();
      $dataRak = rak::all();
       return view('backend.buku.data',[
        "dataKategori" => $dataKategori,
        "dataRak" => $dataRak
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'kategori_id' => 'required',
            'rak_id' => 'required'
        ],[
            'judul.required' => 'judul harus diisi',
            'pengarang.required' => 'pengarang harus diisi',
            'tahun_terbit.required' => 'tahun_terbit harus diisi',
            'stok.required' => 'stok harus diisi',
            'kategori_id.required' => 'kategori_id harus diisi',
            'rak_id.required' => 'rak_id harus diisi'
        ]);

        if($validasi->fails()){
            return response()->json(['errors'=> $validasi->errors()]);
        }else{
            $data = [
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
                'kategori_id' => $request->kategori_id,
                'rak_id' => $request->rak_id
            ];
            buku::create($data);
            return response()->json([ "success" => "Berhasil menyimpan data buku"]);
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
        $data = detailBuku::where('buku_id', $id)->first();
        $dataBuku = buku::where('id', $id)->first();
        return response()->json([
            'result' => $data,
            'dataBuku' => $dataBuku
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = buku::where('id', $id)->first();
        $dataKategori = kategori::all();
        $dataRak = rak::all();
        return response()->json([
            'result' => $data,
            'dataKategori' => $dataKategori,
            'dataRak' => $dataRak
        ]);
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
        $validasi = Validator::make($request->all(), [
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'kategori_id' => 'required',
            'rak_id' => 'required'
        ], [
            'judul.required' => 'judul harus diisi',
            'pengarang.required' => 'pengarang harus diisi',
            'tahun_terbit.required' => 'tahun_terbit harus diisi',
            'stok.required' => 'stok harus diisi',
            'kategori_id.required' => 'kategori_id harus diisi',
            'rak_id.required' => 'rak_id harus diisi'
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
                'kategori_id' => $request->kategori_id,
                'rak_id' => $request->rak_id
            ];
            buku::where('id', $id)->update($data);
            return response()->json([ "success" => "Berhasil mengupdate data buku"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        buku::where('id', $id)->delete();
        return response()->json(['success' => "berhasil menghapus data buku"]);
    }
}
