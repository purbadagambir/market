<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Box',
            'toko'  => 'Market 001'
        ];
        return view('boxes.index', compact('data'));
    }
}
