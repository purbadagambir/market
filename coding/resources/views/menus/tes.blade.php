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
        <div id="wrapper"></div>
      </div>
    </div>
</section>




<script src="{{asset('assets/vue/vue.js')}}"></script>
<script src="{{asset('assets/vue/axios.js')}}"></script>
<script src="{{asset('assets/vue/grid.js')}}"></script>
<script>

new gridjs.Grid({
    columns: ['Name', 'Email', 'Phone Number'],
    pagination: {
      limit: 5
    },
    search: true,
    sort: true,
    data: [
      ['John1', 'john@example.com', '(353) 01 222 3333'],
      ['John2', 'john@example.com', '(353) 01 222 3333'],
      ['John3', 'john@example.com', '(353) 01 222 3333'],
      ['John4', 'john@example.com', '(353) 01 222 3333'],
      ['John5', 'john@example.com', '(353) 01 222 3333'],
      ['John6', 'john@example.com', '(353) 01 222 3333'],
      ['John7', 'john@example.com', '(353) 01 222 3333'],
      ['John8', 'john@example.com', '(353) 01 222 3333'],
      ['John9', 'john@example.com', '(353) 01 222 3333'],
      ['John10', 'john@example.com', '(353) 01 222 3333'],
      ['Mark1', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark2', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark3', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark4', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark5', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark6', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark7', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark8', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark9', 'mark@gmail.com',   '(01) 22 888 4444'],
      ['Mark10', 'mark@gmail.com',   '(01) 22 888 4444']
    ],
    className: {
    table: 'table table-bordered table-striped table-hover'
  }
}).render(document.getElementById("wrapper"));


</script>


@endsection



