@extends('layouts.app')

@section('title')
	Mobil yang saya rental
@stop

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Riwayat rental saya</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Rental Saya</li>
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
          <th>Gambar Mobil</th>
          <th>Mulai</th>
          <th>Selesai</th>
          <th>Biaya</th>
          <th>Sisa Waktu</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($riwayatRentalSaya as $rentalSaya)
            <tr class="bg-dark">
                @php 
                    $date = date('d-M-Y');
                @endphp
                <td>
                    {{$rentalSaya->car->nama_mobil}} <br>
                    <small class="text-muted text-success">Pemilik : {{$rentalSaya->car->user->name}}</small>
                </td>
                <td>
                    <img src="{{ Storage::url($rentalSaya->car->gallery->first()->foto) }}" class="img-circle elevation-2" width="100">
                </td>
                <td>{{date('d-M-Y',strtotime($rentalSaya->booking->mulai_rental))}}</td>
                <td>{{date('d-M-Y',strtotime($rentalSaya->booking->tanggal_kembali))}}</td>               
                <td>Rp. {{number_format($rentalSaya->total_bayar)}}</td>
                <td>
                    @if(date('d-M-Y',strtotime($date)) >=  date('d-M-Y',strtotime($rentalSaya->booking->tanggal_kembali)))
                        <p style="font-weight: bold;" class="text-danger">Masa rental habis</p>
                    @else
                        <p style="font-weight: bold;" class="text-success">Masa rental masih berlanjut</p>
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