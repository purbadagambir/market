<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Brand',
            'toko'  => 'Market 001'
        ];
        return view('brands.brand', compact('data'));
    }
}
