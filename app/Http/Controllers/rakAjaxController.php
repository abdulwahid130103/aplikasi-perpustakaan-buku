<?php

namespace App\Http\Controllers;

use App\Models\rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class rakAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = rak::latest()->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" style="padding:5px 13px;" class="edit btn btn-primary btn-sm tombol-edit"><ion-icon style="font-size: 25px;" name="create-outline"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" style="padding:5px 13px;" class="btn btn-danger btn-sm tombol-del"><ion-icon style="font-size: 25px;" name="trash-outline"></ion-icon></a>';

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function viewRak()
    {
       return view('backend.rak.data');
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
            'nama' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi',
        ]);

        if($validasi->fails()){
            return response()->json(['errors'=> $validasi->errors()]);
        }else{
            $data = [
                'nama' =>$request->nama
            ];
            rak::create($data);
            return response()->json([ "success" => "Berhasil menyimpan data rak"]);
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
        $data = rak::where('id', $id)->first();
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
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'nama' => $request->nama,
            ];
            rak::where('id', $id)->update($data);
            return response()->json([ "success" => "Berhasil mengupdate data rak"]);
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
        rak::where('id', $id)->delete();
        return response()->json(['success' => "berhasil menghapus data rak"]);
    }
}
