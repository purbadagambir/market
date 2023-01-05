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
                    <th class="text-center">Data Time</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">No. Ref</th>
                    <th class="text-center">Old Invoice</th>
                    <th class="text-center">Purchase Invoice Id</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Return Points</th>
                    <th class="text-center">Return Items</th>
                    <th class="text-center">Returned By</th>
                    <th class="text-center">Action</th>
                  </tr>
                  <tr class="bg-info">
                    <td class="text-center"><input type="text" id="currency_id" v-on:keyup="this.search('currency_id')"></td>
                    <td><input type="text" id="title" v-on:keyup="this.search('title')"></td>
                    <td><input type="text" id="code" v-on:keyup="this.search('code')"></td>
                    <td><input type="text" id="symbol_left" v-on:keyup="this.search('symbol_left')"></td>
                    <td><input type="text" id="symbol_right" v-on:keyup="this.search('symbol_right')"></td>
                    <td><input type="text" id="decimal" v-on:keyup="this.search('decimal')"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="text-align: center; vertical-align: middle;">2023-01-03 09:21:53</td>
                    <td style="text-align: center; vertical-align: middle;">SAFRIZAL</td>
                    <td style="text-align: center; vertical-align: middle;">R23010350137</td>
                    <td style="text-align: center; vertical-align: middle;">52023/00035689</td>
                    <td style="text-align: center; vertical-align: middle;">-</td>
                    <td style="text-align: center; vertical-align: middle;">7,600</td>
                    <td style="text-align: center; vertical-align: middle;">-120</td>
                    <td style="text-align: center; vertical-align: middle;">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-gray">
                            <th>Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="bg-info">
                            <td>MR MUSCLE ORANGE POUCH 400ML</td>
                            <td>7,600</td>
                            <td>1 Pouch</td>
                            <td>7,600</td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Total</th>
                            <th>7,600</th>
                            <th>1</th>
                            <th>7,600</th>
                          </tr>
                        </tfoot>
                      </table>
                    </td>
                    <td style="text-align: center; vertical-align: middle;"><a href="">Zuhra</a></td>
                    <td style="text-align: center; vertical-align: middle;">
                      <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          . . .
                        </button>
                        <div class="dropdown-menu pull-right">
                          <li @click="this.editData(item.currency_id)"><a>View</a></li>
                          <li @click="this.deleteData(item.currency_id)"><a>Delete</a></li>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr role="row" class="bg-gray">
                    <th class="text-center">Data Time</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">No. Ref</th>
                    <th class="text-center">Old Invoice</th>
                    <th class="text-center">Purchase Invoice Id</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Return Points</th>
                    <th class="text-center">Return Items</th>
                    <th class="text-center">Returned By</th>
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
<script src="assets/js/page/curency.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush