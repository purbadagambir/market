@extends('layouts.app')

@section('content')

<section class="content">
    <div class="box box-success collapsed-box">
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
        <form role="form" action="{{route('insert-menu')}}" method="post">
        @csrf
          <div class="box-body">
            <div class="form-group">
              <label>Type Menu</label>
              <select class="form-control select2" style="width: 100%;" name="type">
                  <option selected="selected" value="MAIN_MENU">MAIN MENU</option>
                  <option value="SUB_MENU">SUB MENU</option>
                  <option value="ACTIONS">ACTIONS</option>
              </select>
            </div>
            <div class="form-group">
              <label>Parent Menu</label>
              <select class="form-control select2" style="width: 100%;" name="parent_id">
                  <option selected="selected" value="0">None</option>
                  @foreach($data['menu'] as $menu)
                  <option value="{{$menu->id}}">{{$menu->label}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
                <label for="label">Label Menu</label>
                <input type="text" name="label" class="form-control" id="label">
            </div>
            <div class="form-group">
                <label for="link">Link Menu</label>
                <input type="text" name="link" class="form-control" id="link">
            </div>
            <div class="form-group">
                <label for="icon">Icon Menu</label>
                <input type="text" name="icon" class="form-control" id="icon">
            </div>
            <div class="form-group">
                <label for="short_order">No. Urut</label>
                <input type="text" name="short_order" class="form-control" id="short_order">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control select2" style="width: 100%;" name="status">
                  <option selected="selected" value="1">Active</option>
                  <option value="1">Unactive</option>
              </select>
            </div>
          </div>

          <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box-footer -->
    </div>

    <div class="box box-info" id="app">
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
          <form action="" style="margin-bottom : 30px;">
            Show 
            <select name="" id="" > 
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="All">All</option>
            </select>  
            entries
          </form>
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Label</th>
              <th>Status</th>
              <th>Link</th>
              <th>Icon</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="menu in menus">
              <td>@{{menu.id}}</td>
              <td>@{{menu.label}}</td>
              <td v-if="menu.status === 1"><span class="label label-success">active</span></td>
              <td v-else="menu.status === 0"><span class="label label-danger">un-active</span></td>
              <td>@{{menu.route}}</td>
              <td>@{{menu.icon}}</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
    </div>
</section>




<script src="{{asset('assets/vue/vue.js')}}"></script>
<script src="{{asset('assets/vue/axios.js')}}"></script>
<script src="{{asset('assets/vue/grid.js')}}"></script>
<script>
  const { createApp } = Vue

  createApp({
    data() {
      return {
        menus: null
      }
    },
    mounted () {
      axios
        .post('{{URL::to('get-menu')}}')
        .then(response => (this.menus = response.data.data))
    }
  }).mount('#app')
</script>


@endsection



