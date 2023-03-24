<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer as CustomerModel;
use DB;
use App\Models\ProductToStore as ProductToStoreModel;
use App\Models\SellingPrice as SellingPriceModel;
use App\Models\SellingItem as SellingItemModel;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\SellLog as SellLogModel;
use App\Models\Payment as PaymentModel;

class OrderController extends Controller
{
    public function index()
    {
        $store_id = session('store')->store_id;
        $store_name = session('store')->name;
        $pmethod = DB::table('pmethod_to_store')
                        ->join('pmethods', 'pmethod_to_store.ppmethod_id', '=', 'pmethods.pmethod_id')
                        ->where('pmethod_to_store.store_id', $store_id)
                        ->get();
        $data = [
            'page'  => 'POS',
            'toko'  => $store_name,
            'members' => CustomerModel::limit(10)->get(),
            'pmethod' => $pmethod,
        ];
        return view('orders.order', compact('data'));
    }

    public function print()
    {
        $invoice_id = $_GET['number'];

        $data_invoice = DB::table('selling_item')
                            ->join('units', 'selling_item.sell_unit_id', '=', 'units.unit_id')
                            ->where('selling_item.invoice_id', $invoice_id)
                            ->get();
<<<<<<< HEAD

=======
>>>>>>> eb18e0b1 (invoice number)
        $data_order = DB::table('selling_info')
                            ->join('customers', 'selling_info.customer_id', '=', 'customers.customer_id')
                            ->join('point_logs', 'selling_info.invoice_id', '=', 'point_logs.trans_no')
                            ->join('users', 'selling_info.created_by', '=', 'users.id')
                            ->join('pmethods', 'selling_info.pmethod_id', '=', 'pmethods.pmethod_id')
                            ->join('stores', 'selling_info.store_id', '=', 'stores.store_id')
                            ->where('selling_info.invoice_id', $invoice_id)
                            ->select('selling_info.invoice_id AS invoice_id',
                                    'selling_info.created_at AS tanggal', 
                                    'customers.customer_address AS alamat',
                                    'customers.customer_name AS member',
                                    'point_logs.point AS poin', 
                                    'point_logs.new_point AS jumlah_poin',
                                    'users.username AS kasir',
                                    'pmethods.name AS p_method',
                                    'stores.email AS store_email',
                                    'stores.mobile AS store_mobile',
                                    'stores.address AS store_address')
                            ->first();

        $data_price = SellingPriceModel::where('invoice_id', $invoice_id)->first();
        $data_payment = PaymentModel::where('invoice_id', $invoice_id)->first();
        
        $data = [
            'page'      => 'Invoice',
            'toko'      => $invoice_id,
            'invoice'   => $data_invoice,
            'order'     => $data_order,
            'price'     => $data_price,
            'payment'     => $data_payment,
        ];

        return view('orders.print', compact('data'));
    }

    public function struk()
    {
        $invoice_id = $_GET['number'];

        // $data_invoice = SellingItemModel::where('invoice_id', $invoice_id)->get();
        $data_invoice = DB::table('selling_item')
                            ->join('units', 'selling_item.sell_unit_id', '=', 'units.unit_id')
                            ->where('selling_item.invoice_id', $invoice_id)
                            ->get();

                            $data_order = DB::table('selling_info')
                            ->join('customers', 'selling_info.customer_id', '=', 'customers.customer_id')
                            ->join('point_logs', 'selling_info.invoice_id', '=', 'point_logs.trans_no')
                            ->join('users', 'selling_info.created_by', '=', 'users.id')
                            ->join('pmethods', 'selling_info.pmethod_id', '=', 'pmethods.pmethod_id')
                            ->join('stores', 'selling_info.store_id', '=', 'stores.store_id')
                            ->where('selling_info.invoice_id', $invoice_id)
                            ->select('selling_info.invoice_id AS invoice_id',
                                    'selling_info.created_at AS tanggal', 
                                    'customers.customer_address AS alamat',
                                    'customers.customer_name AS member',
                                    'point_logs.point AS poin', 
                                    'point_logs.new_point AS jumlah_poin',
                                    'users.username AS kasir',
                                    'pmethods.name AS p_method',
                                    'stores.email AS store_email',
                                    'stores.mobile AS store_mobile',
                                    'stores.address AS store_address')
                            ->first();

        $data_price = SellingPriceModel::where('invoice_id', $invoice_id)->first();
        $data_payment = PaymentModel::where('invoice_id', $invoice_id)->first();
        
        $data = [
            'page'      => 'Invoice',
            'toko'      => $invoice_id,
            'invoice'   => $data_invoice,
            'order'     => $data_order,
            'price'     => $data_price,
            'payment'     => $data_payment,
        ];

        return view('orders.struk', compact('data'));
    }
}
