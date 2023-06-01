@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<section class="content" id="app">
  <div v-if="loading" class="text-primary" style="padding-left:45%; font-size: 20px;"><i class="fa fa-spin fa-refresh"></i>&nbsp loading...</div>
  <div v-if="!loading">
    <div class="box box-success" v-bind:class="{ 'collapsed-box': !show }">
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
            <div class="form-group" v-bind:class="{ 'has-error': hasError.name }">
              <label for="categoryname" class="col-sm-3 control-label">Name *</label>
              <div class="col-sm-7">
                <input v-model="form.name" type="text" name="label" class="form-control" id="form_label">
                <span v-if="error.name" class="help-block">@{{ error.name }}</span>
              </div>
            </div>

            <div class="form-group" v-bind:class="{ 'has-error': hasError.code_name }">
              <label for="categoryname" class="col-sm-3 control-label">Code Name *</label>
              <div class="col-sm-7">
                <input v-model="form.code_name" type="text" name="code_name" class="form-control" id="form_code_name">
                <span v-if="error.code_name" class="help-block">@{{ error.code_name }}</span>
              </div>
            </div>

            <div class="form-group" v-bind:class="{ 'has-error': hasError.store_type }">
              <label for="categoryname" class="col-sm-3 control-label">Store Type</label>
              <div class="col-sm-7">
              <select class="form-control select2" style="width: 100%;" name="store_type" v-model="form.store_type">
                  <option selected="selected" value="Pondo Bangunan">Pondo Bangunan</option>
                  <option selected="selected" value="Pondo Market">Pondo Market</option>
                  <option selected="selected" value="Pondo Kupi">Pondo Kupi</option>
                  <option selected="selected" value="Pondo PPOB">Pondo PPOB</option>
              </select>
              <span v-if="error.store_type" class="help-block">@{{ error.store_type }}</span>
              </div>
            </div>

            <div class="form-group" v-bind:class="{ 'has-error': hasError.mobile }">
              <label for="categoryname" class="col-sm-3 control-label">Mobile</label>
              <div class="col-sm-7">
                <input v-model="form.mobile" type="number" name="mobile" class="form-control" id="form_mobile">
                <span v-if="error.mobile" class="help-block">@{{ error.mobile }}</span>
              </div>
            </div>

            <div class="form-group" v-bind:class="{ 'has-error': hasError.email }">
              <label for="categoryname" class="col-sm-3 control-label">email</label>
              <div class="col-sm-7">
                <input v-model="form.email" type="email" name="email" class="form-control" id="form_email">
                <span v-if="error.email" class="help-block">@{{ error.email }}</span>
              </div>
            </div>

            <div class="form-group" v-bind:class="{ 'has-error': hasError.zip_code }">
              <label for="categoryname" class="col-sm-3 control-label">ZIP Code *</label>
              <div class="col-sm-7">
                <input v-model="form.zip_code" type="text" name="zip_code" class="form-control" id="form_zip_code">
                <span v-if="error.zip_code" class="help-block">@{{ error.zip_code }}</span>
              </div>
            </div>

            <div class="form-group" v-bind:class="{ 'has-error': hasError.address }">
              <label for="categoryname" class="col-sm-3 control-label">Address</label>
              <div class="col-sm-7">
                <input v-model="form.address" type="text" name="address" class="form-control" id="form_address">
                <span v-if="error.address" class="help-block">@{{ error.address }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="categoryname" class="col-sm-3 control-label">Map Koordinat</label>
              <div class="col-sm-7">
                <input v-model="form.koordinat" type="text" name="koordinat" class="form-control" id="form_koordinat">
              </div>
            </div>

            <div class="form-group" v-bind:class="{ 'has-error': hasError.cashier }">
              <label for="categoryname" class="col-sm-3 control-label">Kasir</label>
              <div class="col-sm-7">
              <select class="form-control select2" style="width: 100%;" name="cashier" v-model="form.cashier">
                @foreach($data['kasir'] as $opstion)
                  <option selected="selected" value="{{$opstion->group_id}}">{{$opstion->username}}</option>
                @endforeach
              </select>
              <span v-if="error.cashier" class="help-block">@{{ error.cashier }}</span>
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
                    <th class="text-center">No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Created_at</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in items">
                    <td class="text-center">@{{index + 1}}</td>
                    <td>@{{item.name}}</td>
                    <td>@{{item.address}}</td>
                    <td>@{{item.created_at}}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          . . .
                        </button>
                        <div class="dropdown-menu pull-right">
                          <li @click="this.editData(item.store_id)"><a>Edit</a></li>
                          <li @click="this.deleteData(item.store_id)"><a>Delete</a></li>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr role="row" class="bg-gray">
                    <th class="text-center">No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Created_at</th>
                    <th class="text-center">Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5 ">
              <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing @{{this.meta.from}} to @{{this.meta.to}} of @{{this.meta.total}} entries</div>
            </div>
            <div class="col-sm-7">
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
<script src="assets/js/page/store.js"></script>
<script src="assets/js/notif.js"></script>
@endpush