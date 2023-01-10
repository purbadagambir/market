<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu as MenuModel;

class MenuController extends Controller
{
    public function index()
    {
        $data = [
            'menu'  => MenuModel::all(),
            'page'  => 'Menu',
            'toko'  => 'Market 001'
        ];
        return view('menus.menu', compact('data'));
    }
}
