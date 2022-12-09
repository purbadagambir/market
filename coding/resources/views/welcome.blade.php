<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <meta name="description" content="">
    <meta name="keywords" content="">
    @livewireStyles
    @livewireScripts

        <link rel="shortcut icon" href="{{asset('assets/itsolution24/img/logo-favicons.png')}}">
        <link rel="shortcut icon" href="{{asset('assets/itsolution24/img/logo-favicons/nofavicon.png')}}">
        <link type="text/css" href="{{asset('assets/itsolution24/cssmin/main.css')}}" type="text/css" rel="stylesheet">

  
    <!-- Plugin CSS -->
        <!-- Bootstrap CSS -->
        <link type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" type="text/css" rel="stylesheet">

        <!-- jquery UI CSS -->
        <link type="text/css" href="{{asset('assets/jquery-ui/jquery-ui.min.css')}}" type="text/css" rel="stylesheet">

        <!-- Font-Awesome CSS -->
        <link type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.css')}}" type="text/css" rel="stylesheet">

        <!-- Morris CSS -->
        <link type="text/css" href="{{asset('assets/morris/morris.css')}}" type="text/css" rel="stylesheet">

        <!-- Select2 CSS -->
        <link type="text/css" href="{{asset('assets/select2/select2.min.css')}}" type="text/css" rel="stylesheet">

        <!-- Datepicker3 CSS-->
        <link type="text/css" href="{{asset('assets/datepicker/datepicker3.css')}}" type="text/css" rel="stylesheet">

        <!-- Bootstrap Timepicker CSS -->
        <link type="text/css" href="{{asset('assets/timepicker/bootstrap-timepicker.min.css')}}" type="text/css" rel="stylesheet">

        <!-- Bootstrap3 Wysihtml5 CSS -->
        <link type="text/css" href="{{asset('assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" type="text/css" rel="stylesheet">

        <!-- Perfect-scrollbar CSS -->
        <link type="text/css" href="{{asset('assets/perfectScroll/css/perfect-scrollbar.css')}}" type="text/css" rel="stylesheet">

        <!-- Toastr CSS -->
        <link type="text/css" href="{{asset('assets/toastr/toastr.min.css')}}" type="text/css" rel="stylesheet">

        <!-- Filemanager Dialogs CSS -->
        <link type="text/css" href="{{asset('assets/itsolution24/css/filemanager/dialogs.css')}}" type="text/css" rel="stylesheet">

        <!-- Filemanager Main CSS -->
        <link type="text/css" href="{{asset('assets/itsolution24/css/filemanager/main.css')}}" type="text/css" rel="stylesheet">

    <!-- Theme CSS -->
        <link type="text/css" href="{{asset('assets/itsolution24/css/theme.css')}}" type="text/css" rel="stylesheet">

        <!-- Skin Black CSS -->
        <link type="text/css" href="{{asset('assets/itsolution24/css/skins/skin-black.css')}}" type="text/css" rel="stylesheet">

        <!-- Skin Blue CSS -->
        <link type="text/css" href="{{asset('assets/itsolution24/css/skins/skin-blue.css')}}" type="text/css" rel="stylesheet">

        <!-- Skin Green CSS-->
        <link type="text/css" href="{{asset('assets/itsolution24/css/skins/skin-green.css')}}" type="text/css" rel="stylesheet">

        <!-- Skin Red CSS -->
        <link type="text/css" href="{{asset('assets/itsolution24/css/skins/skin-red.css')}}" type="text/css" rel="stylesheet">

        <!-- Skin Yellow CSS -->
        <link type="text/css" href="{{asset('assets/itsolution24/css/skins/skin-yellow.css')}}" type="text/css" rel="stylesheet">

        <!-- Datatables CSS -->
        <link type="text/css" href="{{asset('assets/DataTables/datatables.min.css')}}" type="text/css" rel="stylesheet">

        <!-- Main CSS -->
        <link href="{{asset('assets/itsolution24/css/main.css')}}" type="text/css" rel="stylesheet">

        <!-- Responsive CSS -->
        <link href="{{asset('assets/itsolution24/css/responsive.css')}}" type="text/css" rel="stylesheet">

        <!-- Print CSS -->
        <link href="{{asset('assets/itsolution24/css/print.css')}}" media="print" type="text/css" rel="stylesheet">



        <script src="{{asset('assets/itsolution24/jsmin/main.js')}}" type="text/javascript"></script>

        <!-- jQuery JS  -->
        <script src="{{asset('assets/jquery/jquery.min.js.download')}}" type="text/javascript"></script> 

        <!-- jQuery Ui JS -->
        <script src="{{asset('assets/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>

        <!-- Bootstrap JS -->
        <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

        <!-- Chart JS -->
        <script src="{{asset('assets/chartjs/Chart.min.js')}}" type="text/javascript"></script>

        <!-- Jquery Sparkline JS -->
        <script src="{{asset('assets/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>

        <!-- Bootstrap Datepicker JS -->
        <script src="{{asset('assets/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>

        <!-- Bootstrap Timepicker JS-->
        <script src="{{asset('assets/timepicker/bootstrap-timepicker.min.js')}}" type="text/javascript" ></script>

        <!-- Bootstrap3 Wysihtml5 All JS -->
        <script src="{{asset('assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>

        <!-- Select2 JS -->
        <script src="{{asset('assets/select2/select2.min.js')}}" type="text/javascript"></script>

        <!-- Perfect Scrollbar JS -->
        <script src="{{asset('assets/perfectScroll/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>

        <!-- Sweetalert JS-->
        <script src="{{asset('assets/sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>

        <!-- Totastr JS -->
        <script src="{{asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>

        <!-- Accounting JS -->
        <script src="{{asset('assets/accounting/accounting.min.js')}}" type="text/javascript"></script>

        <!-- Underscore JS -->
        <script src="{{asset('assets/underscore/underscore.min.js')}}" type="text/javascript"></script>

        <!-- IE JS -->
        <script src="{{asset('assets/itsolution24/js/ie.js')}}" type="text/javascript"></script>

        <!-- Theme JS -->
        <script src="{{asset('assets/itsolution24/js/theme.js')}}" type="text/javascript"></script>

        <!-- Common JS -->
        <script src="{{asset('assets/itsolution24/js/common.js')}}" type="text/javascript"></script>

        <!-- Main JS-->
        <script src="{{asset('assets/itsolution24/js/main.js')}}" type="text/javascript"></script>

        <!-- Datatables JS -->
        <script src="{{asset('assets/DataTables/datatables.min.js')}}" type="text/javascript"></script>

        <!-- Angular JS -->
        <script src="{{asset('assets/itsolution24/angularmin/angular.js')}}" type="text/javascript"></script> 

        <!-- Angular App JS -->
        <script src="{{asset('assets/itsolution24/angular/angularApp.js')}}" type="text/javascript"></script>

        <!-- Angular Modal JS -->
        <script src="{{asset('assets/itsolution24/angularmin/modal.js')}}" type="text/javascript"></script>

        <!-- Anguar Filemanager JS -->
        <script src="{{asset('assets/itsolution24/angularmin/filemanager.js')}}" type="text/javascript"></script>
