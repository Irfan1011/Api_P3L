<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Promo;

class PromoController extends Controller
{
    //Fungsi isEmpty
    public function index()
    {
        $promo = Promo::all();

        if(count($promo)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $promo
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    //Menampilkan satu data promo (search)
    public function show($id)
    {
        $promo = Promo::query($id)->where('kode_promo',$id)->get();

        if(!is_null($promo)){
            return response([
                'message' => 'Retrieve Promo Success',
                'data' => $promo
            ], 200);
        }

        return response([
            'message' => 'Promo Not Found',
            'data' => null
        ], 400);
    }

    //Menambahkan satu data promo (create)
    public function store(Request $request)
    {
        $storeData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($storeData, [
            'kode_promo'=>'required|unique:promo',
            'jenis_promo'=>'required|unique:promo',
            'keterangan'=>['required', 'regex:/[\pL\s\.0-9]+$/']
        ]); //membuat rule validasi input

        if($validate->fails())
            return  response(['message' => $validate->errors()], 400); //return error invalid input

        $promo = Promo::create($storeData);
        return response([
            'message' => 'Add Promo Success',
            'data' => $promo
        ], 200);
    }

    //Menghapus satu data promo (delete)
    public function destroy($id)
    {
        $promo = Promo::find($id); //mencari data berdasarkan id

        if(is_null($promo)){
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ], 404);
        }

        if($promo->delete()){
            return response([
                'message' => 'Delete Promo Success',
                'data' => $promo
            ], 200);
        }

        return response([
            'message' => 'Delete Promo Failed',
            'data'  => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::query($id)->where('kode_promo',$id)->get();//menbcaru data promo berdasarkan id
        if(is_null($promo)){
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ], 400);
        }

        $updateData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($updateData, [
            'kode_promo'=>'required',
            'jenis_promo'=>'required',
            'keterangan'=>['required', 'regex:/[\pL\s\.0-9]+$/']
        ]); //membuat rule validasi 

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); //return error invalid input
            
        $promo->kode_promo = $updateData['kode_promo']; //edit kode_promo
        $promo->jenis_promo = $updateData['jenis_promo']; //edit jenis_promo
        $promo->keterangan = $updateData['keterangan']; //edit keterangan
        $promo->date = $updateData['date'];
        $promo->time = $updateData['time'];

        if($promo->save()){
            return response([
                'message' => 'Update Promo Success',
                'data' => $promo
            ], 200);
        }
        return response([
            'message' => 'Updated Promo Failed',
            'data' => null,
        ], 400);
    }
}