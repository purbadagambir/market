@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<section class="content" id="app">
  <div v-if="loading" class="text-primary" style="padding-left:45%; font-size: 20px;"><i class="fa fa-spin fa-refresh"></i>&nbsp loading...</div>
  <div v-if="!loading">
    <div class="box box-info" v-bind:class="{ 'collapsed-box': !show }">
      <div v-if="!show" class="box-header with-border" @click="this.openForm">
        <div class="box-tools pull-left">
          <button type="button" class="btn btn-box-tool">
            <i class="fa fa-plus"></i> <h1 class="box-title"> Add New @{{table.name}}</h1>
          </button>
        </div>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool">
            <i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
      <div v-else="!show" class="box-header with-border" @click="this.closeForm">
        <div class="box-tools pull-left">
          <button type="button" class="btn btn-box-tool">
            <i class="fa fa-minus"></i> <h1 class="box-title"> Add New @{{table.name}}</h1>
          </button>
        </div>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool">
            <i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group" v-bind:class="{ 'has-error': hasError.title }">
              <label class="col-sm-3 control-label">Title<span class="text-danger">*</span></label>
              <div class="col-sm-7">
                <input v-model="form.title" type="text" name="label" class="form-control" id="form_label">
                <span v-if="error.title" class="help-block">@{{ error.title }}</span>
              </div>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.code }">
              <label class="col-sm-3 control-label">Code<span class="text-danger">*</span></label>
              <div class="col-sm-7">
                <input v-model="form.code" type="text" name="link" class="form-control" id="form_link">
                <span v-if="error.code" class="help-block">@{{ error.code }}</span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Symbol Left</label>
              <div class="col-sm-7">
                <input v-model="form.symbol_left" type="text" name="link" class="form-control" id="form_link">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Symbol Right</label>
              <div class="col-sm-7">
                <input v-model="form.symbol_right" type="text" name="link" class="form-control" id="form_link">
              </div>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.decimal_place }">
              <label class="col-sm-3 control-label">Decimal Place<span class="text-danger">*</span></label>
              <div class="col-sm-7">
                <input v-model="form.decimal_place" type="number" name="label" class="form-control" id="form_label">
                <span v-if="error.decimal_place" class="help-block">@{{ error.decimal_place }}</span>
              </div>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.status }">
              <label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
              <div class="col-sm-7">
              <select class="form-control select2" style="width: 100%;" name="status" v-model="form.status">
                  <option selected="selected" value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
              <span v-if="error.status" class="help-block">@{{ error.status }}</span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Short Order</label>
              <div class="col-sm-7">
                <input v-model.number="form.short_order" type="number" name="short_order" class="form-control" id="short_order" min="1">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-7">
                <div class="button">
                  <button v-if="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="createData"><i class="fa fa-save"></i> Save <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
                  <button v-else="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="updateData(this.table.id)"><i class="fa fa-arrow-up"></i> Update <i class="fa fa-spin fa-refresh" v-if="loading"></i>&nbsp</button>
                  <button type="button" class="btn btn-danger" @click="this.resetForm()"><i class="fa fa-recycle"></i> Reset</button>
                  <button v-if="!submit" type="button" class="btn btn-success pull-right" @click="this.cancelForm()"><i class="fa fa-arrow-left"></i> Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.box-footer -->
    </div>

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
                  <tr role="row">
                    <th class="text-center">Id</th>
                    <th>Title</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Symbol Left</th>
                    <th class="text-center">Symbol Right</th>
                    <th class="text-center">Decimal Place</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><input type="text" id="currency_id" v-on:keyup="this.search('currency_id')"></td>
                    <td><input type="text" id="title" v-on:keyup="this.search('title')"></td>
                    <td><input type="text" id="code" v-on:keyup="this.search('code')"></td>
                    <td><input type="text" id="symbol_left" v-on:keyup="this.search('symbol_left')"></td>
                    <td><input type="text" id="symbol_right" v-on:keyup="this.search('symbol_right')"></td>
                    <td><input type="text" id="decimal" v-on:keyup="this.search('decimal')"></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr v-for="item in items">
                    <td class="text-center">@{{item.currency_id}}</td>
                    <td>@{{item.title}}</td>
                    <td>@{{item.code}}</td>
                    <td>@{{item.symbol_left}}</td>
                    <td>@{{item.symbol_right}}</td>
                    <td>@{{item.decimal}}</td>
                    <td>
                      <span class="badge btn-info" v-if="item.status == 1">Enabled</span>
                      <span class="badge btn-warning" v-else>Disabled</span>
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          . . .
                        </button>
                        <div class="dropdown-menu pull-right">
                          <li @click="this.editData(item.currency_id)"><a>Edit</a></li>
                          <li @click="this.deleteData(item.currency_id)"><a>Delete</a></li>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr role="row">
                    <th class="text-center">Id</th>
                    <th>Title</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Symbol Left</th>
                    <th class="text-center">Symbol Right</th>
                    <th class="text-center">Decimal Place</th>
                    <th>Status</th>
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