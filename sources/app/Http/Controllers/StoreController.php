<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StoreController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Toko',
            'toko'  => session('store')->name,
            'kasir' => DB::table('users')->where('group_id', 2)->get()
        ];

        return view('store.store', compact('data'));
    }
}
