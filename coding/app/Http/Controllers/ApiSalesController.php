<?php

namespace App\Http\Controllers;

use App\{Sales,PointLogs,Customer};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApiSalesController extends Controller
{
    public function tes()
    {
        $age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

        $tes = json_encode($age);

        $balik = json_decode($tes, true);

        // return $balik['Peter'];

        $pegawai = ["direktur" => "Budi",
			"manajer" => "Shinta",
			"pemasaran" => "Anton"];
            foreach ($pegawai as $nama){
                $data[] = $nama;
            }

            // return $pegawai['direktur'];

            for ($i= 1; $i <= 2; $i++) 
            { 
                echo $i-1;
            } 
    }

    public function getSalesInfo(Request $request)
    {
        $invoice = json_decode($request,true);
        $sales_Info = Sales::where('invoice_id',$invoice)->get();
        if(!$sales_Info){
            $metadata['Code']='201';
            $metadata['Message']='Data tidak ditemukan.';
            $data = null;
        }else {
            $metadata['Code']='200';
            $metadata['Message']='Ok' . $invoice->content;
            $data = $sales_Info;
        }
        return response(['metadata'=>$metadata,'data'=>$data]);
    }

   public function PostSalesData(Request $request)
   {
    return $request->customer;
    $input = $request->all();
    $validator = Validator::make($input,['order_number'=>'required',
                                         'store_id'=>'required',
                                         'customer_id'=>'required',
                                         'sale_amount_subtotal_excluding_tax'=>'required',
                                         'purchase_amount_subtotal_excluding_tax'=>'required',
                                         'total_after_discount'=>'required',
                                         'total_order_amount_rounded'=>'required']);

    if($validator->passes()){
        try {
            DB::beginTransaction();
            $total_points = ($input['total_after_discount'] - $input['purchase_amount_subtotal_excluding_tax']) * 0.2;
            DB::table('selling_info')->insert(['invoice_id'=>$input['order_number'],
                                                'store_id'=>$input['store_id'],
                                                'customer_id'=>$input['customer_id'],
                                                'total_points'=>$total_points,
                                                'created_at'=>date('Y-m-d h:i:s')]);

            DB::table('selling_price')->insert(['invoice_id'=>$input['order_number'],
                                                'store_id'=>$input['store_id'],
                                                'total_purchase_price'=>$input['purchase_amount_subtotal_excluding_tax'],
                                                'payable_amount'=>$input['total_order_amount_rounded'],
                                                'paid_amount'=>$input['total_order_amount_rounded'],
                                                'total_brutto'=>$input['total_after_discount'],
                                                'profit'=>$input['total_after_discount'] - $input['purchase_amount_subtotal_excluding_tax']]);

            DB::select('call sp_calc_sharing_point(?,?)', [$input['order_number'],'sell']);


            $point = PointLogs::where('trans_no',$input['order_number'])
                                ->where('customer_id',$input['customer_id'])
                                ->get();
            
            DB::commit();

            $headers['Code']='200';
            $headers['Message']='Ok';
            $data= $point;
            return response(['metadata'=>$headers,'data'=>$data]);

        } catch (\Throwable $th) {
            DB::rollback();
            $headers['Code']='201';
            $headers['Message']='Error : '.$th->getMessage();;
            $data= $input['order_number']. ' Error Insert';
            return response(['metadata'=>$headers,'data'=>$data]);
        }
    } else {
        $headers['Code']='201';
        $headers['Message']='Not Valid Request data'; 
        $data=null;   
        return response(['metadata'=>$headers,'data'=>$data]);    
    }
   } 
}
