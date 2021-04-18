<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Rental Mobil</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (Auth::user()->avatar)
              <img src="{{ Storage::url(Auth::user()->avatar) }}" class="img-circle elevation-2">
          @else
              <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" height="60" class="img-circle elevation-2" />
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setting-profile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting Profile</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Data Master Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('category.index')}}" class="nav-link">
              <i class="nav-icon fa fa-list"></i>
              <p>
                Kategori Mobil
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{route('fasilitas.index')}}" class="nav-link">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Fasilitas Mobil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('car.index')}}" class="nav-link">
              <i class="nav-icon fa fa-car"></i>
              <p>
                Data Master Mobil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
            <form id="logout-form" action="{{url('/logout')}}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>