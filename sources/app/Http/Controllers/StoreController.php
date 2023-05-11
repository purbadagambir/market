<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Toko',
            'toko'  => session('store')->name
        ];

        return view('store.store', compact('data'));
    }
}
