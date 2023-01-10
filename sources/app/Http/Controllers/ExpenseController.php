<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory as ExpenseCategoryModel;

class ExpenseController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Expense',
            'toko'  => 'Market 001'
        ];
        return view('expense.expense', compact('data'));
    }

    public function category()
    {
        $data = [
            'page'  => 'Expense Category',
            'toko'  => 'Market 001'
        ];
        return view('expense.expense_category', compact('data'));
    }

    public function monthwise()
    {
        $kalender = CAL_GREGORIAN;
        $bulan = date('m');
        $tahun = date('Y');
        $hari = cal_days_in_month($kalender, $bulan, $tahun);

        for($x=1;$x<=$hari;$x++){
           $tanggal[] = $x;
        }

        $data = [
            'page'  => 'Expense Monthwise',
            'toko'  => 'Market 001',
            'category' => ExpenseCategoryModel::all(),
            'tanggal'   => $tanggal,
        ];
        return view('expense.expense_monthwise', compact('data'));
    }
}
