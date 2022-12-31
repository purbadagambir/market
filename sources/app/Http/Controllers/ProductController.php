<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as ProductModel;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Product',
            'toko'  => 'Market 001'
        ];
        return view('products.index', compact('data'));
    }
}
