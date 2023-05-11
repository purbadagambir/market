<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu as MenuModel;
use DB;

class MenuController extends Controller
{
    public function index()
    {
        $data = [
            'menu'  => MenuModel::all(),
            'page'  => 'Menu',
            'toko'  => session('store')->name
        ];
        return view('menus.menu', compact('data'));
    }

    public function group_menu()
    {
        $group_user = DB::table('user_group')->get();
        $menu       = MenuModel::with('children')
                        ->where('type', 'MAIN_MENU')
                        ->where('status', 1)
                        ->orderBy('short_order', 'ASC')
                        ->get();

        $data = [
            'menu'  => $menu,
            'page'  => 'Group Setting Menu',
            'toko'  => session('store')->name,
            'group' => $group_user
        ];
        return view('menus.group_menu', compact('data'));
    }
}
