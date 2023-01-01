<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\BoxResource;
use App\Models\Boxes as BoxModel;

class ApiBoxController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = BoxModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $box = BoxResource::collection($query);

                return $box;
        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function store (Request $request)
    {
        try {
            
            $data_insert = [
                'box_name'     => $request->box_name,
                'code_name'          => $request->code_name,
                'box_details'      => $request->box_details,
                'status'        => $request->status,
                'short_order'        => $request->short_order
            ];

            $insert = BoxModel::create($data_insert);

            if($insert)
            {
                $query = BoxModel::where('box_name', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $box = BoxResource::collection($query);

                return $box;
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

    public function show(Request $request)
    {
        $query = BoxModel::where('box_id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            "box_name"      => $request->box_name,
            "code_name"     => $request->code_name,
            "box_details"   => $request->box_details,
            "status"        => $request->status,
            "short_order"   => $request->short_order
        ];

        $query = BoxModel::where('box_id', $request->id)->update($data_update);

        if($query)
        {
            $query = BoxModel::where('box_name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $box = BoxResource::collection($query);

            return $box;
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
            $result=BoxModel::where('box_id',$request->id)->delete();
            if($request)
            {
                $query = BoxModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $box = BoxResource::collection($query);

                return $box;
            }
            else
            {
                return response([
                    "message" => "failed insert data",
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
}
