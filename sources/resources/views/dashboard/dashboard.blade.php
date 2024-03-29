﻿@extends('layouts.app')

@section('content')

@push('custom-style')
<link rel="stylesheet" href="assets/dist/css/dashboard.css">
@endpush

<section class="content" id="app">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <span>Total Penjualan</span>
              <h4>{{$data['total_selling']}}</h4>
              <span>Total Penjualan Hari Ini</span>
              <h4>{{$data['total_selling_today']}}</h4>
            </div>
            <div class="icon">
              <i class="fa fa-pencil"></i>
            </div>
            <a href="{{route('sell')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <span>Total Member</span>
              <h4>{{$data['total_member']}}</h4>
              <span>Total Pelanggan Hari Ini</span>
              <h4>{{$data['total_member_today']}}</h4>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{route('member')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <span>Total Pemasok</span>
              <h4>{{$data['total_supplier']}}</h4>
              <span>Total Pemasok Hari Ini</span>
              <h4>{{$data['total_supplier_today']}}</h4>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="{{route('supplier')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <span>Total Produk</span>
              <h4>{{$data['total_product']}}</h4>
              <span>Total Produk Hari Ini</span>
              <h4>{{$data['total_product_today']}}</h4>
            </div>
            <div class="icon">
              <i class="fa fa-star"></i>
            </div>
            <a href="{{route('product')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Aktifitas Terbaru</h3>
        </div>
        @include('dashboard.dashboard_activity')
    </div>
    <div class="box box-info">
        <div class="box-header bg-success">
          <div class="row">
            <div class="col-sm-4 text-center">
              <h2>{{$data['deposit_today']}}</h2>
              <h4>DEPOSIT HARI INI</h4>
            </div>
            <div class="col-sm-4 text-center">
              <h2>{{$data['total_asset']}}</h2>
              <h4>DATA ASSET</h4>
            </div>
            <div class="col-sm-4 text-center">
              <h2>{{$data['withdraw_today']}}</h2>
              <h4>PENARIKAN HARI INI</h4>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <b style="font-size: 20px">Deposit Terakhir</b> 
                </div>
                <div class="box-body">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-gray" role="row">
                        <th class="text-center">Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($data['deposit'] as $deposit)
                        <tr>
                            <td class="text-center">{{$deposit->created_at}}</td>
                            <td><a href="">{{$deposit->title}}</a></td>
                            <td>{{$deposit->amount}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="box-footer text-center">
                  <a href="{{route('transfer')}}">View All →</a> 
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <b style="font-size: 20px">Data Asset</b> 
                </div>
                <div class="box-body">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-gray" role="row">
                        <th class="text-center">Produk</th>
                        <th>Stock</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['data_asset'] as $asset)
                        <tr>
                            <td class="text-center">{{$asset->p_name}}</td>
                            <td>{{$asset->stock}}</td>
                            <td>{{$asset->amount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="box-footer text-center">
                  <a href="{{route('product')}}">View All →</a> 
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <b style="font-size: 20px">Penarikan Terakhir</b> 
                </div>
                <div class="box-body">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-gray" role="row">
                        <th class="text-center">Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($data['withdraw'] as $withdraw)
                        <tr>
                            <td class="text-center">{{$withdraw->created_at}}</td>
                            <td><a href="">{{$withdraw->title}}</a></td>
                            <td>{{$withdraw->amount}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="box-footer text-center">
                  <a href="{{route('transfer')}}">View All →</a> 
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Pemasukan Vs Biaya → January, 2023</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="barChart" style="height:230px"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
</section>

@endsection