<header class="site-navbar site-navbar-target" role="banner">

  <div class="container">
    <div class="row align-items-center position-relative">

      <div class="col-3 ">
        <div class="site-logo">
          <a href="index.html">CarRent</a>
        </div>
      </div>

      <div class="col-9  text-right">
        

        <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

        

        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
          <ul class="site-menu main-menu js-clone-nav ml-auto ">
            <li class="active"><a href="index.html" class="nav-link">Home</a></li>
            <li><a href="{{route('lihat-semua-mobil')}}" class="nav-link">Mobil Rental</a></li>
            <li><a href="cars.html" class="nav-link">Kontak</a></li>
            <li><a href="about.html" class="nav-link">Tentang</a></li> | 
            @auth
            <li><a href="{{route('home')}}" class="nav-link ">Dashboard Saya</a></li>
            @else
            <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
            <li><a href="{{route('register')}}" class="nav-link">Register</a></li>
            @endauth
          </ul>
        </nav>
      </div>

      
    </div>
  </div>

</header>