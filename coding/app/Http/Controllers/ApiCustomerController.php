<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{
    public function index()
    {
        return authapi();
    }

    public function get_member(Request $request)
    {
        $member = Customer::where('customer_mobile', 'like', '%'.$request->keyword.'%')->limit(15)->get();
        
        if(!$member){
            $data = 'not found';
            $metadata['code']           = 201;
            $metadata['message']        = 'Data tidak ditemukan';
        }
        else{
            foreach($member as $list)
            {
                $data[] = 
                array(
                    'id'    => $list->customer_id,
                    'name'  => $list->customer_name,
                    'phone' => $list->customer_mobile,
                    'email' => $list->customer_email,
                );
            }
            $metadata['code']           = 200;
            $metadata['message']        = 'Load berhasil';
        }

        return response([
            'data'      => $data,
            'metadata'  => $metadata
         ], $metadata['code']);
    }
}
