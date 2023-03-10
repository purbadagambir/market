@extends('layouts.app')

@section('content')

@push('custom-style')
<link rel="stylesheet" href="assets/dist/css/print.css">
@endpush

<section class="content" id="app">
  <div class="box box-info">
    <div class="print-area">
        <div class="store-info">
            <img src="{{url('assets\img\logo\5_logo.png')}}" alt="Logo Pondo" class="logo">
            <p>Jalan Pasar Induk Cureh</p>
            <p>Mobile: 082117736760, Email: marketpondo@gmail.com</p>
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
                <tr>
                    <td>Alamat</td>
                    <td>: {{$data['order']->alamat}}</td>
                </tr>
                <tr>
                    <td class='w-50'>Point TX</td>
                    <td>: {{$data['order']->poin}}</td>
                </tr>
                <tr>
                    <td class='w-50'>Jml. Point</td>
                    <td>: {{$data['order']->jumlah_poin}}</td>
                </tr>
                <tr class="border-solid-1">
                    <td class='w-50'>Sl.</td>
                    <td class='w-50'>Name</td>
                    <td class='w-50'>Qty</td>
                    <td class='w-50'>Price</td>
                    <td class='w-50'>Disc</td>
                    <td class='w-50'>Amount</td>
                </tr>
                @foreach($data['invoice'] as $item)
                <tr class="item-order dashed">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->item_name}}</td>
                    <td>{{intval($item->item_quantity)}}</td>
                    <td>{{number_format(intval($item->item_price))}}</td>
                    <td>{{number_format(intval($item->item_discount))}}</td>
                    <td>{{number_format(intval($item->item_total))}}</td>
                </tr>
                @endforeach
                <tr class="solid-top">
                    <td></td>
                    <td></td>
                    <td colspan="3" class='w-50'>Sub. Total</td>
                    <td class="dashed">: {{number_format(intval($data['price']->subtotal))}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" class='w-50'>Diskon</td>
                    <td class="dashed">: {{number_format(intval($data['price']->discount_amount))}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" class='w-50'>Total</td>
                    <td class="dashed">: {{number_format(intval($data['price']->subtotal - $data['price']->discount_amount))}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" class='w-50'>Dibayar</td>
                    <td class="dashed">: {{number_format(intval($data['payment']->total_paid))}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" class='w-50'>Sisa</td>
                    <td class="dashed">: {{number_format(intval($data['payment']->total_paid - ($data['price']->subtotal - $data['price']->discount_amount)))}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" class='w-50'>Set Ke Kredit</td>
                    <td class="dashed">: {{number_format(intval($data['payment']->balance_to_credit))}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" class='w-50'>Kembalian</td>
                    <td class="dashed">: {{number_format(intval($data['payment']->balance_to_credit - ($data['payment']->total_paid - ($data['price']->subtotal - $data['price']->discount_amount))))}}</td>
                </tr>
            </table>
        </div>

        <div class="warning">
            <p class="w-50">Nama Kasir : {{$data['order']->kasir}}</p>
            <span class="notes">Terimakasih telah berbelanja.</span>
        </div>

    </div>
  </div>
</section>
    @push('custom-scripts')

    <script>
        $( document ).ready(function() { 
            window.print();
        });
    </script>

    @endpush
@endsection
