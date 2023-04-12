<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Daftar Transfer',
            'toko'  => session('store')->name,
        ];
        return view('transfer.transfer', compact('data'));
    }
}
