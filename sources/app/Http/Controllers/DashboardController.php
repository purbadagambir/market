<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductToStoreResource;
use App\Models\ProductToStore as ProductToStoreModel;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\Returns as ReturnsModel;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $query_member           = DB::table('customers');
        $query_selling          = DB::table('selling_info')->where('store_id', session('store')->store_id);
        $query_product          = DB::table('product_to_store')->where('store_id', session('store')->store_id);
        $query_supplier         = DB::table('supplier_to_store')->where('store_id', session('store')->store_id);
        $query_supplier_today   = DB::table('suppliers');

        $penjualan              = DB::table('selling_info')
                                ->join('customers', 'selling_info.customer_id', '=', 'customers.customer_id')
                                ->join('sell_logs', 'selling_info.invoice_id', '=', 'sell_logs.ref_invoice_id')
                                ->where('selling_info.store_id', session('store')->store_id)
                                ->where('selling_info.status', 1)
                                ->select('selling_info.info_id', 'selling_info.invoice_id', 'selling_info.created_at', 'selling_info.payment_status', 'customers.customer_name', 'sell_logs.amount')
                                ->orderBy('selling_info.created_at', 'desc')
                                ->limit(5)
                                ->get();

        $pembelian              = DB::table('purchase_info')
                                ->join('suppliers', 'purchase_info.sup_id', '=', 'suppliers.sup_id')
                                ->join('purchase_payments', 'purchase_info.invoice_id', '=', 'purchase_payments.invoice_id')
                                ->where('purchase_info.store_id', session('store')->store_id)
                                ->where('purchase_info.status', 1)
                                ->select('purchase_info.info_id', 'purchase_info.invoice_id', 'purchase_info.created_at', 'purchase_info.payment_status', 'suppliers.sup_name', 'purchase_payments.amount')
                                ->orderBy('purchase_info.created_at', 'desc')
                                ->limit(5)
                                ->get();

        $transfers               = DB::table('transfers')
                                ->join('stores AS from', 'transfers.from_store_id', 'from.store_id')
                                ->join('stores AS to', 'transfers.from_store_id', 'to.store_id')
                                ->where('from.store_id', session('store')->store_id)
                                ->select(
                                            'transfers.created_at', 'transfers.invoice_id',
                                            'from.name AS from_store', 'to.name AS to_store',
                                            'transfers.status', 'transfers.total_quantity AS quantitas',
                                        )
                                ->limit(5)->get();
        
        $customers              = DB::table('customers')
                                ->join('customers AS parent', 'customers.customer_id', '=', 'parent.customer_id')
                                ->select(
                                    'customers.customer_name', 'customers.customer_mobile', 
                                    'customers.customer_address', 'customers.customer_city', 
                                    'parent.customer_name AS sponsor', 
                                    'customers.customer_email', 'customers.created_at')
                                ->orderBy('customers.created_at', 'desc')
                                ->limit(5)
                                ->get();

                                
        $pemasok              = DB::table('suppliers')
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();

        $asset                 = DB::table('product_to_store')
                                ->where('store_id', session('store')->store_id);
        
        $total_assets          = $asset->select(DB::raw("FLOOR(SUM(purchase_price * quantity_in_stock)) as total_asset"))->get();

        foreach($total_assets as $data_asset){
            $total_asset = $data_asset->total_asset;
        }

        $data_assets           =  $asset->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                                        ->select(DB::raw('products.p_name,
                                                        FLOOR(product_to_store.quantity_in_stock) AS stock,   
                                                        FLOOR(product_to_store.purchase_price) AS amount
                                                        '))
                                        ->limit(3)
                                        ->get();

        $data_transaksi        = DB::table('bank_transaction_info')
                                    ->join('bank_transaction_price', 'bank_transaction_info.info_id', 'bank_transaction_price.info_id');
                                    

        $data_deposit           = DB::table('bank_transaction_info')
                                ->join('bank_transaction_price', 'bank_transaction_info.info_id', 'bank_transaction_price.info_id')
                                ->where('bank_transaction_info.transaction_type', 'deposit')
                                ->select(DB::raw('FLOOR(bank_transaction_price.amount) as amount, bank_transaction_info.created_at, bank_transaction_info.title'))
                                ->limit(3)
                                ->orderBy('bank_transaction_info.created_at', 'DESC')
                                ->get();

        $data_withdraw          = DB::table('bank_transaction_info')
                                ->join('bank_transaction_price', 'bank_transaction_info.info_id', 'bank_transaction_price.info_id')
                                ->where('bank_transaction_info.transaction_type', 'withdraw')
                                ->select(DB::raw('FLOOR(bank_transaction_price.amount) as amount, bank_transaction_info.created_at, bank_transaction_info.title'))
                                ->limit(3)
                                ->orderBy('bank_transaction_info.created_at', 'DESC')
                                ->get();

        $data_deposit_today     = DB::table('bank_transaction_info')
                                ->join('bank_transaction_price', 'bank_transaction_info.info_id', 'bank_transaction_price.info_id')
                                ->where('bank_transaction_info.transaction_type', 'deposit')
				->where('bank_transaction_info.store_id', session('store')->store_id)
                                ->whereDate('bank_transaction_info.created_at', date('Y-m-d'))
                                ->select(DB::raw('FLOOR(sum(bank_transaction_price.amount)) as amount'))
                                ->get();
        
        foreach($data_deposit_today as $total_deposit){
            $deposit_today = $total_deposit->amount;
        }

        $data_withdraw_today     = DB::table('bank_transaction_info')
                                ->join('bank_transaction_price', 'bank_transaction_info.info_id', 'bank_transaction_price.info_id')
                                ->where('bank_transaction_info.transaction_type', 'withdraw')
				->where('bank_transaction_info.store_id', session('store')->store_id)
                                ->whereDate('bank_transaction_info.created_at', date('Y-m-d'))
                                ->select(DB::raw('FLOOR(sum(bank_transaction_price.amount)) as amount'))
                                ->get();

        foreach($data_withdraw_today as $total_withdraw){
            $withdraw_today = $total_withdraw->amount;
        }
        

        $data = [
            'page'                  => 'Dashboard',
            'toko'                  => session('store')->name,
            'total_selling'         => number_format(intval(count($query_selling->get()))),
            'total_selling_today'   => number_format(intval(count($query_selling->whereDate('created_at', date('Y-m-d'))->get()))),
            'total_member'          => number_format(intval(count($query_member->get()))),
            'total_member_today'    => number_format(intval(count($query_member->whereDate('created_at', date('Y-m-d'))->get()))),
            'total_supplier'        => number_format(intval(count($query_supplier->get()))),
            'total_supplier_today'  => number_format(intval(count($query_supplier_today->whereDate('created_at', date('Y-m-d'))->get()))),
            'total_product'         => number_format(intval(count($query_product->where('status', 1)->get()))),
            'total_product_today'   => number_format(intval(count($query_product->where('status', 1)->whereDate('p_date', date('Y-m-d'))->get()))),
            'penjualan'             => $penjualan,
            'pembelian'             => $pembelian,
            'transfers'             => $transfers,
            'customers'             => $customers,
            'pemasok'               => $pemasok,
            'total_asset'           => number_format(intval($total_asset)),
            'data_asset'            => $data_assets,
            'deposit_today'         => number_format(intval($deposit_today)),
            'withdraw_today'        => number_format(intval($withdraw_today)),
            'deposit'               => $data_deposit,
            'withdraw'              => $data_withdraw
        ];

        return view('dashboard.dashboard', compact('data'));

    }

    public function monitoring()
    {
        

        $store = DB::table('stores')->get();

        $data = [
            'page'  => 'Monitoring',
            'toko'  => session('store')->name,
            'stores'  => $store
        ];

        return view('dashboard.monitoring', compact('data'));
    }

    public function dashboard_member()
    {
        $data_member = DB::table('customers')->get();
        $data_member_aktif = DB::table('customers')->where('status_frontend', 1)->get();
        
        $query_point = DB::table('customers')
                    ->select(DB::raw("FLOOR(SUM(total_points)) as total_point"))
                    ->get();

        $query_balance = DB::table('customer_transactions')
                    ->where('notes', 'Points To Credits')
                    ->select(DB::raw("FLOOR(SUM(amount)) as total_balance"))
                    ->get();
        
        foreach($query_point as $point){
            $data_point = $point->total_point;
        }

        foreach($query_balance as $balance){
            $data_balance = $balance->total_balance;
        }

        $data_member_point = DB::table('customers')->offset(0)->limit(20)->orderBy('total_points', 'DESC')->get();
        $data_activity_member = DB::table('customer_transactions')
                                    ->join('customers', 'customer_transactions.customer_id', '=', 'customers.customer_id')
                                    ->select('customers.customer_name','customers.customer_mobile', 'customer_transactions.customer_id', DB::raw('count(*) as total'))
                                    ->groupBy('customers.customer_name', 'customers.customer_mobile', 'customer_transactions.customer_id')
                                    ->orderBy('total', 'DESC')
                                    ->offset(0)->limit(20)
                                    ->get();


        $data = [
            'page'                  => 'Dashboard Member',
            'toko'                  => session('store')->name,
            'total_member'          => number_format(intval(count($data_member))),
            'total_member_aktif'    => number_format(intval(count($data_member_aktif))),
            'total_point'           => number_format(intval($data_point)),
            'total_balance'         => number_format(intval($data_balance)),
            'data_member'           => $data_member_point,
            'data_activity_member'  => $data_activity_member,
        ];

        return view('dashboard.dashboard_member', compact('data'));
    }

    public function tes()
    {   
        $id = 46;
        $count_sum  =   DB::table('customers')
                        ->leftJoin('customers as l_2', 'customers.parent_id', '=', 'l_2.customer_id')
                        ->select('customers.customer_id AS l_1', 'l_2.customer_id AS l_2')
                        ->where('l_2.customer_id', '=', $id)
                        ->get();



        return DB::table('customers')->where('customer_id', 2)->get();
    }
}
