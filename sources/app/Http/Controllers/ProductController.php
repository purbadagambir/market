<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Product',
            'toko'  => 'Market 001'
        ];
        return view('products.product', compact('data'));
    }
}
