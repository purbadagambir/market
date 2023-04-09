@extends('layouts.app')

@section('content')

<section class="content" id="app">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$data['total_member']}}</h3>

              <p>Total Member</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">This info</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$data['total_member_aktif']}}</h3>

              <p>Total Member Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-power-off"></i>
            </div>
            <a href="#" class="small-box-footer">This info</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$data['total_point']}}</h3>

              <p>Total Point</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">This info</a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$data['total_balance']}}</h3>

              <p>Total Balance</p>
            </div>
            <div class="icon">
              <i class="fa fa-exchange"></i>
            </div>
            <a href="#" class="small-box-footer">This info</a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Member Big Point</h3>
          </div>
          <table class="table table-bordered table-striped">
            <thead class="bg-gray">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Mobile</th>
                <th>Total Point</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['data_member'] as $member)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$member->customer_name}}</td>
                <td>{{$member->customer_mobile}}</td>
                <td>{{$member->total_points}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-6 col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Member Sering Belanja</h3>
          </div>
          <table class="table table-bordered table-striped">
            <thead class="bg-gray">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Mobile</th>
                <th>Total Berbelanja</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['data_activity_member'] as $member)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$member->customer_name}}</td>
                <td>{{$member->customer_mobile}}</td>
                <td>{{$member->total}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</section>

@endsection