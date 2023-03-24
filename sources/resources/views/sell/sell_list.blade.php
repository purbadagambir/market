@extends('layouts.app')

@section('content')

<section class="content" id="app">
  <input type="hidden" value="{{session('store')->store_id}}" id="store_id">
  <div v-if="loading" class="text-primary" style="padding-left:45%; font-size: 20px;"><i class="fa fa-spin fa-refresh"></i>&nbsp loading...</div>
  <div v-else="loading">

    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">@{{table.name}} List</h3>
        <div class="btn-group pull-right">
          <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-filter"></i> Filter <i class="fa fa-angle-down"></i>

          </button>
          <div class="dropdown-menu">
            <li><a>Today Invoice</a></li>
            <li><a>All Invoice</a></li>
            <li><a>Due Invoice</a></li>
            <li><a>All Due Invoice</a></li>
            <li><a>Paid Invoice</a></li>
            <li><a>Inactive Invoice</a></li>
          </div>
        </div>
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
                    <th class="text-center">Invoice Id</th>
                    <th class="text-center">Date Time</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Pay</th>
                    <th class="text-center">Action</th>
                  </tr>
                  <tr class="bg-info">
                    <td class="text-center"><input type="text" id="currency_id" v-on:keyup="this.search('currency_id')"></td>
                    <td><input type="text" id="title" v-on:keyup="this.search('title')"></td>
                    <td><input type="text" id="code" v-on:keyup="this.search('code')"></td>
                    <td><input type="text" id="symbol_left" v-on:keyup="this.search('symbol_left')"></td>
                    <td><input type="text" id="symbol_right" v-on:keyup="this.search('symbol_right')"></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in items">
                    <td >@{{item.invoice_id}}</td>
                    <td class="text-center">@{{item.created_at}}</td>
                    <td class="text-center">@{{item.customer_name}}</td>
                    <td class="text-center">
                      <span class="badge btn-success">@{{item.payment_status}}</span>
                    </td>
                    <td class="text-center">-</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          . . .
                        </button>
                        <div class="dropdown-menu pull-right">
                          <li><a>Return</a></li>
                          <li><a :href="'invoice?number='+item.invoice_id">View</a></li>
                          <li><a>Edit</a></li>
                          <li><a>Delete</a></li>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr role="row" class="bg-gray">
                    <th class="text-center">Invoice Id</th>
                    <th class="text-center">Date Time</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Pay</th>
                    <th class="text-center">Action</th>
                  </tr>
                </tfoot>
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
<script src="assets/js/page/sell.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush