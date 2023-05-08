<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\detailBuku;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class detailBukuAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = detailBuku::with('buku')->latest()->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('buku_id', function ($detailBuku) {
                        return $detailBuku->buku ? $detailBuku->buku->judul : '-';
                    })
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" style="padding:5px 13px;" class="edit btn btn-primary btn-sm tombol-edit"><ion-icon style="font-size: 25px;" name="create-outline"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" style="padding:5px 13px;" class="btn btn-danger btn-sm tombol-del"><ion-icon style="font-size: 25px;" name="trash-outline"></ion-icon></a>';

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }
    public function viewDetailBuku()
    {
       $dataBuku = buku::all();
       return view('backend.detailBuku.data',[
        "dataBuku" => $dataBuku
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
        $validasi = Validator::make($request->all(), [
            'buku_id' => 'required',
            'isbn' => 'required',
            'penerbit' => 'required',
            'jumlah_halaman' => 'required',
            'desc' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,png|max:2048',
        ], [
            'buku_id.required' => 'Data buku id harus diisi',
            'isbn.required' => 'Data ISBN harus diisi',
            'penerbit.required' => 'Data penerbit harus diisi',
            'jumlah_halaman.required' => 'Data jumlah halaman harus diisi',
            'desc.required' => 'Deskripsi buku harus diisi',
            'gambar.required' => 'Gambar harus diisi',
            'gambar.mimes' => 'Format gambar tidak valid, hanya menerima format .jpg, .jpeg, atau .png',
            'gambar.max' => 'Ukuran gambar melebihi batas maksimum 2048 KB',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $detailBuku = new DetailBuku;
            $detailBuku->buku_id = $request->buku_id;
            $detailBuku->isbn = $request->isbn;
            $detailBuku->penerbit = $request->penerbit;
            $detailBuku->jumlah_halaman = $request->jumlah_halaman;
            $detailBuku->desc = $request->desc;
    
            // Upload gambar
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = date('dmy') . "-" . time() . '.' . $gambar->getClientOriginalExtension();
                $path = public_path('storage/buku/') . $nama_gambar;
                Image::make($gambar)->save($path);
                $detailBuku->gambar = $nama_gambar;
            }
    
            $detailBuku->save();
            return response()->json(["success" => "Berhasil menyimpan data detail buku"]);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = detailBuku::where('id', $id)->first();
        $dataBuku = buku::all();
        return response()->json([
            'result' => $data,
            'dataBuku' => $dataBuku
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
    $validator = Validator::make($request->all(), [
        'buku_id' => 'required',
        'isbn' => 'required',
        'desc' => 'required',
        'penerbit' => 'required',
        'jumlah_halaman' => 'required',
        "old_picture" => 'required',
        "new_picture" => 'nullable'
    ], [
        'buku_id.required' => 'Data buku id harus diisi',
        'isbn.required' => 'Data isbn harus diisi',
        'desc.required' => 'Data desc harus diisi',
        'penerbit.required' => 'Data penerbit harus diisi',
        'jumlah_halaman.required' => 'Data jumlah halaman harus diisi',
        'desc.required' => 'Deskripsi buku harus diisi',
        'old_picture.required' => 'gambar harus diisi.'
    ]); 

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()]);
    }
    
    if (!empty($request->file('new_picture'))) {

        $old_picture_path = public_path('storage/buku/'.$request->input('old_picture'));
        if (file_exists($old_picture_path)) {
            unlink($old_picture_path);
        }

        $gambar = $request->file('new_picture');
        $nama_gambar =  date('dmy')."-".time() . '.' . $gambar->getClientOriginalExtension();
        $path = public_path('storage/buku/') . $nama_gambar;
        Image::make($gambar)->save($path);

        $newdata = [
            "buku_id" => $request->input("buku_id"),
            "isbn" => $request->input('isbn'),
            "penerbit" => $request->input('penerbit'),
            "jumlah_halaman" => $request->input('jumlah_halaman'),
            "desc" => $request->input('desc'),
            "gambar" => $nama_gambar,
        ];

    }else{
        $newdata = [
            "buku_id" => $request->input("buku_id"),
            "isbn" => $request->input('isbn'),
            "penerbit" => $request->input('penerbit'),
            "jumlah_halaman" => $request->input('jumlah_halaman'),
            "desc" => $request->input('desc'),
            "gambar" => $request->input('old_picture'),
        ];
    }

    detailBuku::where('id', $id)->update($newdata);
    return response()->json(['success' => 'Detail Buku berhasil diupdate.']);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailBuku = DetailBuku::findOrFail($id);
        $gambar_path = public_path('storage/buku/') . $detailBuku->gambar;
        if (file_exists($gambar_path)) {
            unlink($gambar_path);
        }
        $detailBuku->delete();
    return response()->json([ "success" => "Berhasil menghapus data detail buku"]);
    }
}