</head>
<body class="sidebar-mini skin-black">
<div class="hidden"></div>
<div class="wrapper">

<!-- Main Header Start -->  
<header class="main-header ">
  <a href="https://pondo.co.id/pondopos/admin/dashboard.php" class="logo">
    <span class="logo-mini">
      <b title="PONDO MARKET 002">
        P      </b>
      2    </span>
    <span class="logo-lg">
      <b title="PONDO MARKET 002">
        PONDO MARKET 002      </b>
    </span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">#</span>
    </a>
    <ul class="nav navbar-nav navbar-left">
      <li class="dropdown">
        <a href="https://pondo.co.id/pondopos/admin/dashboard.php#" class="dropdown-toggle" data-toggle="dropdown" title="INA">
          <img src="{{asset('assets/itsolution24/img/flags/INA.png')}}" alt="INA"></a>
        <ul class="dropdown-menu ps ps--theme_default" data-ps-id="c3af708e-0d9a-362a-6573-d52719187921">
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=en" title="Inggris">
                <img src="./Dasbor » PONDO MARKET 002_files/en.png" class="language-img"> &nbsp;&nbsp;Inggris              </a>
            </li>
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=ar" title="Arab">
                <img src="./Dasbor » PONDO MARKET 002_files/ar.png" class="language-img"> &nbsp;&nbsp;Arab              </a>
            </li>
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=bn" title="Bangladesh">
                <img src="./Dasbor » PONDO MARKET 002_files/bn.png" class="language-img"> &nbsp;&nbsp;Bangladesh              </a>
            </li>
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=hi" title="India">
                <img src="./Dasbor » PONDO MARKET 002_files/hi.png" class="language-img"> &nbsp;&nbsp;India              </a>
            </li>
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=fr" title="Perancis">
                <img src="./Dasbor » PONDO MARKET 002_files/fr.png" class="language-img"> &nbsp;&nbsp;Perancis              </a>
            </li>
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=de" title="Jerman">
                <img src="./Dasbor » PONDO MARKET 002_files/de.png" class="language-img"> &nbsp;&nbsp;Jerman              </a>
            </li>
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=es" title="Spanyol">
                <img src="./Dasbor » PONDO MARKET 002_files/es.png" class="language-img"> &nbsp;&nbsp;Spanyol              </a>
            </li>
                      <li>
              <a href="https://pondo.co.id/pondopos/admin/dashboard.php?lang=INA" title="Indonesia">
                <img src="./Dasbor » PONDO MARKET 002_files/INA.png" class="language-img"> &nbsp;&nbsp;Indonesia              </a>
            </li>
                  <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></ul>
      </li>
      <li>
        <a href="https://pondo.co.id/pondopos/admin/dashboard.php#" onclick="return false;" id="live_datetime">Nov 20, 2022, 8:02:48 AM</a>
      </li>
    </ul>
    <!-- navbar custome menu start -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
                          <li class="user user-menu sell-btn">
            <a href="https://pondo.co.id/pondopos/admin/pos.php" title="POS">
              <svg class="svg-icon">
                <use href="#icon-pos-black">
              </use></svg>
              <span class="text">
                POS              </span>
            </a>
          </li>
                                                      <li class="user user-menu">
              <a href="https://pondo.co.id/pondopos/admin/report_cashbook.php" title="Laporan Buku Kas">
                <svg class="svg-icon">
                  <use href="#icon-register-black">
                </use></svg>
                <span class="text">
                  BUKU KAS                </span>
              </a>
            </li>
                                    <li class="user user-menu">
            <a href="https://pondo.co.id/pondopos/admin/invoice.php" title="Struk">
              <svg class="svg-icon">
                <use href="#icon-invoice-black">
              </use></svg>
              <span class="text">
                STRUK              </span>
              &nbsp;<span class="label label-warning">6</span>
            </a>
          </li>
                          <li id="user-preference" class="user user-menu sell-btn">
            <a href="https://pondo.co.id/pondopos/admin/user_preference.php?store_id=18" title="Referensi Pengguna">
              <svg class="svg-icon">
                <use href="#icon-heart-black">
              </use></svg>
            </a>
          </li>
                          <li class="user user-menu sell-btn">
            <a href="https://pondo.co.id/pondopos/admin/store_single.php" title="Pengaturan">
              <svg class="svg-icon">
                <use href="#icon-settings-black">
              </use></svg>
            </a>
          </li>
                          <li class="user user-menu">
            <a href="https://pondo.co.id/pondopos/admin/stock_alert.php" title="Peringatan Stok">
              <svg class="svg-icon">
                <use href="#icon-alert-black">
              </use></svg>
                                            <span class="label label-warning">
                  2798</span>
                          </a>
          </li>
        
                <li class="user user-menu">
          <a ng-click="SupportDeskModal();" onclick="return false;" href="https://pondo.co.id/pondopos/admin/dashboard.php#" title="  Itsolution24">
            <svg class="svg-icon">
              <use href="#icon-support-black">
            </use></svg>
          </a>
        </li>
        <li>
          <a id="togglingfullscreen" onclick="toggleFullScreenMode(); return false;" href="https://pondo.co.id/pondopos/admin/dashboard.php#" title="Layar Penuh">
            <span class="fa fa-fw fa-expand"></span>
          </a>
        </li>
        <li id="scrolling-sidebar" class="user user-menu">
          <a href="https://pondo.co.id/pondopos/admin/dashboard.php#" title="Laporan" data-toggle="scrolling-sidebar" data-width="350">
            <i class="fa fa-square"></i>
          </a>
        </li>
        <li id="screen-lock" class="user user-menu">
          <a href="https://pondo.co.id/pondopos/lockscreen.php" title="Kunci Layar">
            <i class="fa fa-lock"></i>
          </a>
        </li>
        <li class="user user-menu">
          <a id="logout" href="https://pondo.co.id/pondopos/admin/logout.php" title="Keluar">
            <i class="fa fa-sign-out"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Main Header End --> 

