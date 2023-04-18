@extends('layouts.app')

@section('content')

@push('custom-style')
<link rel="stylesheet" href="assets/dist/css/struk.css">
@endpush

<section class="content" id="app">
    <div class="container-fluid">
        <div class="box box-info">
            <div class="print-area">
                <div class="store-info">
                    <img src="https://pondo.co.id/pondopos/assets/itsolution24/img/logo-favicons/{{$data['order']['store_logo']}}" alt="Logo Pondo" class="logo">
                    <p>Jalan Pasar Induk Cureh</p>
                    <p>Mobile: 082117736760, Email: marketpondo@gmail.com</p>
                </div>
                <div class='order-info'>
                    <table class='w-100'>
                        <tr>
                            <td>InvoiceID</td>
                            <td>: {{$data['order']['invoice_id']}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>: {{date_format(date_create($data['order']['tanggal']), "d-M-Y h:i A")}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{$data['order']['member']}}</td>
                        </tr>
                        <!-- <tr>
                            <td>Alamat</td>
                            <td>: {{$data['order']['alamat']}}</td>
                        </tr> -->
                        <tr>
                            <td class='w-50'>Point TX</td>
                            <td>: {{$data['order']['poin']}}</td>
                        </tr>
                        <tr>
                            <td class='w-50'>Jml. Point</td>
                            <td>: {{$data['order']['jumlah_poin']}}</td>
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
                    <p class="w-50">Type Pembayaran : {{$data['order']['p_method']}}</p>
                    <p class="w-50">Nama Kasir : {{$data['order']['kasir']}}</p>
                    <span class="notes">Terimakasih telah berbelanja.</span>
                </div>

                <div class="button-invoice noprint">
                    <button class="btn btn-info btn-block text-center noprint" onclick="printStruk('{{$data['order']['invoice_id']}}')" target="_blank"> <i class="fa fa-print"></i> Print </button>
                    <a class="btn btn-default btn-block text-center noprint" href="{{route('pos')}}"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back to POS </a>
                </div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript"> 
    function printStruk(invoice){
        window.open("struk?number="+invoice, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=650");
    }
</script>
@endsection
