<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\ProductToStoreResource;
use App\Models\ProductToStore as ProductToStoreModel;
use App\Models\SellingPrice as SellingPriceModel;
use App\Models\SellingItem as SellingItemModel;
use App\Models\SellingInfo as SellingInfoModel;
use App\Models\SellLog as SellLogModel;
use App\Models\Payment as PaymentModel;
use App\Models\Customer as CustomerModel;
use DB;
use Auth;


class ApiOrderController extends Controller
{

    public function add_orders(Request $request)
    {
        DB::beginTransaction();
            try {
                $store_id = $request->store_id;
                $year = date('Y');
                $last_id = DB::select("SELECT AUTO_INCREMENT 
                                    FROM information_schema.TABLES
                                    WHERE TABLE_SCHEMA = 'modern_pos'
                                    AND TABLE_NAME = 'selling_price'");

                $invoice_number = $store_id.$year.'/'.$last_id[0]->AUTO_INCREMENT;
                

                $selling_price = [
                    'invoice_id'            => $invoice_number,
                    'store_id'              => $store_id,
                    'subtotal'              => $request->total_orders['sum_subtotal_carts'],
                    'discount_type'         => 'plain',
                    'discount_amount'       => $request->total_orders['sum_discont_carts'],
                    'interest_amount'       => 0,
                    'interest_percentage'   => 0,
                    'item_tax'              => 0,
                    'order_tax'             => 0,
                    'cgst'                  => 0,
                    'sgst'                  => 0,
                    'igst'                  => 0,
                    'total_purchase'        => 12000,
                    'shipping_type'         => 'plain',
                    'shipping_amount'       => 0,
                    'orthers_charge'        => 0,
                    'payable_amount'        => 12000,
                    'paid_amount'           => 12000,
                    'due'                   => 0,
                    'due_paid'              => 0,
                    'return_amount'         => 0,
                    'balance'               => 0,
                    'profit'                => 1000,
                    'previous_due'          => 0,
                    'prev_due_paid'         => 0,
                    'total_bruto'           => 0,
                ];
    
                SellingPriceModel::create($selling_price);

                for ($i = 0; $i < count($request->orders); $i++) {
                    $selling_item[] = [
                        'invoice_id'            => $invoice_number,
                        'category_id'           => 1,
                        'brand_id'              => 1,
                        'sup_id'                => 1,
                        'store_id'              => $store_id,
                        'item_id'               => $request->orders[$i]['p_id'],
                        'item_name'             => $request->orders[$i]['p_name'],
                        'item_price'            => $request->orders[$i]['price'],
                        'item_discount'         => 1,
                        'item_tax'              => 1,
                        'tax_method'            => 1,
                        'taxrate_id'            => 1,
                        'tax'                   => 1,
                        'gst'                   => 1,
                        'cgst'                  => 1,
                        'sgst'                  => 1,
                        'igst'                  => 1,
                        'item_quantity'         => $request->orders[$i]['qty'],
                        'item_purchase_price'   => $request->orders[$i]['purchase_price'],
                        'item_total'            => $request->orders[$i]['qty'] * $request->orders[$i]['price'],
                        'purchase_invoice_id'   => 1,
                        'print_counter'         => 1,
                        'print_counter_time'    => null,
                        'printed_by'            => 1,
                        'return_quantity'       => 0,
                        'installment_quantity'  => 1,
                        'created_at'            => now(),
                        'sell_unit_id'          => 1,
                        'sell_vol_unit'         => 1,
                        'sell_qty_conversi'     => 1,
                        'sell_amount'           => 1,
                        'sell_profit'           => 1,
                    ];
                }

                SellingItemModel::insert($selling_item);

                $customer = CustomerModel::where('customer_mobile', $request->customer_mobile)->first();

                $selling_info = [
                    'invoice_id'            => $invoice_number,
                    'edit_counter'          => 0,
                    'inv_type'              => 'sell',
                    'store_id'              => $store_id,
                    'customer_id'           => $customer->customer_id,
                    'customer_mobile'       => $customer->customer_mobile,
                    'ref_invoice_id'        => null,
                    'ref_user_id'           => 0,
                    'invoice_note'          => null,
                    'total_items'           => null,
                    'is_installment'        => 0,
                    'status'                => 1,
                    'pmethod_id'            => null,
                    'payment_status'        => 'paid',
                    'checkout_status'       => 1,
                    'total_points'          => 0,
                    'created_by'            => 1,
                    'created_at'            => now(),
                    'updated_at'            => null,
                ];

                SellingInfoModel::create($selling_info);

                $sell_log = [
                    'customer_id'           => $customer->customer_id,
                    'reference_no'          => null,
                    'ref_invoice_id'        => $invoice_number,
                    'type'                  => 'sell',
                    'pmethod_id'            => 5,
                    'description'           => 'Paid while selling',
                    'amount'                => 5000,
                    'store_id'              => $store_id,
                    'created_by'            => 1,
                    'created_at'            => now(),
                    'updated_at'            => null,
                ];

                SellLogModel::create($sell_log);

                $payment = [
                    'type'                  => 'sell',
                    'is_profit'             => 1,
                    'is_hide'               => 0,
                    'store_id'              => $store_id,
                    'invoice_id'            => $invoice_number,
                    'reference_no'          => null,
                    'pmethod_id'            => 5,
                    'transaction_id'        => null,
                    'capital'               => 1,
                    'amount'                => 5000,
                    'details'               => null,
                    'attachment'            => null,
                    'note'                  => null,
                    'total_paid'            => 5000,
                    'pos_balance'           => 0,
                    'created_by'            => 1,
                    'created_at'            => now(),
                    'balance_to_credit'     => null,
                ];

                PaymentModel::create($payment);

                DB::commit();

                return response([
                    'data'      => $invoice_number,
                    'message'  => 'Success'
                 ], 200);

            } catch (Exception $e) {
                DB::rollback();
                return response([
                    'data'      => 0,
                    'message'  => 'Error'
                 ], 201); 
            }

        return count($request->data);
    }

    public function product_list(Request $request)
    {

        $data_product = DB::table('product_to_store')
                ->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                ->join('units as unit_small', 'products.unit_id', '=', 'unit_small.unit_id')
                ->join('units as unit_medium', 'products.unit_id_medium', '=', 'unit_medium.unit_id')
                ->join('units as unit_large', 'products.unit_id_large', '=', 'unit_large.unit_id')
                ->select('products.p_id', 'products.p_code', 'products.p_name',
                        'product_to_store.sell_price AS sell_price_small',
                        'product_to_store.sell_price_medium', 
                        'product_to_store.sell_price_large',
                        'unit_small.unit_id as unit_small_id',
                        'unit_small.unit_name AS unit_small_name',
                        'unit_medium.unit_id as unit_medium_id',
                        'unit_medium.unit_name AS unit_medium_name',
                        'unit_large.unit_id as unit_large_id',
                        'unit_large.unit_name AS unit_large_name', 
                        )
                ->where('product_to_store.store_id', 5)
                ->limit(8)
                ->get();

        return response([
                'data'      => $data_product,
                'message'  => 'Success'
                ], 200);
    }

    public function product_code(Request $request)
    {
        $data_product = DB::table('product_to_store')
                            ->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                            ->where('product_to_store.store_id', 5)
                            ->where('products.p_code', $request->code)
                            ->get();
        return $data_product;
    }

    public function product_info(Request $request)
    {
        $data_product = DB::table('product_to_store')
                        ->join('products', 'product_to_store.product_id', '=', 'products.p_id')
                        ->join('units as unit_small', 'products.unit_id', '=', 'unit_small.unit_id')
                        ->join('units as unit_medium', 'products.unit_id_medium', '=', 'unit_medium.unit_id')
                        ->join('units as unit_large', 'products.unit_id_large', '=', 'unit_large.unit_id')
                        ->select('products.p_id', 'products.p_code', 'products.p_name',
                                'product_to_store.sell_price AS sell_price_small',
                                'product_to_store.sell_price_medium', 
                                'product_to_store.sell_price_large',
                                'unit_small.unit_id as unit_small_id',
                                'unit_small.unit_name AS unit_small_name',
                                'unit_medium.unit_id as unit_medium_id',
                                'unit_medium.unit_name AS unit_medium_name',
                                'unit_large.unit_id as unit_large_id',
                                'unit_large.unit_name AS unit_large_name', 
                                )
                        ->where('product_to_store.store_id', 5)
                        ->where('products.p_code', $request->code)
                        ->orWhere('products.p_name', $request->code)
                        ->get();
        
        if(!$data_product){
            return response([
                'data'      => 'not found',
                'message'  => 'failed'
                ], 201);
        }

        return $data_product;
        
    }
    
}
