<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductResource;
use App\Models\Product as ProductModel;

class ApiProductController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = ProductModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $product = ProductResource::collection($query);

                return $product;
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
                'product_name'     => $request->product_name,
                'code_name'          => $request->code_name,
                'product_details'      => $request->product_details,
                'status'        => $request->status
            ];

            $insert = ProductModel::create($new_menu);

            if($insert)
            {
                $query = ProductModel::where('Product_name', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $Product = ProductResource::collection($query);

                return $Product;
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
        $query = ProductModel::where('Product_id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {

        $data_update = [
            "Product_name" => $request->Product_name,
            "code_name" => $request->code_name,
            "Product_details" => $request->Product_details,
            "status" => $request->status
        ];

        $query = ProductModel::where('Product_id', $request->id)->update($data_update);

        if($query)
        {
            $query = ProductModel::where('Product_name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $Product = ProductResource::collection($query);

            return $Product;
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
            $result=ProductModel::where('Product_id',$request->id)->delete();
            if($request)
            {
                $query = ProductModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $Product = ProductResource::collection($query);

                return $Product;
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

