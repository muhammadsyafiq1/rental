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
          <li class="breadcrumb-item active">Data Mobil</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row mb-4">
  <div class="col-12">
    <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"> Tambah Mobil</i>
      </button>
  </div>
</div>

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
        <a href="{{route('car.edit',$car->id)}}" class="btn btn-sm btn-block btn-info btn-shadow">Detail / Edit</a>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Mobil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('car.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="row">
                  <div class="form-group col-4">
                      <label for="nama_mobil">Nama Mobil</label>
                      <input name="nama_mobil" type="text" class="form-control @error('nama_mobil') is-invalid @enderror" id="nama_mobil">
                      @error('nama_mobil')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group col-4">
                      <label for="kategori_id">Type Mobil</label>
                      <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                        <option value="0"></option>
                        @foreach($categories as $kategori)
                          <option value="{{$kategori->id}}">
                            {{$kategori->kategori_mobil}}
                          </option>
                        @endforeach
                      </select>
                      @error('kategori_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group col-4">
                      <label for="fasilitas">Fasilitas Mobil</label>
                      <select style="width: 250px;" name="fasilitas[]" class="form-control @error('fasilitas') is-invalid @enderror fasilitas" multiple></select>
                      @error('fasilitas')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
               <div class="row">
                  <div class="form-group col-6">
                      <label for="warna_mobil">Warna Mobil</label>
                      <input name="warna_mobil" type="text" class="form-control @error('warna_mobil') is-invalid @enderror" id="warna_mobil">
                      @error('warna_mobil')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group col-6">
                      <label for="tranmisi_mobil">Transmisi Mobil</label>
                      <select name="tranmisi_mobil" class="form-control @error('tranmisi_mobil') is-invalid @enderror">
                        <option value="0"></option>
                        <option value="manual">Manual</option>
                        <option value="matic">Matic</option>
                      </select>
                      @error('tranmisi_mobil')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-3">
                      <label for="jumlah_kursi">Kursi Mobil</label>
                      <input name="jumlah_kursi" type="number" class="form-control @error('jumlah_kursi') is-invalid @enderror" id="jumlah_kursi">
                      @error('jumlah_kursi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group col-3">
                      <label for="jumlah_pintu">Pintu Mobil</label>
                      <input name="jumlah_pintu" type="number" class="form-control @error('jumlah_pintu') is-invalid @enderror" id="jumlah_pintu">
                      @error('jumlah_pintu')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group col-3">
                      <label for="panjang_mobil">Panjang Mobil / Cm</label>
                      <input name="panjang_mobil" type="number" class="form-control @error('panjang_mobil') is-invalid @enderror" id="panjang_mobil">
                      @error('panjang_mobil')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group col-3">
                      <label for="tinggi_mobil">Tinggi Mobil / Cm</label>
                      <input name="tinggi_mobil" type="number" class="form-control @error('tinggi_mobil') is-invalid @enderror" id="tinggi_mobil">
                      @error('tinggi_mobil')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="col-12">
                    Apakah mobil anda akan dirental dengan lepas kunci ?
                  </div>
                  <div class="col-3">
                    <div class="form-check">
                      <input name="lepas_kunci" value="1" type="radio" class="form-check-input" id="lepas">
                      <label class="form-check-label" for="lepas">Ya, Lepas kunci</label>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-check">
                    <input name="lepas_kunci" value="0" type="radio" class="form-check-input" id="tidak">
                    <label class="form-check-label" for="tidak">Tidak, Saya sebagai sopir</label>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-4 form-group">
                  <label for="stnk_mobil">Nomor STNK</label>
                  <input type="text" name="stnk_mobil" class="form-control @error('stnk_mobil') is-invalid @enderror" id="stnk_mobil">
                  @error('stnk_mobil')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-4 form-group">
                  <label for="nomor_plat">Nomor Plat</label>
                  <input type="text" name="nomor_plat" class="form-control @error('nomor_plat') is-invalid @enderror" id="nomor_plat">
                  @error('nomor_plat')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-4 form-group">
                  <label for="umur_mobil">Umur Mobil</label>
                  <input type="text" name="umur_mobil" class="form-control @error('umur_mobil') is-invalid @enderror" id="umur_mobil">
                  @error('umur_mobil')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
            <div class="mt-3">
              <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>
            <button type="button" class="btn btn-secondary btn-block btn-sm" data-dismiss="modal">Close</button>
            </div>
        </form>
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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function () {
      $('.fasilitas').select2({
        placeholder: 'Loading ...',
        ajax: {
          url: "http://127.0.0.1:8000/ajax/fasilitas-mobil/search",
          delay: 450,
          processResults: function({data}) {
            return {
              results: $.map(data, function (item) {
                return {
                  text: `${item.nama_fasilitas}`,
                  id: item.id,
                }
              })
            };
          },
          cache: true
        }
      });
    })
  </script>
@endpush