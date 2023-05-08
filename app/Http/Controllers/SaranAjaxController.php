<?php

namespace App\Http\Controllers;

use App\Models\saran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SaranAjaxController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = saran::with(['user'])->latest()->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user_id', function ($saran) {
                        return $saran->user ? $saran->user->username : '-';
                    })
                    ->addColumn('action', function($data){
                        $btn ='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" style="padding:5px 13px;" class="edit btn btn-primary btn-sm tombol-edit"><ion-icon style="font-size: 25px;" name="create-outline"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" style="padding:5px 13px;" class="btn btn-danger btn-sm tombol-del"><ion-icon style="font-size: 25px;" name="trash-outline"></ion-icon></a>';

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    public function viewSaran(){
        return view('backend.saran.data');
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
