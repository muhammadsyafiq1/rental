@extends('layouts.app')

@section('title')
    Data master mobil
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data master mobil</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data master mobil</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')

@if (session('status'))
  <div class="alert alert-warning text-center">
      {{session('status')}}
  </div>
@endif

<div class="row">
  @foreach($cars as $car)
  <div class="col-4">
    <div class="card" style="width: 20rem;">
      <div class="gallery-container">
        <img class="card-img-top" src="{{Storage::url($car->gallery->first()->foto)}}" alt="Card image cap">
        <a href="{{route('remove.car',$car->id)}}" class="delete-gallery" onclick="return confirm('Yakin ingin menghapus {{$car->nama_mobil}} ?')">
            <img src="/backend/dist/img/icon-delete.svg">
        </a>
    </div>
      
      <div class="card-body">
        <div class="d-flex justify-content-between" style="font-weight: bold;">
            <div class="text-success">
            <h5>{{$car->nama_mobil}}</h5>
          </div>
          <div class="text-success">
            Rp. {{number_format($car->harga_rental)}} / Day
          </div>
        </div>
        <p class="card-text">
            <li class="text-muted">Transmisi : {{$car->tranmisi_mobil}}</li>
            <li class="text-muted">Color     : {{$car->warna_mobil}}</li>
            <li class="text-muted">Type      : {{$car->kategori->kategori_mobil}}</li>
        </p>
        <a href="{{route('car.edit',$car->id)}}" class="btn btn-sm btn-block btn-info btn-shadow mb-2">Detail / Edit</a>
        @if($car->approved_admin == 'belum')
          <a href="{{route('car.setujui',$car->id)}}" class="btn btn-sm btn-block btn-warning btn-shadow mb-2">Setujui</a>
        @else
          <i class="fa fa-check text-success"></i>
        @endif
      </div>
    </div>
  </div>
  @endforeach
</div>

<style>
  .gallery-container .delete-gallery{
     display: block;
  position: absolute;
  top: -10px;
  right: 0;
  }
</style>
@endsection