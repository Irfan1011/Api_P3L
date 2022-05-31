<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Driver;

class DriverController extends Controller
{
    //Fungsi isEmpty
    public function index()
    {
        $driver = Driver::all();

        if(count($driver)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $driver
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    //Menampilkan satu data driver (search)
    public function show($id)
    {
        $driver = Driver::find($id);

        if(!is_null($driver)){
            return response([
                'message' => 'Retrieve Driver Success',
                'data' => $driver
            ], 200);
        }

        return response([
            'message' => 'Driver Not Found',
            'data' => null
        ], 400);
    }

    //Menambahkan satu data transaksi (create)
    public function store(Request $request)
    {
        $storeData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($storeData, [
            'foto'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama'=> ['required', 'regex:/[\pL\s]+$/'],
            'alamat'=> ['required', 'regex:/[\pL\s\.0-9]+$/'],
            'tanggal_lahir'=> 'required',
            'jenis_kelamin'=> 'required',
            'email'=> 'required|unique:driver|email:rfc',
            'no_telp'=> 'required|numeric|starts_with:08',
            'bahasa'=> 'required',
            'password'=> ['required', 'min:8', Password::min(8)->letters()->mixedCase()->numbers()->symbols()]
        ]); //membuat rule validasi input

        if($validate->fails())
            return  response(['message' => $validate->errors()], 400); //return error invalid input

        $driver = Driver::create($storeData);
        return response([
            'message' => 'Add Driver Success',
            'data' => $driver
        ], 200);
    }

    //Menghapus satu data driver (delete)
    public function destroy($id)
    {
        $driver = Driver::find($id); //mencari data berdasarkan id

        if(is_null($driver)){
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ], 404);
        }

        if($driver->delete()){
            return response([
                'message' => 'Delete Driver Success',
                'data' => $driver
            ], 200);
        }

        return response([
            'message' => 'Delete Driver Failed',
            'data'  => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::find($id);//menbcaru data driver berdasarkan id
        if(is_null($driver)){
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ], 400);
        }

        $updateData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($updateData, [
            'foto'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama'=> ['required', 'regex:/[\pL\s]+$/'],
            'alamat'=> ['required', 'regex:/[\pL\s\.0-9]+$/'],
            'tanggal_lahir'=> 'required',
            'jenis_kelamin'=> 'required',
            'no_telp'=> 'required|numeric|starts_with:08',
            'bahasa'=> 'required',
            'password'=> ['required', 'min:8', Password::min(8)->letters()->mixedCase()->numbers()->symbols()]
        ]); //membuat rule validasi 

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); //return error invalid input
            
        $driver->foto = $updateData['foto']; //edit foto
        $driver->nama = $updateData['nama']; //edit nama
        $driver->alamat = $updateData['alamat']; //edit alamat
        $driver->tanggal_lahir = $updateData['tanggal_lahir']; //edit tanggal_lahir
        $driver->jenis_kelamin = $updateData['jenis_kelamin']; //edit jenis_kelamin
        $driver->no_telp = $updateData['no_telp']; //edit no_telp
        $driver->bahasa = $updateData['bahasa']; //edit bahasa
        $driver->password = $updateData['password']; //edit password
        $driver->date = $updateData['date'];
        $driver->time = $updateData['time'];

        if($driver->save()){
            return response([
                'message' => 'Update Driver Success',
                'data' => $driver
            ], 200);
        }
        return response([
            'message' => 'Updated Driver Failed',
            'data' => null,
        ], 400);
    }
}