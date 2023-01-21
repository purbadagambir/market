<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'POS',
            'toko'  => 'Market 001'
        ];
        return view('orders.order', compact('data'));
    }
}
