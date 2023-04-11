<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{session('store')->name}} | {{$data['page']}}</title>
  <link rel="icon"  type="image/x-icon" href="{{url('assets/img/logo/1_favicon.png')}}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/dist/css/struk.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/vue/grid.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <section class="content" id="app">
        <div class="container-fluid">
            <div>
                <div class="print-area">
                    <div class="store-info">
                        <img src="https://pondo.co.id/pondopos/assets/itsolution24/img/logo-favicons/{{$data['order']->store_logo}}" alt="Logo Pondo" class="logo">
                        <p>{{$data['order']->store_address}}</p>
                        <p>Mobile: {{$data['order']->store_mobile}}, Email: {{$data['order']->store_email}}</p>
                    </div>
                    <div class='order-info'>
                        <table class='w-100'>
                            <tr>
                                <td>InvoiceID</td>
                                <td>: {{$data['order']->invoice_id}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: {{date_format(date_create($data['order']->tanggal), "d-M-Y h:i A")}}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{$data['order']->member}}</td>
                            </tr>
                            {{-- <tr>
                                <td>Alamat</td>
                                <td>: {{$data['order']->alamat}}</td>
                            </tr> --}}
                            <tr>
                                <td class='w-50'>Point TX</td>
                                <td>: {{$data['order']->poin}}</td>
                            </tr>
                            <tr>
                                <td class='w-50'>Jml. Point</td>
                                <td>: {{$data['order']->jumlah_poin}}</td>
                            </tr>
                        </table>
                        <table class="table-order">
                            <tr class="border-solid-1">
                                <td class='w-50'>Sl.</td>
                                <td class='w-50 left'>Name</td>
                                <td class='w-50 center'>Qty</td>
                                <td class='w-50 right'>Price</td>
                                <td class='w-50 right'>Disc</td>
                                <td class='w-50 right'>Amount</td>
                            </tr>
                            @foreach($data['invoice'] as $item)
                            <tr class="item-order dashed">
                                <td>{{$loop->iteration}}</td>
                                <td class='left'>{{$item->item_name}}</td>
                                <td class='center' width="5%">{{intval($item->item_quantity)}} {{$item->unit_name}}</td>
                                <td class='right'>{{number_format(intval($item->item_price))}}</td>
                                <td class='right'>{{number_format(intval($item->item_discount))}}</td>
                                <td class='right'>{{number_format(intval($item->item_total))}}</td>
                            </tr>
                            @endforeach
                            <tr class="solid-top">
                                <td></td>
                                <td colspan="3" class='w-50 right'>Sub. Total :</td>
                                <td colspan="2" class="dashed right">{{number_format(intval($data['price']->subtotal))}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" class='w-50 right'>Diskon :</td>
                                <td colspan="2" class="dashed right">{{number_format(intval($data['price']->discount_amount))}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" class='w-50 right'>Total :</td>
                                <td colspan="2" class="dashed right">{{number_format(intval($data['price']->subtotal - $data['price']->discount_amount))}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" class='w-50 right'>Dibayar :</td>
                                <td colspan="2" class="dashed right">{{number_format(intval($data['payment']->total_paid))}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" class='w-50 right'>Sisa :</td>
                                <td colspan="2" class="dashed right">{{number_format(intval($data['payment']->total_paid - ($data['price']->subtotal - $data['price']->discount_amount)))}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" class='w-50 right'>Set Ke Kredit :</td>
                                <td colspan="2" class="dashed right">{{number_format(intval($data['payment']->balance_to_credit))}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" class='w-50 right'>Kembalian :</td>
                                <td colspan="2" class="dashed right">{{number_format(intval(($data['payment']->total_paid - ($data['price']->subtotal - $data['price']->discount_amount))) - $data['payment']->balance_to_credit)}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="warning">
                        <p class="w-50">Type Pembayaran : {{$data['order']->p_method}}</p>
                        <p class="w-50">Nama Kasir : {{$data['order']->kasir}}</p>
                        <span class="notes">Terimakasih telah berbelanja.</span>
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>
<script>
    $( document ).ready(function() { 
        window.print();
    });
</script>
</html>