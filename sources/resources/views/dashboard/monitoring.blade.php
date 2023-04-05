@extends('layouts.app')

@section('content')

<section class="content" id="app">
    <div class="box box-info">
        <div class="box-body">
            <div class="periode">
                <form action="">
                    <label>Periode</label>
                    <input type="date" class="form-controll">
                    <input type="date" class="form-controll">
                    <button class="btn btn-primary">Cari</button>
                </form>
            </div>
            <div class="row" style="margin-top : 25px">
                @foreach($data['stores'] as $store)
                <div class="col-sm-4">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <b style="font-size: 12px">{{$store->name}}</b>
                            <p style="font-size: 12px;  text-align: justify;">{{$store->address}}</p>
                        </div>
                        <div class="box-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                <tr class="bg-gray" role="row">
                                    <th>Label</th>
                                    <th>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Total Sales</td>
                                        <td><a href="">Rp. {{number_format(intval(total_sales($store->store_id)))}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Total Expense</td>
                                        <td><a href="">Rp. {{number_format(intval(total_expense($store->store_id)))}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Total Point</td>
                                        <td><a href="">Rp. {{number_format(intval(total_point($store->store_id)))}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Total Balance</td>
                                        <td><a href="">Rp. {{number_format(intval(total_balance($store->store_id)))}}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection