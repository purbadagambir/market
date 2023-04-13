<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Daftar Supplier',
            'toko'  => session('store')->name,
        ];
        return view('supplier.supplier', compact('data'));
    }
}
