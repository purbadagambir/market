<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurencyController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Curency',
            'toko'  => 'Market 001'
        ];
        return view('curency.index', compact('data'));
    }
}
