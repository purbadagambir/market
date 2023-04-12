@extends('layouts.app')

@section('content')

<section class="content" id="app">
  <div v-if="loading" class="text-primary" style="padding-left:45%; font-size: 20px;"><i class="fa fa-spin fa-refresh"></i>&nbsp loading...</div>
  <div v-else="loading">

    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">@{{table.name}} List</h3>
      </div>
      <div class="box-body table-responsive">
        <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <div class="col-sm-6">
              <div class="dataTables_length" id="datatable_length">
                <label>Show 
                  <select name="datatable_length" aria-controls="datatable" class="form-control input-sm" v-model="table.perPage" @change="this.entries">
                    <option v-for="option in entriesOption" :value="option.value" >@{{option.value}}</option>
                  </select> 
                  entries
                </label>
              </div>
            </div>
            <!-- <div class="col-sm-6">
              <div id="datatable_filter" class="dataTables_filter">
                <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="datatable" v-model="table.keyword" v-on:keyup="this.search"></label>
              </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-sm-12">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr role="row" class="bg-gray">
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Account</th>
                    <th class="text-center">Credit</th>
                    <th class="text-center">Debit</th>
                    <!-- <th class="text-center">Balance</th> -->
                    <!-- <th class="text-center">View</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in items">
                    <td style="text-align: center; vertical-align: middle;">@{{item.created_at}}</td>
                    <td class="text-center">@{{item.invoice_id}}</td>
                    <td class="text-center">
                      <span class="badge btn-success" v-if="item.transaction_type == 'deposit'">@{{item.transaction_type}}</span>
                      <span class="badge btn-danger" v-else>@{{item.transaction_type}}</span>
                    </td>
                    <td class="text-center">@{{item.account_name}}</td>
                    <td class="text-right">
                      <span v-if="item.transaction_type == 'deposit'">@{{item.amount}}</span>
                    </td>
                    <td class="text-right">
                      <span v-if="item.transaction_type == 'withdraw'">@{{item.amount}}</span>
                    </td>
                    <!-- <td class="text-center">@{{item.total_paid}}</td> -->
                  </tr>
                </tbody>
                <!-- <tfoot>
                  <tr role="row" class="bg-gray">
                    <th class="text-center" colspan="4">TOTAL</th>
                    <th class="text-center">Credit</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                  </tr>
                </tfoot> -->
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5">
              <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing @{{this.meta.from}} to @{{this.meta.to}} of @{{this.meta.total}} entries</div>
            </div><div class="col-sm-7">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li :class="{disabled : this.meta.current_page <= 1}" @click="this.backPage"><a>&laquo;</a></li>
                <li v-for="pages in buttonPage" :class="{active : this.meta.current_page == pages.page}">
                  <a @click="this.page(pages.page)" v-if="pages.page != '...'">@{{pages.page}}</a>
                  <a v-if="pages.page == '...'" disabled>@{{pages.page}}</a>
                </li>
                <li :class="{disabled : this.table.pageSelect >= this.meta.last_page}" @click="this.nextPage"><a>&raquo;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div><!-- /.box-body -->
    </div>
  </div>
  <input type="hidden" id="store_id" value="{{session('store')->store_id}}">
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
<script src="assets/js/page/transfer.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush