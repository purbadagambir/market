<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu as MenuModel;

class MenuController extends Controller
{
    public function index()
    {
        $data = [
            'menu'  => MenuModel::all(),
        ];
        return view('menus.tes', compact('data'));
    }

    public function store(Request $request)
    {
        return $request;
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

        if($insert)
        {
            toastr()->success('Data has been saved successfully!', 'Sukses');

            return back();
        }else
        {
            toastr()->error("Data can't saved successfully!", "Gagal");

            return back();
        }
    }
}