<!-- Main Sidebar Start -->
<aside class="main-sidebar">
  <section class="sidebar">

    <!--  Sidebar User Panel Start-->
    <div class="user-panel">
      <div class="pull-left image">
                  <svg class="svg-icon"><use href="#icon-avatar"></use></svg>
              </div>
      <div class="pull-left info">
        <p class="username" title="Your Name">
          Your Name        </p>
        <a href="https://pondo.co.id/pondopos/admin/user_profile.php?id=1">
          <i class="fa fa-circle user-status-dot"></i> 
          Admin 
        </a>
      </div>
    </div>  
    <!-- Sidebar User Panel End -->

    <!-- Sidebar Menu Start -->
    <ul class="sidebar-menu">
      <li class=" active">
        <a href="https://pondo.co.id/pondopos/admin/dashboard.php">
          <svg class="svg-icon"><use href="#icon-dashboard"></use></svg>
          <span>
            DASBOR          </span>
        </a>
      </li>

              <li class="">
          <a href="https://pondo.co.id/pondopos/admin/pos.php">
            <svg class="svg-icon"><use href="#icon-create-invoice"></use></svg>
            <span>
              POS            </span>
          </a>
        </li>
      
      <li class="treeview">
                <a href="https://pondo.co.id/pondopos/admin/pos.php">
          <svg class="svg-icon"><use href="#icon-money"></use></svg>
          <span>PENJUALAN</span>
           <i class="fa fa-angle-left pull-right"></i>
         </a>
                <ul class="treeview-menu">
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/invoice.php" title="Struk">
                <svg class="svg-icon"><use href="#icon-invoice-list"></use></svg>
                <span>
                  DAFTAR PENJUALAN                </span>
              </a>
            </li>
                                <li class="">
              <a href="https://pondo.co.id/pondopos/admin/sell_return.php">
                <svg class="svg-icon"><use href="#icon-back-arrow"></use></svg>
                <span>
                  DAFTAR PENGEMBALIAN                </span>
              </a>
            </li>
                                <li class="">
              <a href="https://pondo.co.id/pondopos/admin/sell_log.php">
                <svg class="svg-icon"><use href="#icon-list"></use></svg>
                 CATATAN PENJUALAN              </a>
            </li>
                    <li class="treeview">
                        <a href="https://pondo.co.id/pondopos/admin/giftcard.php">
              <svg class="svg-icon"><use href="#icon-card1"></use></svg>
              <span>KARTU MEMBER</span>
               <i class="fa fa-angle-left pull-right"></i>
             </a>
                        <ul class="treeview-menu">
                              <li class="">
                  <a href="https://pondo.co.id/pondopos/admin/giftcard.php?box_state=open">
                    <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                    <span>
                      BUAT KARTU MEMBER                    </span>
                  </a>
                </li>
                                            <li class="">
                  <a href="https://pondo.co.id/pondopos/admin/giftcard.php">
                    <svg class="svg-icon"><use href="#icon-card1"></use></svg>
                    <span>
                      ANTRIAN KARTU MEMBER                    </span>
                  </a>
                </li>
                                            <li class="">
                  <a href="https://pondo.co.id/pondopos/admin/giftcard_topup.php">
                    <svg class="svg-icon"><use href="#icon-list"></use></svg>
                    <span>
                      ISI ULANG KARTU MEMBER                    </span>
                  </a>
                </li>
                          </ul>
          </li>
        </ul>
      </li>

              <li class="treeview">
                    <a href="https://pondo.co.id/pondopos/admin/quotation.php">
            <svg class="svg-icon"><use href="#icon-heart"></use></svg>
            <span>KUTIPAN</span>
             <i class="fa fa-angle-left pull-right"></i>
           </a>
                    <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/quotation.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  <span>
                    TAMBAH KUTIPAN                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/quotation.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  <span>
                    DAFTAR KUTIPAN                  </span>
                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
                    <a href="https://pondo.co.id/pondopos/admin/installment.php">
            <svg class="svg-icon"><use href="#icon-installment"></use></svg>
            <span>ANGSURAN</span>
             <i class="fa fa-angle-left pull-right"></i>
           </a>
                    <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/installment.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  <span>
                    DAFTAR ANGSURAN                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/installment_payment.php?type=all_payment">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  <span>
                    DAFTAR PEMBAYARAN                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/installment_payment.php?type=todays_due_payment">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  <span>
                    PEMBAYARAN JATUH TEMPO HARI INI                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/installment_payment.php?type=all_due_payment">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  <span>
                    SEMUA PEMBAYARAN JATUH TEMPO                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/installment_payment.php?type=expired_due_payment">
                  <svg class="svg-icon"><use href="#icon-expired"></use></svg>
                  <span>
                    PEMBAYARAN JATUH TEMPO KADALUWARSA                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/installment_overview.php">
                  <svg class="svg-icon"><use href="#icon-eye"></use></svg>
                  <span>
                    LAPORAN IKHTISAR                  </span>
                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
                    <a href="https://pondo.co.id/pondopos/admin/purchage_list.php">
            <svg class="svg-icon"><use href="#icon-shopping-bag"></use></svg>
            <span>PEMBELIAN</span>
             <i class="fa fa-angle-left pull-right"></i>
           </a>
                    <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/purchase.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  <span>
                    TAMBAH PEMBELIAN                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/purchase.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  <span>
                    DAFTAR PEMBELIAN                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/purchase.php?type=due">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  <span>
                    STRUK JATUH TEMPO                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/purchase_return.php">
                  <svg class="svg-icon"><use href="#icon-back-arrow"></use></svg>
                  <span>
                    DAFTAR PENGEMBALIAN                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/purchase_log.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                   CATATAN PEMBELIAN                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/transfer.php">
            <svg class="svg-icon"><use href="#icon-transfer"></use></svg>
            <span>
              TRANSFER            </span> 
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/transfer.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                   TAMBAH TRANSFER                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/transfer.php">
                  <svg class="svg-icon"><use href="#icon-transfer"></use></svg>
                  DAFTAR TRANSFER                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/transfer.php?type=receive">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  DAFTAR TERIMA                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/product.php">
            <svg class="svg-icon"><use href="#icon-star"></use></svg>
            <span>
              PRODUK            </span> 
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/product.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  DAFTAR PRODUK                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/product.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  TAMBAH PRODUK                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/barcode_print.php">
                  <svg class="svg-icon"><use href="#icon-barcode"></use></svg>
                  CETAK BARCODE                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/category.php">
                  <svg class="svg-icon"><use href="#icon-category"></use></svg>
                   KATEGORI                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/category.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                   TAMBAH KATEGORI                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/import_product.php">
                  <svg class="svg-icon"><use href="#icon-import"></use></svg>
                  IMPOR PRODUK                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/stock_alert.php">
                  <svg class="svg-icon"><use href="#icon-alert"></use></svg>
                  PERINGATAN STOK                                      <span class="label label-danger bg-yellow">
                      2798                    </span>
                                  </a>
              </li>
                                  </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/customer.php">
            <svg class="svg-icon"><use href="#icon-group"></use></svg>
            <span>
              MEMBER            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/customer.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  <span>
                    TAMBAH MEMBER                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/customer.php">
                  <svg class="svg-icon"><use href="#icon-group"></use></svg>
                  <span>
                    TABEL MEMBER                  </span>
                </a>
              </li>
                        <!--               <li class="">
                <a href="customer_transaction.php">
                  <svg class="svg-icon"><use href="#icon-list"></svg>
                   PERNYATAAN                </a>
              </li>
             -->
          </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/supplier.php">
            <svg class="svg-icon"><use href="#icon-supplier"></use></svg>
            <span>
              PEMASOK            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/supplier.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  <span>
                    TAMBAH PEMASOK                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/supplier.php">
                  <svg class="svg-icon"><use href="#icon-group"></use></svg>
                  <span>
                    TABEL PEMASOK                  </span>
                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/bank_transactions.php?type=report">
            <svg class="svg-icon"><use href="#icon-bank"></use></svg>
            <span>
              AKUTANSI            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a ng-click="BankingDepositModal()" onclick="return false;" href="https://pondo.co.id/pondopos/admin/dashboard.php#">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  SETORAN                </a>
              </li>
                                      <li class="">
                <a ng-click="BankingWithdrawModal()" onclick="return false;" href="https://pondo.co.id/pondopos/admin/bank_account.php">
                  <svg class="svg-icon"><use href="#icon-minus"></use></svg>
                  PENARIKAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/bank_transactions.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  TABEL TRANSAKSI                </a>
              </li>
                                      <li>
                <a ng-click="BankTransferModal()" onclick="return false;" href="https://pondo.co.id/pondopos/admin/bank_account.php">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  TAMBAH TRANSFER                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/bank_transfer.php">
                  <svg class="svg-icon"><use href="#icon-reverse-arrow"></use></svg>
                  DAFTAR TRANSFER                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/bank_account.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  TAMBAH AKUN BANK                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/bank_account.php">
                  <svg class="svg-icon"><use href="#icon-bank"></use></svg>
                  AKUN BANK                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/income_source.php">
                  <svg class="svg-icon"><use href="#icon-sun"></use></svg>
                  SUMBER PEMASUKAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/bank_account_sheet.php">
                  <svg class="svg-icon"><use href="#icon-report"></use></svg>
                  NERACA                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/income_monthwise.php">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  PEMASUKAN BULANAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/expense_monthwise.php?show_top=yes">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  PENGELUARAN BULANAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/report_income_and_expense.php">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  PEMASUKAN DAN PENGELUARAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/report_profit_and_loss.php">
                  <svg class="svg-icon"><use href="#icon-graph"></use></svg>
                  LABA DAN RUGI                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/report_cashbook.php">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  BUKU KAS                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/expense.php">
            <svg class="svg-icon"><use href="#icon-minus"></use></svg>
            <span>
              PENGELUARAN            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/expense.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  BUAT PENGELUARAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/expense.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  TABEL PENGELUARAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/expense_category.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  TAMBAH KATEGORI                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/expense_category.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  KATEGORI                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/expense_monthwise.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  PENGELUARAN BULANAN                </a>
              </li>
                                      <li class="">
                <a ng-click="ExpenseSummaryModal();" onclick="return false;" href="https://pondo.co.id/pondopos/admin/expense.php">
                  <svg class="svg-icon"><use href="#icon-report"></use></svg>
                  RINGKASAN                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/loan.php">
            <svg class="svg-icon"><use href="#icon-loan"></use></svg>
            <span>
              PINJAMAN            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/loan.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  TABEL PINJAMAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/loan.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  AMBIL PINJAMAN                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/loan_summary.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-report"></use></svg>
                  RINGKASAN PINJAMAN                </a>
              </li>
                      </ul>
        </li>
      
      <li class="treeview">
                <a href="https://pondo.co.id/pondopos/admin/report_overview.php">
          <svg class="svg-icon"><use href="#icon-report"></use></svg>
          <span>LAPORAN</span>
           <i class="fa fa-angle-left pull-right"></i>
         </a>
        
        <ul class="treeview-menu">
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_overview.php?type=sell">
                <svg class="svg-icon"><use href="#icon-eye"></use></svg>
                LAPORAN IKHTISAR              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_collection.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                KOLEKSI LAPORAN              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_customer_due_collection.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                KOLEKSI LAPORAN JATUH TEMPO              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_supplier_due_paid.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                LAPORAN SUDAH DIBAYAR              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_sell_itemwise.php"> 
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                LAPORAN PENJUALAN              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_purchase_supplierwise.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                <span>
                  LAPORAN PEMBELIAN                </span>
              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_sell_payment.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                <span>
                  LAPORAN PEMBAYARAN PENJUALAN                </span>
              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_purchase_payment.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                <span>
                  LAPORAN PEMBAYARAN PEMBELIAN                </span>
              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_sell_tax.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                <span>
                  LAPORAN PAJAK                </span>
              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_purchase_tax.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                <span>
                  LAPORAN PAJAK PEMBELIAN                </span>
              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_tax_overview.php">
                <svg class="svg-icon"><use href="#icon-eye"></use></svg>
                <span>
                  LAPORAN IKHTISAR PAJAK                </span>
              </a>
            </li>
          
                      <li class="">
              <a href="https://pondo.co.id/pondopos/admin/report_stock.php">
                <svg class="svg-icon"><use href="#icon-report"></use></svg>
                <span>
                  LAPORAN STOK                </span>
              </a>
            </li>
                    </ul>
      </li>

              <li class="">
          <a href="https://pondo.co.id/pondopos/admin/analytics.php">
            <svg class="svg-icon"><use href="#icon-analytics"></use></svg>
            <span>
              ANALISA            </span>
          </a>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/sms_send.php">
            <svg class="svg-icon"><use href="#icon-sms"></use></svg>
            <span>
              SMS            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/sms_send.php">
                  <svg class="svg-icon"><use href="#icon-paper-plane"></use></svg>
                  <span>
                    KIRIM SMS                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/sms_report.php">
                  <svg class="svg-icon"><use href="#icon-report"></use></svg>
                  <span>
                    LAPORAN SMS                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/sms_setting.php">
                  <svg class="svg-icon"><use href="#icon-settings"></use></svg>
                  <span>
                    PENGATURAN SMS                  </span>
                </a>
              </li>
                      </ul>
        </li>
      
              <li class="treeview">
          <a href="https://pondo.co.id/pondopos/admin/user.php">
            <svg class="svg-icon"><use href="#icon-user"></use></svg>
            <span>
              PENGGUNA            </span> 
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/user.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  <span>
                    TAMBAH PENGGUNA                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/user.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  <span>
                    TABEL PENGGUNA                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/user_group.php?box_state=open">
                  <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                  <span>
                    TAMBAH GRUP PENGGUNA                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/user_group.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  <span>
                    TABEL GRUP PENGGUNA                  </span>
                </a>
              </li>
                                      <li class="">
                <a href="https://pondo.co.id/pondopos/admin/password.php">
                  <svg class="svg-icon"><use href="#icon-password"></use></svg>
                  <span>
                    KATA SANDI                  </span>
                </a>
              </li>
                      </ul>
        </li>
      
              <li class="">
          <a href="https://pondo.co.id/pondopos/admin/filemanager.php">
            <svg class="svg-icon"><use href="#icon-folder"></use></svg>
            <span>
              PENGELOLA FILE            </span>
          </a>
        </li>
      
      
        <li class="treeview">
          
          <a href="https://pondo.co.id/pondopos/admin/store_single.php">
            <svg class="svg-icon"><use href="#icon-settings"></use></svg>
            <span>
              SISTEM            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          
          <ul class="treeview-menu">

                          <li class="treeview">
                <a href="https://pondo.co.id/pondopos/admin/store.php">
                  <svg class="svg-icon"><use href="#icon-list"></use></svg>
                  <span>
                    TOKO                  </span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                                      <li class="">
                      <a href="https://pondo.co.id/pondopos/admin/store_create.php">
                        <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                        BUAT TOKO                      </a>
                    </li>
                                                        <li class="">
                      <a href="https://pondo.co.id/pondopos/admin/store.php">
                        <svg class="svg-icon"><use href="#icon-list"></use></svg>
                        DAFTAR TOKO                      </a>
                    </li>
                                                        <li class="">
                      <a href="https://pondo.co.id/pondopos/admin/store_single.php">
                        <svg class="svg-icon"><use href="#icon-settings"></use></svg>
                        <span>
                          PENGATURAN TOKO                        </span>
                      </a>
                    </li>
                                  </ul>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/receipt_template.php?template_id=1">
                  <svg class="svg-icon"><use href="#icon-report"></use></svg>
                  <span>
                    TEMPLAT STRUK                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/user_preference.php">
                  <svg class="svg-icon"><use href="#icon-heart"></use></svg>
                  <span>
                    PILIHAN PENGGUNA                  </span>
                </a>
              </li>
            
                          <li class="treeview">
                <a href="https://pondo.co.id/pondopos/admin/brand.php">
                  <svg class="svg-icon"><use href="#icon-brand"></use></svg>
                  <span>
                    MEREK                  </span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                                      <li class="">
                      <a href="https://pondo.co.id/pondopos/admin/brand.php?box_state=open">
                        <svg class="svg-icon"><use href="#icon-plus"></use></svg>
                        <span>
                          TAMBAH MEREK                        </span>
                      </a>
                    </li>
                                                        <li class="">
                      <a href="https://pondo.co.id/pondopos/admin/brand.php">
                        <svg class="svg-icon"><use href="#icon-list"></use></svg>
                        <span>
                          DAFTAR MEREK                        </span>
                      </a>
                    </li>
                                  </ul>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/currency.php">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  <span>
                    MATA UANG                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/pmethod.php">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  <span>
                    METODE PEMBAYARAN                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/unit.php">
                  <svg class="svg-icon"><use href="#icon-unit"></use></svg>
                  <span>
                    SATUAN                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/taxrate.php">
                  <svg class="svg-icon"><use href="#icon-money"></use></svg>
                  <span>
                    PERSENTASE PAJAK                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/box.php">
                  <svg class="svg-icon"><use href="#icon-box"></use></svg>
                  <span>
                    BOX                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/printer.php">
                  <svg class="svg-icon"><use href="#icon-printer"></use></svg>
                  <span>
                    PRINTER                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/language.php?lang=en">
                  <svg class="svg-icon"><use href="#icon-star"></use></svg>
                  <span>
                    BAHASA                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/backup_restore.php">
                  <svg class="svg-icon"><use href="#icon-backup"></use></svg>
                  <span>
                    PULIHKAN CADANGAN                  </span>
                </a>
              </li>
            
                          <li class="">
                <a href="https://pondo.co.id/pondopos/admin/reset.php">
                  <svg class="svg-icon"><use href="#icon-minus"></use></svg>
                  <span>
                    SETEL ULANG                  </span>
                </a>
              </li>
            
          </ul>
        </li>
      
              <li class="">
          <a href="https://pondo.co.id/pondopos/store_select.php">
            <svg class="svg-icon"><use href="#icon-list"></use></svg>
            <span>
              GANTI TOKO            </span>
          </a>
        </li>
            <li id="sidebar-bottom"></li>
    </ul>
    
  </section>
