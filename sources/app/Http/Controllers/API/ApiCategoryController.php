<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\CategoryResource;
use App\Models\Category as CategoryModel;
use DB;

class ApiCategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query =    DB::table('categorys')
                    ->join('category_to_store', 'categorys.category_id', '=', 'category_to_store.ccategory_id')
                    ->join('products', 'categorys.category_id', '=', 'products.category_id')
                    ->join('product_to_store', 'products.p_id', '=', 'product_to_store.product_id')
                    ->select(DB::raw('  
                                categorys.category_name, category_to_store.status, categorys.created_at,
                                FLOOR(count(products.category_id)) as jumlah_product
                            '))
                    ->where('category_to_store.store_id', $request->store_id)
                    ->groupBy('categorys.category_name', 'category_to_store.status', 'categorys.created_at');

        $category_list = $query->paginate($request->perPage, ['*'], 'page', $request->pageSelect);

        if($category_list->count() > 0){

            foreach($category_list as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $category_list->currentPage(),
                "from" => $category_list->firstitem(),
                "last_page" => $category_list->lastPage(),
                "path" => $category_list->path(),
                "per_page" => $category_list->perPage(),
                "to" => $category_list->lastitem(),
                "total" => $category_list->total()
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
                'category_name'     => $request->category_name,
                'category_slug'     => $request->category_slug,
                'category_details'  => $request->category_details,
                'status'            => $request->status,
                'short_order'       => $request->short_order,
                'created_at'        => now(),
            ];

            $insert = CategoryModel::create($data_insert);

            if($insert)
            {
                $query = CategoryModel::where('category_name', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $category = CategoryResource::collection($query);

                return $category;
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
        $query = CategoryModel::where('category_id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            'category_name'     => $request->category_name,
            'category_slug'     => $request->category_slug,
            'category_details'  => $request->category_details,
            'status'            => $request->status,
            'short_order'       => $request->short_order,
            'updated_at'        => now(),
        ];

        $query = CategoryModel::where('category_id', $request->id)->update($data_update);

        if($query)
        {
            $query = CategoryModel::where('category_name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $category = CategoryResource::collection($query);

            return $category;
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
            $result=CategoryModel::where('category_id',$request->id)->delete();
            if($request)
            {
                $query = CategoryModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $category = CategoryResource::collection($query);

                return $category;
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
