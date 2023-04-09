<?php session_start(); ?>
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>{{session('store')->store_id}}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{session('store')->name}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href=""><i class="fa fa-cart-plus"></i> <span class="hidden-xs">POS</span></a>
          </li>
          <li>
            <a href=""><i class="fa fa-book"></i> <span class="hidden-xs">BUKU KAS</span></a>
          </li>
          <li>
            <a href="{{route('sell-list')}}"><i class="fa fa-list"></i> <span class="hidden-xs">STRUK</span></a>
          </li>
          <!-- <li>
            <a href="" title="referensi pengguna"><i class="fa fa-heart"></i></a>
          </li>
          <li>
            <a href="" title="pengaturan"><i class="fa fa-cog"></i></a>
          </li> -->
          <li>
            <a href="" title="peringatan stock">
              <i class="fa fa-book"></i>
              <span class="label label-danger">9</span>
            </a>
          </li>
          <!-- <li>
            <a href=""><i class="fa fa-question-circle"></i></a>
          </li> -->
          <li>
            <a href="" title="Layar Penuh"><i class="fa fa-arrows-alt"></i></a>
          </li>
          <li>
            <a href="" title="Laporan"><i class="fa fa-square"></i></a>
          </li>
          <li>
            <a href="" title="Kunci Layar"><i class="fa fa-lock"></i></a>
          </li>
          <li>
            <a title="Logout" data-toggle="modal" data-target="#modal-logout"><i class="fa fa-sign-out"></i></a>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
</header>

<div class="modal fade" id="modal-logout">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">LOGOUT!!!</h4>
      </div>
      <div class="modal-body">
        <p>Do you want to logout</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Ok</button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>