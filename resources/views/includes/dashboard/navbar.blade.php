<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    @if(Auth::user()->roles == 1)
    <ul class="navbar-nav ml-auto">
      @php 
          $mobilBaruDaftar = App\Models\Car::with(['user'])->where('approved_admin' ,'=', 'belum')->get(); 
      @endphp
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$mobilBaruDaftar->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          @foreach($mobilBaruDaftar as $mbd)
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> "{{$mbd->user->name}}" Melakukan pendaftaran
              <span class="float-right text-muted text-sm">
                {{\Carbon\Carbon::createFromTimeStamp(strtotime($mbd->created_at))->diffForHumans()}}
              </span>
            </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('car.semuamobil')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
    @else(Auth::user()->roles == 2)
    <ul class="navbar-nav ml-auto">
      @php 
          $rentalMasuk = App\Models\Booking_detail::with(['booking.user','car'])
                          ->whereHas('car', function($car){
                          $car->where('user_id', \Auth::user()->id)->where('status','tersedia');
          })->get();
      @endphp
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$rentalMasuk->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          @foreach($rentalMasuk as $rm)
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> "{{$rm->booking->user->name}}" Merental Mobil {{$rm->car->nama_mobil}}
              <span class="float-right text-muted text-sm">
                {{\Carbon\Carbon::createFromTimeStamp(strtotime($rm->created_at))->diffForHumans()}}
              </span>
            </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('car.semuamobil')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
    @endif
  </nav>