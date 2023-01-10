@extends('layouts.app')

@section('content')

<section class="content" id="app">
  <div class="box box-success">
    <div class="box-header">
      <div class="box-tools pull-left">
          <b style="font-size : 18px;">{{date('M, Y')}}</b>
        </div>
        <div class="box-tools pull-right">
            <a href=""><i class="fa fa-print"></i> Print</a>
        </div>
    </div>
    <div class="box-body table-responsive">
      <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr role="row" class="bg-success">
                  <th class="text-center bg-black">SI.</th>
                  @foreach($data['category'] as $category)
                  <th class="text-center">{{$category->category_name}}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                
                @foreach($data['tanggal'] as $tanggal)
                <tr>
                  <td style="text-align: center; vertical-align: middle;" class="bg-black">{{$tanggal}}</td>
                  @foreach($data['category'] as $category)
                  <td class="text-center bg-gray">-</td>
                  @endforeach
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr role="row" class="bg-success">
                  <th class="text-center bg-red">Total</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div><!-- /.box-body -->
  </div>
</section>

@endsection

@push('custom-scripts')
<script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endpush