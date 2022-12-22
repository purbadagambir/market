@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="{{asset('assets/toastr/toastr.min.css')}}">
<link href="https://unpkg.com/vue3-easy-data-table/dist/style.css" rel="stylesheet">
@endpush

<section class="content" id="app">
  
    <div class="box box-success collapsed-box"> <!-- collapsed-box -->
      <div class="box-header with-border">
        <h3 class="box-title">From Tambah Menu</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form @submit="checkForm" method="post">
          <div class="box-body">
            <div class="form-group" v-bind:class="{ 'has-error': hasError.type }">
              <label>Type</label>
              <select class="form-control select2" style="width: 100%;" name="type" v-model="form.type">
                  <option value="MAIN_MENU">MAIN MENU</option>
                  <option value="SUB_MENU">SUB MENU</option>
                  <option value="ACTIONS">ACTIONS</option>
              </select>
              <span v-if="error.type" class="help-block">@{{ error.type }}</span>
            </div>
            <div class="form-group">
              <label>Parent Menu</label>
              <select class="form-control select2" style="width: 100%;" name="parent_id" v-model="form.parent_id" :disabled="form.type == 'MAIN_MENU' ">
                  <option selected="selected" value="0">None</option>
                  @foreach($data['menu'] as $menu)
                  <option value="{{$menu->id}}">{{$menu->label}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.label }">
                <label for="label">Label</label>
                <input v-model="form.label" type="text" name="label" class="form-control" id="label">
                <span v-if="error.label" class="help-block">@{{ error.label }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.link }">
                <label for="link">URL</label>
                <input v-model="form.link" type="text" name="link" class="form-control" id="link">
                <span v-if="error.link" class="help-block">@{{ error.link }}</span>
            </div>
            <div class="form-group">
                <label for="icon">Icon Menu</label>
                <input v-model="form.icon" type="text" name="icon" class="form-control" id="icon">
            </div>
            <div class="form-group">
                <label for="short_order">No. Urut</label>
                <input v-model.number="short_order" type="number" name="short_order" class="form-control" id="short_order" min="1">
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': hasError.status }">
              <label>Status</label>
              <select class="form-control select2" style="width: 100%;" name="status" v-model="form.status">
                  <option selected="selected" value="1">Active</option>
                  <option value="1">Unactive</option>
              </select>
              <span v-if="error.status" class="help-block">@{{ error.status }}</span>
            </div>
          </div>

          <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box-footer -->
    </div>

    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Data Menu</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      
      <!-- /.box-header -->
      <div class="box-body">
        <div style="margin-bottom : 20px">
          <span>Search: </span>
          <input type="text" v-model="searchValue">
        </div>

        <div>
        <easy-data-table
          buttons-pagination
          alternating
          table-class-name="table table-bordered table-striped"
          :headers="headers"
          :items="items"
          border-cell
          :search-value="searchValue"
          @click-row="showRow"
        />
          <template #item-operation="item">
            <div class="operation-wrapper">
              <div class="btn-group">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   . . .
                </button>
                <div class="dropdown-menu pull-right">
                  <li><a href="#">Edit</a></li>
                  <li><a href="#">Delete</a></li>
                </div>
              </div>
            </div>
          </template>
        </EasyDataTable>
      </div>
      </div>
    </div>
</section>

@endsection

@push('custom-scripts')
<script src="{{asset('assets/vue/vue.js')}}"></script>
<script src="{{asset('assets/vue/table.js')}}"></script>
<script src="{{asset('assets/vue/axios.js')}}"></script>
<script src="{{asset('assets/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/page/menu.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
@endpush