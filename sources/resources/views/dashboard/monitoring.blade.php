@extends('layouts.app')

@section('content')

<section class="content" id="app">
    <div class="box box-info">
        <div class="box-body">
            <div class="periode">
                <label>Periode</label>
                <input type="date" class="form-controll" v-model="periode.start">
                <input type="date" class="form-controll" v-model="periode.end" style="margin-left : 10px">
                <button class="btn btn-primary" @click="searchByPeriode" style="margin-left : 10px">Cari</button>
            </div>
            <div v-if="loading" class="text-primary" style="padding-left:45%; font-size: 20px;"><i class="fa fa-spin fa-refresh"></i>&nbsp loading...</div>
            <div class="row" style="margin-top : 25px">
                <div class="col-sm-4" v-for='item in items'>
                    <div class="box box-success">
                        <div class="box-header with-border text-center" style="height: 100px">
                            <img v-bind:src="'https://pondo.co.id/pondopos/assets/itsolution24/img/logo-favicons/' + item.image" alt="" height="30">
                            <h4 style="font-size: 12px">@{{item.store_name}}</h4>
                            <p style="font-size: 12px">@{{item.store_address}}</p>
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
                                        <td class="text-center">Total Sales</td>
                                        <td><a>Rp. @{{item.total_sales}}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Total Expense</td>
                                        <td><a>Rp. @{{item.total_expense}}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Total Point</td>
                                        <td><a>Rp. @{{item.total_point}}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Total Balance</td>
                                        <td><a>Rp. @{{item.total_balance}}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
<script src="assets/js/page/monitoring.js"></script>
<script src="assets/js/notif.js"></script>
@endpush