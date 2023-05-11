@extends('layouts.app')

@section('content')


@push('custom-style')
<link rel="stylesheet" href="assets/toastr/toastr.min.css">
<script src="assets/sweetalert/xsweetalert.css"></script>
@endpush

<section class="content" id="app">
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Group Menu</h3>
    </div>

    <div class="box-body table-responsive">
      <div class="form-group">
        <label for="categoryname" class="col-sm-3 control-label">Group User</label>
        <div class="col-sm-7">
          <select class="form-control select2" style="width: 100%;">
            <option selected>Pilih...</option>
            @foreach($data['group'] as $option)
            <option value="{{$option->group_id}}">{{$option->name}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group" id="menu-checkbox">
        <label class="col-sm-12 control-label">Role Access :</label>
        
      </div>
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
<script src="assets/bower_components/PACE/pace.min.js"></script>
<script src="assets/js/page/group-menu.js"></script>
<script src="assets/js/page/app.js"></script>
<script src="assets/js/notif.js"></script>
@endpush