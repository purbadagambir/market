@php  $menus = menu(); @endphp

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->username}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu</li>
        @foreach($menus as $menu)
        @if(count($menu->children) > 0)
        <li class="treeview">
          <a href="#">
            <i class="{{$menu->icon}}"></i> <span>{{$menu->label}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @foreach($menu->children as $submenu)
            @if(count($submenu->subchildren) > 0)
            <li class="treeview">
              <a href="#"><i class="{{$submenu->icon}}"></i> {{$submenu->label}}
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @foreach($submenu->subchildren as $subsubmenu)
                <li><a href="{{$subsubmenu->route}}"><i class="{{$submenu->icon}}"></i> {{$subsubmenu->label}}</a></li>
                @endforeach
              </ul>
            </li>
            @else
            <li><a href="{{$submenu->route}}"><i class="{{$submenu->icon}}"></i> {{$submenu->label}}</a></li>
            @endif
            @endforeach
          </ul>
        </li>
        @else
        <li>
          <a href="{{$menu->route}}">
            <i class="{{$menu->icon}}"></i> <span>{{$menu->label}}</span>
          </a>
        </li>
        @endif
        @endforeach
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>