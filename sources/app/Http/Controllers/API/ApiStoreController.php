<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SharingPointSetting as SharingPointSettingModel;
use DB;

class ApiStoreController extends Controller
{
    public function index(Request $request)
    {
        $query =    DB::table('stores')->orderBy('created_at', 'asc');

        $data_store = $query->paginate($request->perPage, ['*'], 'page', $request->pageSelect);

        if($data_store->count() > 0){

            foreach($data_store as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $data_store->currentPage(),
                "from" => $data_store->firstitem(),
                "last_page" => $data_store->lastPage(),
                "path" => $data_store->path(),
                "per_page" => $data_store->perPage(),
                "to" => $data_store->lastitem(),
                "total" => $data_store->total()
            ];
    
            $response = [
                'data'  => $data,
                'meta'  => $meta,
                'message' => 'success'
            ];

            return response($response, 200);

        }else{
            return response([
                'data'      => null,
                'message'  => 'Data not found'
                ], 201);
        }
    }

    public function delete(Request $request)
    {
        try 
        {
            $delete = DB::table('stores')->where('store_id', '=', $request->id)->delete();
            if($delete)
            {
                return $this->response();
            }
            else
            {
                return response([
                    "message" => "error delete data",
                    "status_code" => 500
                 ], 500);
            }
        }
        catch(Exception $e)
        {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function response()
    {
        $query =    DB::table('stores')->orderBy('created_at', 'asc');

        $data_store = $query->paginate(10, ['*'], 'page', 1);

        

        foreach($data_store as $list){
            $data[] = $list;
        }

        $meta = [
            "current_page" => $data_store->currentPage(),
            "from" => $data_store->firstitem(),
            "last_page" => $data_store->lastPage(),
            "path" => $data_store->path(),
            "per_page" => $data_store->perPage(),
            "to" => $data_store->lastitem(),
            "total" => $data_store->total()
        ];

        $response = [
            'data'  => $data,
            'meta'  => $meta,
            'message' => 'success'
        ];

        return response($response, 200);
    }
}
