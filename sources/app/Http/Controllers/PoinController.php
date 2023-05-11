<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoinController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Poin',
            'toko'  => session('store')->name
        ];

        return view('poin.poin', compact('data'));
    }
}
