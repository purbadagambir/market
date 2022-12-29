<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit as UnitModel;

class UnitController extends Controller
{
    public function index()
    {
        $data = [
            'unit'  => UnitModel::all(),
            'page'  => 'Unit',
            'toko'  => 'Market 001'
        ];
        return view('units.index', compact('data'));
    }
}
