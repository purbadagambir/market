<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SharingPointSetting as SharingPointSettingModel;
use DB;

class ApiPoinController extends Controller
{
    public function index(Request $request)
    {
        $query =    DB::table('sharing_point_settings')->orderBy('level_no', 'asc');

        $data_poin = $query->paginate($request->perPage, ['*'], 'page', $request->pageSelect);

        if($data_poin->count() > 0){

            foreach($data_poin as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $data_poin->currentPage(),
                "from" => $data_poin->firstitem(),
                "last_page" => $data_poin->lastPage(),
                "path" => $data_poin->path(),
                "per_page" => $data_poin->perPage(),
                "to" => $data_poin->lastitem(),
                "total" => $data_poin->total()
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

    public function show(Request $request)
    {
        $query = SharingPointSettingModel::where('id', '=', $request->id)->first();

        return $query;
    }

    public function store(Request $request)
    {
        try {
            
            $insert = DB::table('sharing_point_settings')->insert(
                [
                    'level_no'      => $request->level,
                    'percentase'    => $request->percentase,
                    'active'        => $request->active
                ]
            );


            if($insert)
            {
                return $this->response();
            } 
            else 
            {
                return response([
                    "message" => "failed insert data",
                    "status_code" => 500
                 ], 500);
            }
        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function update(Request $request)
    {
        $data_update = [
            'level_no'      => $request->level,
            'percentase'    => $request->percentase,
            'active'        => $request->active
        ];

        $query = SharingPointSettingModel::where('id', $request->id)->update($data_update);

        if($query)
        {
            return $this->response();
        } 
        else 
        {
            return response([
                "message" => "failed update data",
                "status_code" => 500
             ], 500);
        }
    }

    public function delete(Request $request)
    {
        try 
        {
            $delete = DB::table('sharing_point_settings')->delete($request->id);
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
        $query =    DB::table('sharing_point_settings')->orderBy('level_no', 'asc');

        $data_poin = $query->paginate(15, ['*'], 'page', 1);

        

        foreach($data_poin as $list){
            $data[] = $list;
        }

        $meta = [
            "current_page" => $data_poin->currentPage(),
            "from" => $data_poin->firstitem(),
            "last_page" => $data_poin->lastPage(),
            "path" => $data_poin->path(),
            "per_page" => $data_poin->perPage(),
            "to" => $data_poin->lastitem(),
            "total" => $data_poin->total()
        ];

        $response = [
            'data'  => $data,
            'meta'  => $meta,
            'message' => 'success'
        ];

        return response($response, 200);
    }
}
