@extends('layouts.app')

@section('content')

<section class="content" id="app">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Aktifitas Terbaru</h3>
        </div>
        @include('dashboard.dashboard_activity')
    </div>
    <div class="box box-info">
        <div class="box-header bg-success">
          <div class="row">
            <div class="col-sm-4 text-center">
              <h2>1,448,800</h2>
              <h4>DEPOSI HARI INI</h4>
            </div>
            <div class="col-sm-4 text-center">
              <h2>2,207,315,510</h2>
              <h4>DATA ASSET</h4>
            </div>
            <div class="col-sm-4 text-center">
              <h2>0</h2>
              <h4>PENARIKAN TERAKHIR</h4>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <b style="font-size: 20px">Deposit Terakhir</b> 
                </div>
                <div class="box-body">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-gray" role="row">
                        <th class="text-center">Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">2023-01-04 11:28:16</td>
                            <td><a href="">Deposit for selling</a></td>
                            <td>2,900</td>
                        </tr>
                        <tr>
                            <td class="text-center">2023-01-04 11:28:16</td>
                            <td><a href="">Deposit for selling</a></td>
                            <td>2,900</td>
                        </tr>
                        <tr>
                            <td class="text-center">2023-01-04 11:28:16</td>
                            <td><a href="">Deposit for selling</a></td>
                            <td>2,900</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer text-center">
                  <a href="">View All →</a> 
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <b style="font-size: 20px">Data Asset</b> 
                </div>
                <div class="box-body">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-gray" role="row">
                        <th class="text-center">Produk</th>
                        <th>Stock</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">LEM TUBE CAP GAJAH 100ML</td>
                            <td>8.0000</td>
                            <td>99,520</td>
                        </tr>
                        <tr>
                            <td class="text-center">LEM TUBE CAP GAJAH 100ML</td>
                            <td>8.0000</td>
                            <td>99,520</td>
                        </tr>
                        <tr>
                            <td class="text-center">LEM TUBE CAP GAJAH 100ML</td>
                            <td>8.0000</td>
                            <td>99,520</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer text-center">
                  <a href="">View All →</a> 
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <b style="font-size: 20px">Penarikan Terakhir</b> 
                </div>
                <div class="box-body">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-gray" role="row">
                        <th class="text-center">Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">2023-01-04 11:28:16</td>
                            <td><a href="">Debit for Product Purchase</a></td>
                            <td>2,900</td>
                        </tr>
                        <tr>
                            <td class="text-center">2023-01-04 11:28:16</td>
                            <td><a href="">Debit for Product Purchase</a></td>
                            <td>2,900</td>
                        </tr>
                        <tr>
                            <td class="text-center">2023-01-04 11:28:16</td>
                            <td><a href="">Debit for Product Purchase</a></td>
                            <td>2,900</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer text-center">
                  <a href="">View All →</a> 
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Pemasukan Vs Biaya → January, 2023</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="barChart" style="height:230px"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
</section>

@endsection