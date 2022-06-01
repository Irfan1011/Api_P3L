<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    //Fungsi isEmpty
    public function index()
    {
        $transaksi = Transaksi::all();

        if(count($transaksi)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    //Menampilkan satu data transaksi (search)
    public function show($id)
    {
        $transaksi = Transaksi::find($id);

        if(!is_null($transaksi)){
            return response([
                'message' => 'Retrieve Transaction Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Transaction Not Found',
            'data' => null
        ], 400);
    }

    //Menambahkan satu data transaksi (create)
    public function store(Request $request)
    {
        $storeData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($storeData, [
            'no_ktp_customer'=>'required|numeric',
            'no_sim_customer'=>['required', 'regex:/[0-9\-]+$/'],
            'tanggal_transaksi'=> 'required',
            'tanggal_waktu_mulai_sewa'=> 'required',
            'tanggal_waktu_selesai_sewa'=> 'required',
            'mobil_yang_disewa'=> ['required', 'regex:/[\pL\s]+$/'],
            'no_plat_mobil'=>['required', 'regex:/[\pL\s.0-9]+$/'],
            'harga_sewa_harian'=>'required|numeric',
            'metode_pembayaran'=>'required',
            'ekstensi_peminjaman'=> 'required|numeric'
        ]); //membuat rule validasi input

        if($validate->fails())
            return  response(['message' => $validate->errors()], 400); //return error invalid input

        $transaksi = Transaksi::create($storeData);
        return response([
            'message' => 'Add Transaction Success',
            'data' => $transaksi
        ], 200);
    }

    //Menghapus satu data transaksi (delete)
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id); //mencari data berdasarkan id

        if(is_null($transaksi)){
            return response([
                'message' => 'Transaction Not Found',
                'data' => null
            ], 404);
        }

        if($transaksi->delete()){
            return response([
                'message' => 'Delete Transaction Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Delete Transaction Failed',
            'data'  => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);//menbcaru data transaksi berdasarkan id
        if(is_null($transaksi)){
            return response([
                'message' => 'Transaction Not Found',
                'data' => null
            ], 400);
        }

        $updateData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($updateData, [
            'no_ktp_customer'=>'required|numeric',
            'no_sim_customer'=>['required', 'regex:/[0-9\-]+$/'],
            'tanggal_transaksi'=> 'required',
            'tanggal_waktu_mulai_sewa'=> 'required',
            'tanggal_waktu_selesai_sewa'=> 'required',
            'mobil_yang_disewa'=> ['required', 'regex:/[\pL\s]+$/'],
            'no_plat_mobil'=>['required', 'regex:/[\pL\s.0-9]+$/'],
            'harga_sewa_harian'=>'required|numeric',
            'metode_pembayaran'=>'required',
            'ekstensi_peminjaman'=> 'required|numeric'
        ]); //membuat rule validasi 

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); //return error invalid input
            
        $transaksi->no_ktp_customer = $updateData['no_ktp_customer']; //edit no_ktp_customer
        $transaksi->no_sim_customer = $updateData['no_sim_customer']; //edit no_sim_customer
        $transaksi->tanggal_transaksi = $updateData['tanggal_transaksi']; //edit tanggal_transaksi
        $transaksi->tanggal_waktu_mulai_sewa = $updateData['tanggal_waktu_mulai_sewa']; //edit tanggal_waktu_mulai_sewa
        $transaksi->tanggal_waktu_selesai_sewa = $updateData['tanggal_waktu_selesai_sewa']; //edit tanggal_waktu_selesai_sewa
        $transaksi->mobil_yang_disewa = $updateData['mobil_yang_disewa']; //edit mobil_yang_disewa
        $transaksi->no_plat_mobil = $updateData['no_plat_mobil']; //edit no_plat_mobil
        $transaksi->harga_sewa_harian = $updateData['harga_sewa_harian']; //edit harga_sewa_harian
        $transaksi->metode_pembayaran = $updateData['metode_pembayaran']; //edit metode_pembayaran
        $transaksi->ekstensi_peminjaman = $updateData['ekstensi_peminjaman']; //edit ekstensi_peminjaman

        if($transaksi->save()){
            return response([
                'message' => 'Update Transaction Success',
                'data' => $transaksi
            ], 200);
        }
        return response([
            'message' => 'Updated Transaction Failed',
            'data' => null,
        ], 400);
    }

    // public function topDriver()
    // {
    //     $topDriver = Transaksi::select('SELECT TOP 5 nama_driver FROM Transaksi');

    //     if(!is_null($topDriver)){
    //         return response([
    //             'message' => 'Retrieve Top Driver Success',
    //             'data' => $topDriver
    //         ], 200);
    //     }

    //     return response([
    //         'message' => 'Top Driver Not Found',
    //         'data' => null
    //     ], 400);
    // }
}