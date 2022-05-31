<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Nota;

class NotaController extends Controller
{
    //Fungsi isEmpty
    public function index()
    {
        $nota = Nota::all();

        if(count($nota)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $nota
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    //Menambahkan satu data rating (create)
    public function store(Request $request)
    {
        $storeData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($storeData, [
            'tanggal_nota'=> 'required',
            'tanggal_pengembalian'=> 'required',
            'nomor_transaksi_nota'=> 'required',
            'nama_customer'=> 'required',
            'nama_CS'=> 'required',
            'nama_driver'=> 'required',
            'promo'=> 'required',
            'tanggal_mulai'=> 'required',
            'tanggal_selesai'=> 'required',
            'nama_mobil'=> 'required',
            'harga_satuan_mobil'=> 'required',
            'harga_satuan_driver'=> 'required',
            'sub_total_mobil'=> 'required',
            'sub_total_driver'=> 'required',
            'denda'=> 'required',
            'total'=> 'required',
        ]); //membuat rule validasi input

        if($validate->fails())
            return  response(['message' => $validate->errors()], 400); //return error invalid input

        $nota = Nota::create($storeData);
        return response([
            'message' => 'Add Nota Success',
            'data' => $nota
        ], 200);
    }
}