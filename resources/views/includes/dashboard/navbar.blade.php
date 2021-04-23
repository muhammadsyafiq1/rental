<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @php 
          $countTransaction = App\Models\Transaction::with(['user','rekening'])->where('status' ,'=', 'pending')->get(); 
      @endphp
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$countTransaction->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          @foreach($countTransaction as $Transaction)
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> "{{$Transaction->user->name}}" Melakukan pendaftaran
              <span class="float-right text-muted text-sm">
                {{\Carbon\Carbon::createFromTimeStamp(strtotime($Transaction->created_at))->diffForHumans()}}
              </span>
            </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('transaction.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>