</aside>
<!-- Main Sidebar End -->


    <footer class="main-footer">
    	<div class="pull-right hidden-xs">
            Versi            3.3    	</div>
    	<div class="copyright">Copyright © 2022 <a href="http://pondo.co.id/">Pondo.co.id</a>, All rights reserved.</div>
    </footer>
</div>
<!-- End Wrapper -->

<!-- Start Filter Box -->
<div id="filter-box" class="text-center">
    <div class="jumbotron">
        <div class="container">
            <form action="" method="get">
                <?php if (!empty($request->get)) : ?>
                    <?php foreach ($request->get as $key => $value) : ?>
                      <?php if (!in_array($key, array('from', 'to'))) : ?>
                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                      <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="col-md-1"></div>
                <div class="col-md-4 form-group-lg">
                    <input class="form-control date" type="date" name="from" value="<?php echo isset($request->get['from']) ? $request->get['from'] : null;?>" placeholder="From" readonly>
                </div>
                <div class="col-md-4 form-group-lg">
                    <input class="form-control date" type="date" name="to" value="<?php echo isset($request->get['to']) ? $request->get['to'] : null;?>" placeholder="To" readonly>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-block btn-lg btn-danger" type="submit">
                        <span class="fa fa-search"></span>
                    </button>
                </div>
                <div class="col-md-1"></div>
            </form>
        </div>
    </div>
    <div id="close-filter-box">
        <span class="fa fa-angle-up" title="Close"></span>
    </div>
</div>
<!-- End Filter Box -->

<script type="text/javascript">
var from = "<?php echo date('Y/m/d'); ?>";
var to = "<?php echo date('Y/m/d'); ?>";
</script>

<!-- Runtime JS -->

<noscript>
    <div class="global-site-notice noscript">
        <div class="notice-inner">
            <p><strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                your browser to utilize the functionality of #MODERN POS.</p>
        </div>
    </div>
</noscript>

</body>
</html>