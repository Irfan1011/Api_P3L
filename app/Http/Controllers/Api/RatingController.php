<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Rating;
use App\Models\Driver;

class RatingController extends Controller
{
    //Fungsi isEmpty
    public function index()
    {
        $rating = Rating::all();

        if(count($rating)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $rating
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    //Menampilkan satu data rating (search)
    public function show($id)
    {
        $rating = Rating::find($id);

        if(!is_null($rating)){
            return response([
                'message' => 'Retrieve Rating Success',
                'data' => $rating
            ], 200);
        }

        return response([
            'message' => 'Rating Not Found',
            'data' => null
        ], 400);
    }

    //Menambahkan satu data rating (create)
    public function store(Request $request)
    {
        $storeData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($storeData, [
            'id_driver'=> 'required',
            'id_customer'=> 'required',
            'rating'=> 'required|numeric',
        ]); //membuat rule validasi input

        if($validate->fails())
            return  response(['message' => $validate->errors()], 400); //return error invalid input

        $rating = Rating::create($storeData);
        return response([
            'message' => 'Add Rating Success',
            'data' => $rating
        ], 200);
    }

    //Menghapus satu data rating (delete)
    public function destroy($id)
    {
        $rating = Rating::find($id); //mencari data berdasarkan id

        if(is_null($rating)){
            return response([
                'message' => 'Rating Not Found',
                'data' => null
            ], 404);
        }

        if($rating->delete()){
            return response([
                'message' => 'Delete Rating Success',
                'data' => $rating
            ], 200);
        }

        return response([
            'message' => 'Delete Rating Failed',
            'data'  => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);//mencari data rating berdasarkan id
        if(is_null($rating)){
            return response([
                'message' => 'Rating Not Found',
                'data' => null
            ], 400);
        }

        $updateData = $request->all(); //mengambil semua input dari api client
        $validate = Validator::make($updateData, [
            'id_driver'=> 'required',
            'id_customer'=> 'required',
            'rating'=> 'required|numeric',
        ]); //membuat rule validasi 

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); //return error invalid input
            
        $rating->id_driver = $updateData['id_driver']; //edit id_driver
        $rating->id_customer = $updateData['id_customer']; //edit id_customer
        $rating->rating = $updateData['rating']; //edit rating
        $rating->date = $updateData['date'];
        $rating->time = $updateData['time'];

        if($rating->save()){
            return response([
                'message' => 'Update Rating Success',
                'data' => $rating
            ], 200);
        }
        return response([
            'message' => 'Updated Rating Failed',
            'data' => null,
        ], 400);
    }

    // public function rerata($id)
    // {
    //     $driver = Driver::find($id);//mencari data driver berdasarkan id
    //     $rating = Rating::find($id);//mencari data rating berdasarkan id

    //     $rate = Rating::select('SELECT rating FROM Rating')->where('id_driver',$id);

    //     $driver->rerata_rating = $updateData['rerata'];

    //     if($rating->save()){
    //         return response([
    //             'message' => 'Update Rerata Success',
    //             'data' => $rating
    //         ], 200);
    //     }
    //     return response([
    //         'message' => 'Updated Rerata Failed',
    //         'data' => null,
    //     ], 400);
    // }
}