<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PONDOPOS | {{$data['page']}}</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="assets/dist/css/pos.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/vue/grid.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue sidebar-mini">

  @include('layouts.header')
  
  <section class="content" id="app">
    <div class="row">
      <div class="col-lg-7">
        <div class="box box-info direct-chat direct-chat-warning">
          <div class="box-header">
            <div class="row filter">
              <div class="col-lg-7 col-xs-7">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  <input type="text" class="form-control" placeholder="Cari Produk" v-model="keyword" @change="getProductSearch()">
                </div>
              </div>
              <div class="col-lg-5 col-xs-5">
                <select class="form-control pull-right" name="" id="">
                  <option value="">Lihat Semua</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="direct-chat-messages product-list">

              <div class="col-lg-3 col-xs-4 text-center" v-for="item in items">
                <div class="info-box product-box" @click="getProductClik(item.p_code)">
                  <div class="inner">
                    <i class="fa fa-barcode fa-3x barcode"></i>
                    <p class="text-product">@{{item.p_name}}</p>
                  </div>
                </div>
                <div class="add-cart bg-black">
                    <b><i class="fa fa-plus"></i> Tambah Ke Keranjang </b>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button class="btn btn-warning btn-block btn-lg pay-hold">
              Rp. @{{carts_footer.sum_total_amount_carts}}
            </button>
          </div>
        </div>

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">WAJIB DI ISI!!!</h4>
              </div>
              <div class="modal-body">
                <div class="input-group">
                  <span class="input-group-addon bg-danger" @click="minus">-</span>
                  <input type="text" class="form-control" v-model="form_cart.qty" disabled>
                  <span class="input-group-addon bg-success" @click="plus">+</span>
                </div>
                <div class="button-unit" style="margin-top:10px; text-align:center">
                  <button class="btn btn-info" @click="addCartItem(form_cart.p_code, form_cart.unit_small, form_cart.sell_price_small, form_cart.unit_small_id)">@{{form_cart.unit_small}}</button>
                  <button class="btn btn-info" style="margin-left:10px; margin-right:10px" @click="addCartItem(form_cart.p_code, form_cart.unit_medium, form_cart.sell_price_medium, form_cart.unit_medium_id)">@{{form_cart.unit_medium}}</button>
                  <button class="btn btn-info" @click="addCartItem(form_cart.p_code, form_cart.unit_large, form_cart.sell_price_large, form_cart.unit_large_id)">@{{form_cart.unit_large}}</button>
                </div>
                <!-- <select class="form-control" style="margin-top:10px" v-model="form_cart.unit_id">
                  <option selected :value="form_cart.unit_small_id" @click="unitCart(form_cart.unit_small, form_cart.sell_price_small)">@{{form_cart.unit_small}}</option>
                  <option :value="form_cart.unit_medium_id" @click="unitCart(form_cart.unit_medium, form_cart.sell_price_medium)">@{{form_cart.unit_medium}}</option>
                  <option :value="form_cart.unit_large_id" @click="unitCart(form_cart.unit_large, form_cart.sell_price_large)">@{{form_cart.unit_large}}</option>
                </select> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <!-- <button type="button" class="btn btn-primary" @click="addCartItem(form_cart.p_code)"> <i class="fa fa-cart-plus"></i> Add to Chart</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-payment">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Payment <i class="fa fa-arrow-right"></i> @{{customer_mobile}} (@{{customer_name}})</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="list-group">
                      @foreach($data['pmethod'] as $pmethod)
                      <a class="list-group-item" id="pmethod{{$pmethod->pmethod_id}}">{{$pmethod->name}}</a>
                      @endforeach
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12 text-center">
                      <h5>Pmethod</h5>
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <button class="btn btn-block btn-success"><i class="fa fa-money"></i> Full Payment</button>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <button class="btn btn-block btn-danger"><i class="fa fa-minus"></i> Full Due</button>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-12 text-center">
                      <h5>Order Detail</h5>
                      <table style="width:100%" class="table table-bordered table-striped">
                        <tr v-for="(cart, index) in carts">
                          <td >@{{index + 1}}</td>
                          <td style="text-align:left">@{{cart.p_name}} @{{cart.qty}} (@{{cart.unit}})</td>
                          <td style="text-align:right">@{{cart.price}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">Subtotal</td>
                          <td style="text-align:right">@{{carts_footer.sum_subtotal_carts}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">Discount</td>
                          <td style="text-align:right">@{{carts_footer.sum_discont_carts}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">Tax</td>
                          <td style="text-align:right">@{{carts_footer.tax_amount}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">Shipper Charger</td>
                          <td style="text-align:right">@{{carts_footer.shipping_charger}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">Orther Charger</td>
                          <td style="text-align:right">@{{carts_footer.orders_charger}}</td>
                        </tr>
                      </table>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i> Cancel</button>
                <button type="button" class="btn btn-success"> <i class="fa fa-money"></i> Checkout <i class="fa fa-arrow-right"></i> </button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        

      </div>
      <div class="col-lg-5">
        <div class="box box-warning direct-chat direct-chat-warning">
          <div class="box-header with-border">
            <div class="row">
              <div class="col-md-10 col-xs-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <select class="form-control">
                    @foreach($data['members'] as $member)
                    <option value="{{$member->customer_id}}" @click="setCustomer('{{$member->customer_mobile}}', '{{$member->customer_name}}')"> {{$member->customer_mobile}} ({{$member->customer_name}}) </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2 col-xs-2">
                <i class="fa fa-user-plus fa-2x pull-right"></i>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="direct-chat-messages">
              <table style="width:100%">
                <thead class="bg-gray">
                  <tr>
                    <th style="width:15%">Qty</th>
                    <th>Unit</th>
                    <th style="width:20%">Produk</th>
                    <th style="width:15%">Harga</th>
                    <th style="width:5%">%</th>
                    <th style="width:15%">Dis</th>
                    <th style="width:15%">Subtotal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(cart, index) in carts">
                    <td>
                      <button type="button" class="btn btn-default">@{{cart.qty}}</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default">@{{cart.unit}}</button>
                    </td>
                    <td>
                        <div class="bg-green product-name">
                        @{{cart.p_name}}
                        </div>
                    </td>
                    <td>@{{cart.price}}</td>
                    <td>@{{cart.discont}}</td>
                    <td>@{{cart.discont_price}}</td>
                    <td>@{{cart.subtotal}}</td>
                    <td><i class="fa fa-close text-danger" @click="deleteCartItem(index)"></i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
          
          <div class="box-footer">
            <table cellspacing="0" cellpadding="0">
              <thead>
                <tr class="bg-gray">
                  <th>Total Item</th>
                  <th>@{{carts.length}}(@{{carts_footer.sum_qty_carts}})</th>
                  <th>@{{carts_footer.sum_total_carts}}</th>
                  <th>@{{carts_footer.sum_discont_carts}}</th>
                  <th>@{{carts_footer.sum_subtotal_carts}}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>DISKON</td>
                  <td><input type="number" v-model="carts_footer.sum_discont_carts" disabled></td>
                  <td>JUMLAH PAJAK (%)</td>
                  <td><input type="number" v-model="carts_footer.tax_amount" disabled></td>
                </tr>
                <tr>
                  <td>ONGKOS KIRIM</td>
                  <td><input type="number" v-model="carts_footer.shipping_charger" disabled></td>
                  <td>BIAYA LAINNYA</td>
                  <td><input type="number" v-model="carts_footer.orders_charger" disabled></td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="bg-gray">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>TOTAL BAYAR</th>
                  <th>@{{carts_footer.sum_total_amount_carts}}</th>
                </tr>
              </tfoot>
            </table>
            <div class="row">
              <div class="col-lg-6">
                <button class="btn btn-success btn-block btn-lg pay-hold" @click="showModalPayment()">
                  <i class="fa fa-money"></i> PAY
                </button>
              </div>
              <div class="col-lg-6">
                <button class="btn btn-danger btn-block btn-lg pay-hold">
                  <i class="fa fa-money"></i> HOLD
                </button>
              </div>
            </div>
          </div>
          <!-- /.box-footer-->
        </div>
      </div>
    </div>

  </section>

  <!-- jQuery 3 -->
  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- <script src="assets/bower_components/raphael/raphael.min.js"></script>
  <script src="assets/bower_components/morris.min.js"></script> -->
  <!-- Sparkline -->
  <script src="assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="assets/bower_components/moment/min/moment.min.js"></script>
  <script src="assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/dist/js/demo.js"></script>

  <script src="assets/bower_components/select2/dist/js/select2.full.min.js"></script>

  <script src="assets/vue/vue.js"></script>
  <script src="assets/vue/table.js"></script>
  <script src="assets/vue/axios.js"></script>
  <script src="assets/sweetalert/xsweetalert.js"></script>
  <script src="assets/toastr/toastr.min.js"></script>
  <script src="assets/js/page/order.js"></script>
  <script src="assets/js/notif.js"></script>
</body>
</html>