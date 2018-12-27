<?php

namespace App\Http\Controllers;

use App\ModelTodo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class todoController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }

    //get all data
    public function index(){
        $data = ModelTodo::all();
        // return response($data);

        if ($data) {
            $res['kode'] = 1;
            $res['status'] = true;
            $res['message'] = $data;

            return response($res);

        }else{
            $res['kode'] = 0;
            $res['status'] = false;
            $res['result'] = 'cannot find user !';

            return response ($res);
        }

    }
    //GET by id 
    public function show($id){
        $data = ModelTodo::where('id',$id)->get();
        if ($data) {
            $res['kode'] = 1;            
            $res['status'] = true;
            $res['result'] = $data;

            return response($res);

        }else{
            $res['kode'] = 0;
            $res['status'] = false;
            $res['result'] = 'cannot find user !';

            return response ($res);
        }

    }

    //POST
    public function store (Request $request){
        try{

        $data = new ModelTodo();
        $data->activity = $request->input('activity');
        $data->description = $request->input('description');
        $data->save();

        $res['kode'] = 1;
        $res['result'] = 'Berhasil menambah data';
        return response($res, 200);
    }catch (\Illuminate\Database\QueryException $ex) {
        $res['status'] = false;
        $res['message'] = $ex->getMessage();
        return response($res, 500);
    }
}



    //update
    public function update(Request $request, $id){
        try {
            $data = ModelTodo::where('id',$id)->first();
            $data->activity = $request->input('activity');
            $data->description = $request->input('description');
            $data->save();

            $res['kode'] = 1;
            $res['status'] = true;
            $res['result'] = 'Berhasil update data';
            return response($res, 200);
            
            // return response('Berhasil Merubah Data');
        }catch (\Illuminate\Database\QueryException $ex) {
            $res['kode'] = 0;
            $res['status'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }

    }
    
    //delete
    public function destroy($id){
            $data = ModelTodo::where('id',$id)->first();
            $data->delete();
    
            $res['kode'] = 1;
            $res['status'] = true;
            $res['result'] = 'Berhasil hapus data';
            return response($res, 200);
            //return response('Berhasil Menghapus Data');
    

    }
}

//JSONNYA gini
// {
//     kode = 1;
//     status = true;
//     result = Berhasil hapus data
// }

// {
//     "kode": 1,
//     "status": true,
//     "message": [
//         {
//             "id": 2,
//             "activity": "ngoding",
//             "description": "uas",
//             "created_at": "2018-12-25 19:45:44",
//             "updated_at": "2018-12-25 19:45:44"
//         }
//     ]
// }


//tambahkan oAuth key
// https://seegatesite.com/restful-api-tutorial-with-lumen-laravel-5-5-for-beginners/