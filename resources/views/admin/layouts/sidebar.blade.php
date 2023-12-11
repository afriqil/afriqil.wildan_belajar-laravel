<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('admin/dashboard')}}" class="brand-link">
    <img src="{{asset('AdminLTE')}}/dist/img/af.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Feekzz</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if(!empty(Auth::guard('admin')->user()->image))
        <img src="{{asset('AdminLTE/dist/img/photos/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        @else
        <img src="{{asset('AdminLTE')}}/dist/img/Afriqil-user.jpg" class="img-circle elevation-2" alt="User Image">
        @endif
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        @if(session()->get('pages') == "dashboard")
        @php $active = "active" @endphp
        @else
        @php $active = "" @endphp
        @endif
        <li class="nav-item">
          <a href="{{ url('admin/dashboard')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @if(Auth::guard('admin')->user()->type=="admin")
        @php
        $active = '';
        if(session()->get('pages') == "update-password" || session()->get('pages') == "update-details") {
        $active = "active";
        }
        @endphp

        <li class="nav-item menu-list">
          <a href="#" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Setting Admin
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(session()->get('pages') == "update-password")
            @php $active = "active" @endphp
            @else
            @php $active = "" @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('admin/update-password')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Update Admin Password</p>
              </a>
            </li>
            @if(session()->get('pages') == "update-details")
            @php $active = "active" @endphp
            @else
            @php $active = "" @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('admin/update-details')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Update Admin Details</p>
              </a>
            </li>
          </ul>
        </li>
        @if(session()->get('pages') == "subadmins")
        @php $active = "active" @endphp
        @else
        @php $active = "" @endphp
        @endif
        <li class="nav-item">
          <a href="{{url('admin/subadmins')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Sub Admins
            </p>
          </a>
        </li>
        @endif

        @if(session()->get('pages') == "cms-pages")
        @php $active = "active" @endphp
        @else
        @php $active = "" @endphp
        @endif
        <li class="nav-item">
          <a href="{{url('admin/cms-pages')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              CMS Pages
            </p>
          </a>
        </li>

        @php
              $active = '';
              if(session()->get('pages') == "categories" || session()->get('pages') == "products") {
              $active = "active";
              }
              @endphp
        <li class="nav-item menu-list">
          <a href="#" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Catalogues
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if(session()->get('pages') == "categories")
            @php $active = "active" @endphp
            @else
            @php $active = "" @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('admin/categories')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>categories</p>
              </a>
            </li>
            @if(session()->get('pages') == "products")
            @php $active = "active" @endphp
            @else
            @php $active = "" @endphp
            @endif
            <li class="nav-item">
              <a href="{{url('admin/products')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>products</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
  <!-- /.sidebar -->
</aside>
<!-- Main Sidebar Container -->