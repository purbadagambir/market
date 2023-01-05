<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Category',
            'toko'  => 'Market 001'
        ];
        return view('category.category', compact('data'));
    }
}
