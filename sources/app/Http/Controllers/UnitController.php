<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Unit',
            'toko'  => 'Market 001'
        ];
        return view('units.unit', compact('data'));
    }
}
