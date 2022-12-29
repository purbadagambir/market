<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\UnitResource;
use App\Models\Unit as UnitModel;

class ApiUnitController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = UnitModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $unit = UnitResource::collection($query);

                return $unit;
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
            
            $new_menu = [
                'unit_name'     => $request->unit_name,
                'code_name'          => $request->code_name,
                'unit_details'      => $request->unit_details,
                'status'        => $request->status
            ];

            $insert = UnitModel::create($new_menu);

            if($insert)
            {
                $query = UnitModel::where('unit_name', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $unit = UnitResource::collection($query);

                return $unit;
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
        $query = UnitModel::where('unit_id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {

        $data_update = [
            "unit_name" => $request->unit_name,
            "code_name" => $request->code_name,
            "unit_details" => $request->unit_details,
            "status" => $request->status
        ];

        $query = UnitModel::where('unit_id', $request->id)->update($data_update);

        if($query)
        {
            $query = UnitModel::where('unit_name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $unit = UnitResource::collection($query);

            return $unit;
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
            $result=UnitModel::where('unit_id',$request->id)->delete();
            if($request)
            {
                $query = UnitModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $unit = UnitResource::collection($query);

                return $unit;
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


