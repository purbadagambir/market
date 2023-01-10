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
                    <th class="text-center">Datetime</th>
                    <th class="text-center">Invoice Id</th>
                    <th class="text-center">Pemasok</th>
                    <th class="text-center">Creator</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Invoice Paid</th>
                    <th class="text-center">Jatuh Tempo</th>
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
                    <td><input type="text" id="decimal" v-on:keyup="this.search('decimal')"></td>
                    <td><input type="text" id="decimal" v-on:keyup="this.search('decimal')"></td>
                    <td><input type="text" id="decimal" v-on:keyup="this.search('decimal')"></td>
                    <td></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="text-align: center; vertical-align: middle;">1</td>
                    <td style="text-align: center; vertical-align: middle;">2023-01-05 15:13:23</td>
                    <td style="text-align: center; vertical-align: middle;"><span class="badge btn-warning">Paid</span></td>
                    <td style="text-align: center; vertical-align: middle;">MARYADI</td>
                    <td style="text-align: center; vertical-align: middle;">Cash</td>
                    <td style="text-align: center; vertical-align: middle;">NUR HAFNIZAH</td>
                    <td style="text-align: center; vertical-align: middle;">67,300</td>
                    <td style="text-align: center; vertical-align: middle;">67,300</td>
                    <td style="text-align: center; vertical-align: middle;">67,300</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          . . .
                        </button>
                        <div class="dropdown-menu pull-right">
                          <li @click="this.editData(item.unit_id)"><a>Return</a></li>
                          <li @click="this.editData(item.unit_id)"><a>View</a></li>
                          <li @click="this.editData(item.unit_id)"><a>Edit</a></li>
                          <li @click="this.deleteData(item.unit_id)"><a>Delete</a></li>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr role="row" class="bg-gray">
                    <th class="text-center">Datetime</th>
                    <th class="text-center">Invoice Id</th>
                    <th class="text-center">Pemasok</th>
                    <th class="text-center">Creator</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Invoice Paid</th>
                    <th class="text-center">Jatuh Tempo</th>
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
<script src="assets/js/page/purchase.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush