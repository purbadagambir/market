<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Penjualan',
            'toko'  => 'Market 001'
        ];
        return view('sell.sell_list', compact('data'));
    }

    public function return_list()
    {
        $data = [
            'page'  => 'Pengembalian',
            'toko'  => 'Market 001'
        ];
        return view('sell.return_list', compact('data'));
    }

    public function sell_log()
    {
        $data = [
            'page'  => 'Catatan Penjualan',
            'toko'  => 'Market 001'
        ];
        return view('sell.sell_log', compact('data'));
    }
}
