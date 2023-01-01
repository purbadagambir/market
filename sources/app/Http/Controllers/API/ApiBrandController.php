<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\BrandResource;
use App\Models\Brand as BrandModel;

class ApiBrandController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = BrandModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $brand = BrandResource::collection($query);

                return $brand;
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
                'brand_name'        => $request->brand_name,
                'code_name'         => $request->code_name,
                'brand_details'     => $request->brand_details,
                'status'            => $request->status,
                'short_order'       => $request->short_order,
                'created_at'        => now(),
            ];

            $insert = BrandModel::create($data_insert);

            if($insert)
            {
                $query = BrandModel::where('brand_name', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $brand = BrandResource::collection($query);

                return $brand;
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
        $query = BrandModel::where('brand_id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {

        $data_update = [
            "brand_name"        => $request->brand_name,
            "code_name"         => $request->code_name,
            "brand_details"     => $request->brand_details,
            "status"            => $request->status,
            "short_order"       => $request->short_order,
            "updated_at"        => now(),
        ];

        $query = BrandModel::where('brand_id', $request->id)->update($data_update);

        if($query)
        {
            $query = BrandModel::where('brand_name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $brand = BrandResource::collection($query);

            return $brand;
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
            $result=BrandModel::where('brand_id',$request->id)->delete();
            if($request)
            {
                $query = BrandModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $brand = BrandResource::collection($query);

                return $brand;
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
