@extends('layouts.app')

@section('content')

<section class="content" id="app">
  <div v-if="loading" class="text-primary" style="padding-left:45%; font-size: 20px;"><i class="fa fa-spin fa-refresh"></i>&nbsp loading...</div>
    
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
            <div class="form-group">
              <label for="categoryname" class="col-sm-3 control-label">No. Referensi <span style="color:red">*</span> </label>
              <div class="col-sm-7">
                <input v-model="form.unit_name" type="text" name="label" class="form-control" id="form_label">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Category <span style="color:red">*</span></label>
              <div class="col-sm-7">
              <select class="form-control select2" style="width: 100%;">
                  <option selected="selected" value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label for="categoryname" class="col-sm-3 control-label">What For <span style="color:red">*</span> </label>
              <div class="col-sm-7">
                <input v-model="form.unit_name" type="text" name="label" class="form-control" id="form_label">
              </div>
            </div>
            <div class="form-group">
              <label for="categoryname" class="col-sm-3 control-label">Amount <span style="color:red">*</span> </label>
              <div class="col-sm-7">
                <input v-model="form.unit_name" type="number" name="label" class="form-control" id="form_label">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Returnable</label>
              <div class="col-sm-7">
              <select class="form-control select2" style="width: 100%;">
                  <option selected="selected" value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Notes</label>
              <div class="col-sm-7">
                <textarea class="form-control" v-model="form.brand_details" cols="10" rows="2"></textarea>
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
                  <tr role="row" class="bg-gray">
                    <th class="text-center">Serial No</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Category Name</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Tanggal Pembuatan</th>
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
                  <tr>
                    <td style="text-align: center; vertical-align: middle;">599</td>
                    <td style="text-align: center; vertical-align: middle;">insentif karyawan 01 january 2023</td>
                    <td style="text-align: center; vertical-align: middle;">GAJI KARYAWAN</td>
                    <td style="text-align: center; vertical-align: middle;">2,474,999</td>
                    <td style="text-align: center; vertical-align: middle;">2023-01-09 18:57:24</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          . . .
                        </button>
                        <div class="dropdown-menu pull-right">
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
                    <th class="text-center">Serial No</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Category Name</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Tanggal Pembuatan</th>
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
<script src="assets/js/page/expense.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush