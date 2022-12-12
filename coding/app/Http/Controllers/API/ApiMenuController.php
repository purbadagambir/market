<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\MenuResource;
use App\Models\Menu as MenuModel;

class ApiMenuController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = MenuModel::paginate(10);
                $menus = MenuResource::collection($query);

                return $menus;
        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }
}
