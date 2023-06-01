<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\StoreResource;
use App\Models\Store as StoreModel;
use DB;

class ApiStoreController extends Controller
{
    public function index(Request $request)
    {
        $query =    DB::table('stores')->orderBy('created_at', 'asc');

        $data_store = $query->paginate($request->perPage, ['*'], 'page', $request->pageSelect);

        if($data_store->count() > 0){

            foreach($data_store as $list){
                $data[] = $list;
            }
    
            $meta = [
                "current_page" => $data_store->currentPage(),
                "from" => $data_store->firstitem(),
                "last_page" => $data_store->lastPage(),
                "path" => $data_store->path(),
                "per_page" => $data_store->perPage(),
                "to" => $data_store->lastitem(),
                "total" => $data_store->total()
            ];
    
            $response = [
                'data'  => $data,
                'meta'  => $meta,
                'message' => 'success'
            ];

            return response($response, 200);

        }else{
            return response([
                'data'      => null,
                'message'  => 'Data not found'
                ], 201);
        }
    }

    public function store(Request $request)
    {
        $insert = DB::table('stores')->insert(
            [
                'name'                  => $request->name,
                'code_name'             => $request->code_name,
                'mobile'                => $request->mobile,
                'email'                 => $request->email,
                'country'               => 'ID',
                'zip_code'              => $request->zip_code,
                'currency'              => 'IDR',
                'vat_reg_no'            => null,
                'cashier_id'            => $request->cashier,
                'address'               => $request->address,
                'receipt_printer'       => 1,
                'cash_drawer_codes'     => null,
                'char_per_line'         => 42,
                'remote_printing'       => 0,
                'printer'               => null,
                'order_printers'        => null,
                'auto_print'            => 1,
                'local_printers'        => null,
                'logo'                  => null,
                'favicon'               => null,
                'preference'            => 'a:32:{s:10:"gst_reg_no";s:0:"";s:8:"timezone";s:12:"Asia/Jakarta";s:21:"invoice_edit_lifespan";s:4:"1440";s:26:"invoice_edit_lifespan_unit";s:6:"minute";s:23:"invoice_delete_lifespan";s:4:"1440";s:28:"invoice_delete_lifespan_unit";s:6:"minute";s:3:"tax";s:1:"0";s:11:"sms_gateway";s:10:"Clickatell";s:9:"sms_alert";s:1:"0";s:24:"expiring_soon_alert_days";s:0:"";s:20:"datatable_item_limit";s:2:"25";s:16:"reference_format";s:13:"year_sequence";s:22:"sales_reference_prefix";s:0:"";s:16:"receipt_template";s:1:"1";s:12:"invoice_view";s:8:"standard";s:14:"business_state";s:2:"AN";s:31:"change_item_price_while_billing";s:1:"0";s:25:"pos_product_display_limit";s:0:"";s:15:"after_sell_page";s:3:"pos";s:19:"invoice_footer_text";s:0:"";s:10:"email_from";s:13:"Pondo Network";s:13:"email_address";s:27:"noreplay@pondonetwork.co.id";s:12:"email_driver";s:11:"smtp_server";s:14:"send_mail_path";s:0:"";s:9:"smtp_host";s:23:"mail.pondonetwork.co.id";s:13:"smtp_username";s:27:"noreplay@pondonetwork.co.id";s:13:"smtp_password";s:10:"@pondo2022";s:9:"smtp_port";s:3:"465";s:7:"ssl_tls";s:3:"ssl";s:12:"ftp_hostname";s:0:"";s:12:"ftp_username";s:0:"";s:12:"ftp_password";s:0:"";}',
                'sound_effect'          => 1,
                'sort_order'            => 0,
                'feedback_status'       => 'ready',
                'feedback_at'           => null,
                'deposit_account_id'    => 1,
                'thumbnail'             => null,
                'status'                => 1,
                'created_at'            => now(),
                'store_type'            => $request->store_type,
                'map_koordinat'         => $request->koordinat  
            ]
        );


        if($insert)
        {
            return $this->response();
        } 
        else 
        {
            return response([
                "message" => "failed insert data",
                "status_code" => 500
             ], 500);
        }
    }

    public function show(Request $request)
    {
        $query = StoreModel::where('store_id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            'name'          => $request->name,
            'code_name'     => $request->code_name,
            'mobile'        => $request->mobile,
            'email'         => $request->email,
            'zip_code'      => $request->zip_code,
            'cashier_id'    => $request->cashier,
            'address'       => $request->address,
            'store_type'    => $request->store_type,
            'map_koordinat' => $request->koordinat
        ];

        $update = StoreModel::where('store_id', $request->id)->update($data_update);

        if($update)
        {
            $query = StoreModel::paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $store = StoreResource::collection($query);

            return $store;
        } 
        else 
        {
            return response([
                "message" => "failed update data",
                "status_code" => 500
             ], 500);
        }
    }

    public function delete(Request $request)
    {
        try 
        {
            $delete = DB::table('stores')->where('store_id', '=', $request->id)->delete();
            if($delete)
            {
                return $this->response();
            }
            else
            {
                return response([
                    "message" => "error delete data",
                    "status_code" => 500
                 ], 500);
            }
        }
        catch(Exception $e)
        {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function response()
    {
        $query =    DB::table('stores')->orderBy('created_at', 'asc');

        $data_store = $query->paginate(10, ['*'], 'page', 1);

        

        foreach($data_store as $list){
            $data[] = $list;
        }

        $meta = [
            "current_page" => $data_store->currentPage(),
            "from" => $data_store->firstitem(),
            "last_page" => $data_store->lastPage(),
            "path" => $data_store->path(),
            "per_page" => $data_store->perPage(),
            "to" => $data_store->lastitem(),
            "total" => $data_store->total()
        ];

        $response = [
            'data'  => $data,
            'meta'  => $meta,
            'message' => 'success'
        ];

        return response($response, 200);
    }
}
