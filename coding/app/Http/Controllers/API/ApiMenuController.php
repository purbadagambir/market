<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\MenuResource;
use App\Models\Menu as MenuModel;

class ApiMenuController extends Controller
{
    public function tes()
    {

        $query = MenuModel::all();
        $menus = MenuResource::collection($query);

        // foreach($query as $menu){
        //     $menus[] = [$menu->id, $menu->label, $menu->route, $menu->icon, $menu->status==true ? 'active' : 'unactive'];
        // }

        return $menus;

    }
    public function index(Request $request)
    {
        try {
                $query = MenuModel::select('id', 'parent_id', 'label', 'type', 'route', 'icon', 'status')
                                    ->get();
                $menus = MenuResource::collection($query);
        
                // foreach($query as $menu){
                //     $menus[] = [$menu->id, $menu->label, $menu->route, $menu->icon, $menu->status==true ? 'active' : 'unactive'];
                // }
        
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

    public function store (Request $request)
    {
        try {
            if($request->type == 'MAIN_MENU')
            {
                $code_key = 'MM';
            }
            elseif($request->type == 'SUB_MENU')
            {
                $code_key = 'SM';
            }
            else {
                $code_key = 'A';
            }

            $str = $request->label;
            $capital = strtoupper($str);
            $menu_key = str_replace(" ", "_", $capital);

            $new_menu = [
                'parent_id'     => $request->parent_id,
                'type'          => $request->type,
                'menu_key'      => $menu_key,
                'label'         => $request->label,
                'route'         => $request->link,
                'icon'          => $request->icon,
                'short_order'   => $request->short_order,
                'status'        => $request->status,
                'created_at'    => now(),
            ];

            $insert = MenuModel::create($new_menu);

            $query = MenuModel::all();
            $menus = MenuResource::collection($query);

            if($insert)
            {
                return response([
                    "message" => 'Menu baru telah ditambah',
                    "data"  => $menus,
                    "status_code" => 200
                ]);
            } 
            else 
            {
                return response([
                    "message" => 'Menu gagal ditambah',
                    "data"  => null,
                    "status_code" => 201
                ]);
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
}
