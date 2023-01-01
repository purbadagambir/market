<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\CurencyResource;
use App\Models\Currency as CurencyModel;

class ApiCurencyController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = CurencyModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $curency = CurencyResource::collection($query);

                return $curency;
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
                'title'        => $request->title,
                'code'         => $request->code,
                'symbol_left'     => $request->symbol_left,
                'symbol_right'     => $request->symbol_right,
                'decimal_place'     => $request->decimal_place,
                'status'            => $request->status,
                'short_order'       => $request->short_order,
                'created_at'        => now(),
            ];

            $insert = CurencyModel::create($data_insert);

            if($insert)
            {
                $query = CurencyModel::where('title', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $curency = CurencyResource::collection($query);

                return $curency;
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
        $query = CurencyModel::where('currency_id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {

        $data_update = [
            'title'             => $request->title,
            'code'              => $request->code,
            'symbol_left'       => $request->symbol_left,
            'symbol_right'      => $request->symbol_right,
            'decimal_place'     => $request->decimal_place,
            'status'            => $request->status,
            'short_order'       => $request->short_order
        ];

        $query = CurencyModel::where('currency_id', $request->id)->update($data_update);

        if($query)
        {
            $query = CurencyModel::where('title', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $curency = CurencyResource::collection($query);

            return $curency;
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
            $result=CurencyModel::where('currency_id',$request->id)->delete();
            if($request)
            {
                $query = CurencyModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $curency = CurencyResource::collection($query);

                return $curency;
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
