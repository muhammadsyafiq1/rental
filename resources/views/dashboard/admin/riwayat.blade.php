@extends('layouts.app')

@section('title')
	Mobil dirental
@stop

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Mobil Dirental</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Rental</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card">
  @if (session('status'))
      <div class="alert alert-primary">
          {{session('status')}}
      </div>
  @endif
  <div class="card-body">
    <table id="tb_riwayat" class="table table-striped">
      <thead>
        <tr>
          <th>Mobil Rental</th>
          <th>Foto CS / KTP</th>
          <th>Nama CS</th>
          <th>Handphone CS</th>
          <th>Mulai</th>
          <th>Selesai</th>
          <th>Biaya</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dataSimpanBooking as $booking)
              <tr class="bg-dark">
                <td>{{$booking->car->nama_mobil}}</td>
              	<td>
              	  @if ($booking->booking->user->avatar)
		              <img src="{{ Storage::url($booking->booking->user->avatar) }}" class="img-circle elevation-2" height="60">
                  <br>
                  <a href="{{Storage::url($booking->booking->user->photo_ktp)}}">Ktp</a>
		          @else
		              <img src="https://ui-avatars.com/api/?name={{ $booking->booking->user->name }}" height="60" class="img-circle elevation-2" /> <br>
                  <a href="{{Storage::url($booking->booking->user->photo_ktp)}}"> Ktp</a>

		          @endif
              	</td>
              	<td>{{$booking->booking->user->name}}</td>
              	<td>{{$booking->booking->user->phone}}</td>
              	<td>{{date('d-M-Y'.strtotime($booking->booking->tanggal_mulai))}}</td>
              	<td>{{date('d-M-Y',strtotime($booking->booking->tanggal_kembali))}}</td>               <td>Rp. {{number_format($booking->total_bayar)}}</td>
              	<td>
              		@if($booking->car->status == 'dirental')
              			<a href="{{route('booking.selesai-rental',$booking->car->id)}}" class="btn btn-sm btn-success">
              				Dikembalikan
              			</a>
              		@elseif($booking->car->status == 'tersedia')
                    <a href="{{route('booking.rental',$booking->car->id)}}" class="btn btn-sm btn-warning">
                      Rentalkan
                    </a>
                  @endif
              	</td>
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection

@push('scripts')
    <script>
      $(document).ready(function(){
        $('#tb_riwayat').DataTable();
      });
    </script>
@endpush