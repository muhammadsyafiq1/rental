@extends('layouts.app')

@section('title')
    Data Mobil
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Mobil</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('car.index')}}">Data Mobil</a></li>
          <li class="breadcrumb-item active">Gambar Mobil</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card">
  @if (session('status'))
      <div class="alert alert-warning text-center">
          {{session('status')}}
      </div>
  @endif
  <div class="card-body">
    <div class="card-header">
      <div class="card-title">
        Tambahkan Foto Mobil
      </div>
    </div>
    <div class="card-body">
      <div class="row">
          @foreach ($cars->gallery as $gallery)
          <div class="col-md-4">
              <div class="gallery-container">
                  <img src="{{ Storage::url($gallery->foto) }}" class="w-100">
                  <a href="{{ route('remove.image',$gallery->id) }}" class="delete-gallery">
                      <img src="/backend/dist/img/icon-delete.svg">
                  </a>
              </div>
          </div>
          @endforeach
          <div class="col-12">
              <form action="{{route('gallery.store')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                @error('foto')
                  <span class="invalid-feedback">
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  </span>
                @enderror
                <input type="hidden" name="car_id" value="{{ $cars->id }}">
                <input name="foto" type="file" id="file" style="display: none;" onchange="form.submit()">
                @if($cars->gallery->count() == 3)
                <a class="btn btn-success btn-block mt-3" href="{{route('car.index')}}">
                    Selesai 
                </a>
                @else
                <button class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()" type="button">
                    Add Photo
                </button>
                @endif
              </form>
          </div>
      </div>
    </div>
  </div>
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

@push('scripts')
<script>
    function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
@endpush