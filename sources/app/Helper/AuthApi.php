<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use App\Models\Menu as MenuModel;

    function authapi()
    {
        $date = date_create();

        $key = 'restfull-api-pondo';
        $payload = [
            'iss'       => 'pondo.co.id',
            'cons_id'   => 'mrpondofr',
            'timestamp' => date_timestamp_get($date)
        ];

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($payload, $key, 'HS256');
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        return json_encode($decoded);
        /*
        NOTE: This will now be an object instead of an associative array. To get
        an associative array, you will need to cast it as such:
        */

        $decoded_array = (array) $decoded;


        /**
         * You can add a leeway to account for when there is a clock skew times between
         * the signing and verifying servers. It is recommended that this leeway should
         * not be bigger than a few minutes.
         *
         * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
         */
        JWT::$leeway = 60; // $leeway in seconds
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    }

    function decode($token)
    {
        return $token;
    }

    function menu()
    {
        $menu = MenuModel::where('parent_id', 0)
                            ->where('status', 1)
                            ->with('children')
                            ->orderBy('short_order', 'ASC')
                            ->get();
        
        return $menu;
    }

    function total_sales($store_id, $periode=null)
    {
        if($periode == null){
            $query = DB::table('selling_price')
                        ->where('store_id', $store_id)
                        ->select(DB::raw("FLOOR(SUM(payable_amount)) as total_sales"))
                        ->get();

            foreach($query as $loop){
                $info['total_sales'] = $loop->total_sales;
            }
        }else{
            $query = DB::table('selling_price')
                        ->join('selling_info', 'selling_price.invoice_id', '=', 'selling_info.invoice_id')
                        ->where('selling_price.store_id', $store_id)
                        ->whereBetween('selling_info.created_at', [$periode['start'], $periode['end']])
                        ->select(DB::raw("FLOOR(SUM(payable_amount)) as total_sales"))
                        ->get();

            foreach($query as $loop){
                $info['total_sales'] = $loop->total_sales;
            }
        }

        return  $info['total_sales'];
    }

    function total_expense($store_id, $periode=null)
    {
        if($periode == null){
            $query = DB::table('selling_price')
                    ->where('store_id', $store_id)
                    ->select(DB::raw("FLOOR(SUM(total_purchase_price)) as total_expense"))
                    ->get();


            foreach($query as $loop){
                $info['total_expense'] = $loop->total_expense;
            }
        }else{
            $query = DB::table('selling_price')
                        ->join('selling_info', 'selling_price.invoice_id', '=', 'selling_info.invoice_id')
                        ->where('selling_price.store_id', $store_id)
                        ->whereBetween('selling_info.created_at', [$periode['start'], $periode['end']])
                        ->select(DB::raw("FLOOR(SUM(total_purchase_price)) as total_sales"))
                        ->get();

            foreach($query as $loop){
                $info['total_expense'] = $loop->total_sales;
            }
        }

        return  $info['total_expense'];
    }

    function total_point($store_id, $periode=null)
    {
        if($periode == null){
            $query = DB::table('selling_info')
                    ->where('store_id', $store_id, $periode)
                    ->select(DB::raw("FLOOR(SUM(total_points)) as total_point"))
                    ->get();


            foreach($query as $loop){
                $info['total_point'] = $loop->total_point;
            }
        }else{
            $query = DB::table('selling_info')
                    ->where('store_id', $store_id, $periode)
                    ->whereBetween('created_at', [$periode['start'], $periode['end']])
                    ->select(DB::raw("FLOOR(SUM(total_points)) as total_point"))
                    ->get();


            foreach($query as $loop){
                $info['total_point'] = $loop->total_point;
            }
        }

        return  $info['total_point'];
    }

    function total_balance($store_id, $periode=null)
    {
        if($periode == null){
            $query = DB::table('customer_transactions')
                    ->where('store_id', $store_id)
                    ->where('notes', 'add while shoping')
                    ->select(DB::raw("FLOOR(SUM(amount)) as total_balance"))
                    ->get();


            foreach($query as $loop){
                $info['total_balance'] = $loop->total_balance;
            }
        }else{
            $query = DB::table('customer_transactions')
                    ->where('store_id', $store_id)
                    ->where('notes', 'add while shoping')
                    ->whereBetween('created_at', [$periode['start'], $periode['end']])
                    ->select(DB::raw("FLOOR(SUM(amount)) as total_balance"))
                    ->get();


            foreach($query as $loop){
                $info['total_balance'] = $loop->total_balance;
            }
        }

        return  $info['total_balance'];
    }