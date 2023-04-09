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
      <div class="periode" style="margin-left: 20px; margin-bottom: 10px">
          <label>Periode</label>
          <input type="date" class="form-controll" v-model="periode.start">
          <input type="date" class="form-controll" v-model="periode.end" style="margin-left : 10px">
          <button class="btn btn-primary" @click="searchByPeriode" style="margin-left : 10px">Cari</button>
      </div>

      <div class="col-lg-6 col-xs-12">
        <div class="box box-info">
          <div v-if="loading" class="text-primary" style="padding-left:45%; font-size: 20px;"><i class="fa fa-spin fa-refresh"></i>&nbsp loading...</div>
          <div class="box-header with-border">
            <h3 class="box-title">Member Sering Belanja</h3>
          </div>
          <div v-if="items.length == 0" class="text-primary" style="padding-left:20%; font-size: 20px;">
            Data Pada Periode Tidak Di temukan
          </div>
          <table class="table table-bordered table-striped" v-else="items">
            <thead class="bg-gray">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Mobile</th>
                <th>Total Berbelanja</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for='(item, index) in items'>
                <td>@{{index + 1}}</td>
                <td>@{{item.customer_name}}</td>
                <td>@{{item.customer_mobile}}</td>
                <td>@{{item.total}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
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
    </div>
</section>

@endsection

@push('custom-scripts')
<script src="assets/vue/vue.js"></script>
<script src="assets/vue/table.js"></script>
<script src="assets/vue/axios.js"></script>
<script src="assets/sweetalert/xsweetalert.js"></script>
<script src="assets/toastr/toastr.min.js"></script>
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="assets/bower_components/PACE/pace.min.js"></script>
<script src="assets/js/page/dashboard_member.js"></script>
<script src="assets/js/notif.js"></script>
@endpush