@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">
<script src="{{asset('assets/sweetalert/xsweetalert.css')}}"></script>
@endpush

<section class="content" id="app">

  <div class="box box-info" v-bind:class="{ 'collapsed-box': !show }">
    <div v-if="!show" class="box-header with-border" @click="this.openForm">
      <div class="box-tools pull-left">
        <button type="button" class="btn btn-box-tool">
          <i class="fa fa-plus"></i> <h1 class="box-title"> Add New Category</h1>
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
          <i class="fa fa-minus"></i> <h1 class="box-title"> Add New Category</h1>
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
          <div class="form-group" v-bind:class="{ 'has-error': hasError.type }">
            <label for="categoryname" class="col-sm-3 control-label">Type*</label>
            <div class="col-sm-7">
              <select class="form-control select2" style="width: 100%;" name="type" v-model="form.type">
                <option value="MAIN_MENU">MAIN MENU</option>
                <option value="SUB_MENU">SUB MENU</option>
                <option value="ACTIONS">ACTIONS</option>
              </select>
              <span v-if="error.type" class="help-block text-danger">@{{ error.type }}</span>
            </div>
          </div>
          <div class="form-group">
            <label for="categoryname" class="col-sm-3 control-label">Parent Menu</label>
            <div class="col-sm-7">
              <select class="form-control select2" style="width: 100%;" name="parent_id" v-model="form.parent_id" :disabled="form.type == 'MAIN_MENU' ">
                <option selected="selected" value="0">None</option>
                @foreach($data['menu'] as $menu)
                <option value="{{$menu->id}}">{{$menu->label}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': hasError.label }">
            <label for="categoryname" class="col-sm-3 control-label">Label*</label>
            <div class="col-sm-7">
              <input v-model="form.label" type="text" name="label" class="form-control" id="label">
              <span v-if="error.label" class="help-block">@{{ error.label }}</span>
            </div>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': hasError.link }">
            <label for="categoryname" class="col-sm-3 control-label">Route</label>
            <div class="col-sm-7">
              <input v-model="form.link" type="text" name="link" class="form-control" id="link">
              <span v-if="error.link" class="help-block">@{{ error.link }}</span>
            </div>
          </div>
          <div class="form-group">
            <label for="categoryname" class="col-sm-3 control-label">Icon</label>
            <div class="col-sm-7">
              <input v-model="form.icon" type="text" name="icon" class="form-control" id="icon">
            </div>
          </div>
          <div class="form-group">
            <label for="categoryname" class="col-sm-3 control-label">No. Urut</label>
            <div class="col-sm-7">
              <input v-model.number="form.short_order" type="number" name="short_order" class="form-control" id="short_order" min="1">
            </div>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': hasError.status }">
            <label for="categoryname" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-7">
            <select class="form-control select2" style="width: 100%;" name="status" v-model="form.status">
                <option selected="selected" value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            <span v-if="error.status" class="help-block">@{{ error.status }}</span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-7">
              <div class="button">
                <button v-if="submit" type="button" class="btn btn-primary" style="margin-right : 10px" @click="createData"><i class="fa fa-save"></i> Save</button>
                <button v-else="submit" type="button" class="btn btn-primary" @click="updateData(this.table.id)"><i class="fa fa-save"></i> Update</button>
                <button type="button" class="btn btn-danger" @click="this.resetForm()"><i class="fa fa-recycle"></i> Reset</button>
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
      <h3 class="box-title">Data @{{table.name}}</h3>
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
                  <th class="text-center">Parent ID</th>
                  <th>Label</th>
                  <th>Route</th>
                  <th>Icon</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center"><input type="text" id="id" v-on:keyup="this.search('id')"></td>
                  <td class="text-center"><input type="text" id="parent_id" v-on:keyup="this.search('parent_id')"></td>
                  <td><input type="text" id="label" v-on:keyup="this.search('label')"></td>
                  <td><input type="text" id="route" v-on:keyup="this.search('route')"></td>
                  <td><input type="text" id="icon" v-on:keyup="this.search('icon')"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr v-for="item in items">
                  <td class="text-center">@{{item.id}}</td>
                  <td class="text-center">@{{item.parent_id}}</td>
                  <td>@{{item.label}}</td>
                  <td>@{{item.route}}</td>
                  <td>@{{item.icon}}</td>
                  <td>
                    <span class="badge btn-success" v-if="item.status == 1">Active</span>
                    <span class="badge btn-warning" v-else>Inactive</span>
                  </td>
                  <td class="text-center">
                    <div class="btn-group">
                      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        . . .
                      </button>
                      <div class="dropdown-menu pull-right">
                        <li @click="this.editData(item.id)"><a>Edit</a></li>
                        <li @click="this.deleteData(item.id)"><a>Delete</a></li>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr role="row">
                  <th class="text-center">Id</th>
                  <th class="text-center">Parent ID</th>
                  <th>Label</th>
                  <th>Route</th>
                  <th>Icon</th>
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
            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
              <ul class="pagination">
                <li class="paginate_button previous" id="datatable_previous" :class="{disabled : this.meta.current_page <= 1}" @click="this.backPage">
                  <a aria-controls="datatable" data-dt-idx="0" tabindex="0">Previous</a>
                </li>
                <li class="paginate_button" v-for="pages in buttonPage" :class="{active : this.meta.current_page == pages.page}">
                  <a aria-controls="datatable" data-dt-idx="1" tabindex="0" @click="this.page(pages.page)">@{{pages.page}}</a>
                </li>
                <li class="paginate_button next" id="datatable_next" :class="{disabled : this.table.pageSelect >= this.meta.last_page}" @click="this.nextPage">
                  <a aria-controls="datatable" data-dt-idx="4" tabindex="0">Next</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.box-body -->
  </div>
</section>

@endsection

@push('custom-scripts')
<script src="{{asset('assets/vue/vue.js')}}"></script>
<script src="{{asset('assets/vue/table.js')}}"></script>
<script src="{{asset('assets/vue/axios.js')}}"></script>
<script src="{{asset('assets/sweetalert/xsweetalert.js')}}"></script>
<script src="{{asset('assets/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/page/menu.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
@endpush




