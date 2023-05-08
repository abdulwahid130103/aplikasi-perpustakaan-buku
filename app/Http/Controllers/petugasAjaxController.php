<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\peminjaman;
use App\Models\keranjang;
use App\Models\comment;
use Illuminate\Support\Facades\Hash;
use App\Models\log_aktivitas_petugas;
use App\Models\log_aktivitas_anggota;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class petugasAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with(['peminjaman','keranjang','log_aktivitas_anggota','log_aktivitas_petugas','comment','saran'])->where('role', 'petugas')->latest()->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $btn ='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" style="padding:5px 13px;" class="edit btn btn-primary btn-sm tombol-edit"><ion-icon style="font-size: 25px;" name="create-outline"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" style="padding:5px 13px;" class="btn btn-danger btn-sm tombol-del"><ion-icon style="font-size: 25px;" name="trash-outline"></ion-icon></a>';

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function viewPetugas(){
        return view('backend.petugas.data');
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ],[
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'email harus diisi',
            'password.required' => 'password harus diisi'
        ]);

        if($validasi->fails()){
            return response()->json(['errors'=> $validasi->errors()]);
        }else{
            $data = [
                'username' =>$request->username,
                'email' =>$request->email,
                'password' => Hash::make($request->password)
            ];
            $data["role"] = "petugas";
            User::create($data);
            return response()->json([ "success" => "Berhasil menyimpan data petugas"]);
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
        $validasi = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required'
        ],[
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'email harus diisi'
        ]);

        if($validasi->fails()){
            return response()->json(['errors'=> $validasi->errors()]);
        }else{
            $data = [
                'username' =>$request->username,
                'email' =>$request->email
            ];
            User::where('id', $id)->update($data);
            return response()->json([ "success" => "Berhasil mengupdate data petugas"]);
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
        User::where('id', $id)->delete();
        return response()->json(['success' => "berhasil menghapus data petugas"]);
    }
}
