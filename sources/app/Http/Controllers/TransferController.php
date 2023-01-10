<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Catatan Penjualan',
            'toko'  => 'Market 001'
        ];
        return view('mutasi.mutasi', compact('data'));
    }
}
