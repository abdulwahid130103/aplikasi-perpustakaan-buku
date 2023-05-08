<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class homeController extends Controller
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

    public function viewHome(){
        $bukuTerbaru = buku::with(['kategori','rak','detailBuku','peminjaman','keranjang','comment'])->latest()->take(6)->get();
        $bukuTerlama = buku::with(['kategori','rak','detailBuku','peminjaman','keranjang','comment'])->orderBy('created_at', 'asc')->take(6)->get();
        return view('frontend.home.home',[
            'bukuTerbaru' => $bukuTerbaru,
            'bukuTerlama' => $bukuTerlama,
        ]);
    }

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
        $data = User::where('id', $id)->first();
        return response()->json(['result' => $data]);
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
            'username' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'jk' => 'required',
            "old_picture" => 'required',
            "new_picture" => 'nullable'
        ], [
            'username.required' => 'Data username harus diisi',
            'email.required' => 'Data email harus diisi',
            'tgl_lahir.required' => 'Data tgl_lahir harus diisi',
            'alamat.required' => 'Data alamat harus diisi',
            'no_telp.required' => 'Data no_telp harus diisi',
            'jk.required' => 'Deskripsi jk harus diisi',
            'old_picture.required' => 'gambar harus diisi.'
        ]); 
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            if (!empty($request->file('new_picture'))) {
                
                if($request->input('old_picture') != 'user.png'){
                    $old_picture_path = public_path('storage/profile/'.$request->input('old_picture'));
                    if (file_exists($old_picture_path)) {
                        unlink($old_picture_path);
                    }
                }
        
                $gambar = $request->file('new_picture');
                $nama_gambar =  date('dmy')."-".time() . '.' . $gambar->getClientOriginalExtension();
                $path = public_path('storage/profile/') . $nama_gambar;
                Image::make($gambar)->save($path);
        
                $newdata = [
                    "username" => $request->input("username"),
                    "email" => $request->input('email'),
                    "tgl_lahir" => $request->input('tgl_lahir'),
                    "alamat" => $request->input('alamat'),
                    "no_telp" => $request->input('no_telp'),
                    "jk" => $request->input('jk'),
                    "foto" => $nama_gambar,
                ];
        
            }else{
                $newdata = [
                    "username" => $request->input("username"),
                    "email" => $request->input('email'),
                    "tgl_lahir" => $request->input('tgl_lahir'),
                    "alamat" => $request->input('alamat'),
                    "no_telp" => $request->input('no_telp'),
                    "jk" => $request->input('jk'),
                    "foto" => $request->input('old_picture'),
                ];
            }
        
            User::where('id', $id)->update($newdata);
            $dt = User::where('id',$id)->first();
            return response()->json([
                'success' => 'Profile berhasil diupdate.',
                'data' => $dt
            ]);
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
        //
    }
}
