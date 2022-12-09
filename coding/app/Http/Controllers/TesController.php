<?php

namespace App\Http\Controllers;
use App\Models\Menu as MenuModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TesController extends Controller
{
    public function index()
    {
       $menu = MenuModel::with('children')->get();
         
       return $menu;
    }

    public function tes()
    {
       return view('tes');
    }
}
