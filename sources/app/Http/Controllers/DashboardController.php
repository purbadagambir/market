<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Dashboard',
            'toko'  => 'Market 001'
        ];
        return view('dashboard.v_dashboard', compact('data'));
    }
}
