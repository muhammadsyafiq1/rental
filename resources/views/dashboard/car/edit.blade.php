@extends('layouts.app')

@section('title')
	Detail {{$car->nama_mobil}}
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-12 col-lg-sm-6">
        <h1 class="m-0">Detail Mobil</h1> - {{$car->user->name ?? 'Akun telah dihapus'}}
      </div><!-- /.col-12 col-lg -->
      <div class="col-12 col-lg-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('car.index')}}">Data Mobil</a></li>
          <li class="breadcrumb-item active">Detail {{$car->nama_mobil}}</li>
        </ol>
      </div><!-- /.col-12 col-lg -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
	<div class="col-12">
		@if (session('status'))
	      <div class="alert alert-warning text-center">
	          {{session('status')}}
	      </div>
		@endif
	</div>
</div>
<div class="card">
		<div class="card-header">
			<div class="card-title">
				{{$car->nama_mobil}} - {{$car->status}}
			</div>
		</div>
		<form method="post" action="{{route('car.update',$car->id)}}" enctype="multipart/form-data">
			@csrf @method('put')
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-lg-5">
						<img src="{{Storage::url($car->gallery->first()->foto ?? '')}}" class="w-100 img-rounded">
						 <div class="row mt-4">
						 	 <div class="col-12 col-lg-6 form-group">
			                  <label for="stnk_mobil">Nomor STNK</label>
			                  <input value="{{old('stnk_mobil') ? old('stnk_mobil') : $car->stnk_mobil}}" type="text" name="stnk_mobil" class="form-control @error('stnk_mobil') is-invalid @enderror" id="stnk_mobil">
			                  @error('stnk_mobil')
			                      <span class="invalid-feedback" role="alert">
			                          <strong>{{ $message }}</strong>
			                      </span>
			                  @enderror
			                </div>
			                <div class="col-12 col-lg-6 form-group">
			                  <label for="nomor_plat">Nomor Plat</label>
			                  <input value="{{old('nomor_plat') ? old('nomor_plat') : $car->nomor_plat}}"  type="text" name="nomor_plat" class="form-control @error('nomor_plat') is-invalid @enderror" id="nomor_plat">
			                  @error('nomor_plat')
			                      <span class="invalid-feedback" role="alert">
			                          <strong>{{ $message }}</strong>
			                      </span>
			                  @enderror
			                </div>
						</div>
						<div class="row">
		                	<div class="form-group col-12 col-lg-12">
		                      <label for="fasilitas">Fasilitas Mobil</label>
		                      <select name="fasilitas[]" class="form-control @error('fasilitas') is-invalid @enderror fasilitas" multiple></select>
		                      @error('fasilitas')
		                          <span class="invalid-feedback" role="alert">
		                              <strong>{{ $message }}</strong>
		                          </span>
		                      @enderror
			                </div>
			            </div>
					</div>
					<div class="col-12 col-lg-7">
			            <div class="modal-body">
			              <div class="row">
			                  <div class="form-group col-12 col-lg-4">
			                      <label for="nama_mobil">Nama Mobil</label>
			                      <input value="{{old('nama_mobil') ? old('nama_mobil') : $car->nama_mobil}}" name="nama_mobil" type="text" class="form-control @error('nama_mobil') is-invalid @enderror" id="nama_mobil">
			                      @error('nama_mobil')
			                          <span class="invalid-feedback" role="alert">
			                              <strong>{{ $message }}</strong>
			                          </span>
			                      @enderror
			                  </div>
			                  <div class="form-group col-12 col-lg-4">
			                      <label for="kategori_id">Type Mobil</label>
			                      <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
			                        <option value="0"></option>
			                        @foreach($categories as $kategori)
			                          <option value="{{$kategori->id}}" {{$kategori->id == $car->kategori_id ? 'selected' : ''}}>
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
			                  <div class="form-group col-12 col-lg-4">
			                      <label for="harga_rental">Harga Rental</label>
			                      <input value="{{old('harga_rental') ? old('harga_rental') : $car->harga_rental}}" name="harga_rental" type="text" class="form-control @error('harga_rental') is-invalid @enderror" id="harga_rental">
			                      @error('harga_rental')
			                          <span class="invalid-feedback" role="alert">
			                              <strong>{{ $message }}</strong>
			                          </span>
			                      @enderror
			                  </div>
			                </div>
			               <div class="row">
			                  <div class="form-group col-12 col-lg-6">
			                      <label for="warna_mobil">Warna Mobil</label>
			                      <input value="{{old('warna_mobil') ? old('warna_mobil') : $car->warna_mobil}}"  name="warna_mobil" type="text" class="form-control @error('warna_mobil') is-invalid @enderror" id="warna_mobil">
			                      @error('warna_mobil')
			                          <span class="invalid-feedback" role="alert">
			                              <strong>{{ $message }}</strong>
			                          </span>
			                      @enderror
			                  </div>
			                  <div class="form-group col-12 col-lg-6">
			                      <label for="tranmisi_mobil ">Transmisi Mobil</label>
			                      <select class="form-control @error('tranmisi_mobil') is-invalid @enderror" name="tranmisi_mobil">
			                      	<option value="manual" {{$car->tranmisi_mobil == 'manual' ? 'selected' : ''}} >Manual</option>
			                      	<option value="matic" {{$car->tranmisi_mobil == 'matic' ? 'selected' : ''}} >Matic</option>
			                      </select>
			                  </div>
			              </div>
			              <div class="row">
			                  <div class="form-group col-12 col-lg-6">
			                      <label for="jumlah_kursi">Kursi Mobil</label>
			                      <input value="{{old('jumlah_kursi') ? old('jumlah_kursi') : $car->jumlah_kursi}}"  name="jumlah_kursi" type="number" class="form-control @error('jumlah_kursi') is-invalid @enderror" id="jumlah_kursi">
			                      @error('jumlah_kursi')
			                          <span class="invalid-feedback" role="alert">
			                              <strong>{{ $message }}</strong>
			                          </span>
			                      @enderror
			                  </div>
			                  <div class="form-group col-12 col-lg-6">
			                      <label for="jumlah_pintu">Pintu Mobil</label>
			                      <input value="{{old('jumlah_pintu') ? old('jumlah_pintu') : $car->jumlah_pintu}}"  name="jumlah_pintu" type="number" class="form-control @error('jumlah_pintu') is-invalid @enderror" id="jumlah_pintu">
			                      @error('jumlah_pintu')
			                          <span class="invalid-feedback" role="alert">
			                              <strong>{{ $message }}</strong>
			                          </span>
			                      @enderror
			                  </div>               
			              </div>
			              <div class="row">
			              	<div class="col-12">
			              		  Apakah mobil anda akan dirental <br> dengan lepas kunci ?
			              	</div>
			              </div>
			              <div class="row">
			              	<div class="col-lg-4 col-sm-12">
			              		<div class="form-check">
			                      <input {{$car->lepas_kunci == 1 ? 'checked' : ''}} name="lepas_kunci" value="1" type="radio" class="form-check-input" id="lepas">
			                      <label class="form-check-label" for="lepas">Ya, Lepas kunci</label>
			                    </div>
			              	</div>
			              	<div class="col-lg-4 col-sm-12">
			              		<div class="form-check">
				                    <input {{$car->lepas_kunci == 0 ? 'checked' : ''}} name="lepas_kunci" value="0" type="radio" class="form-check-input" id="tidak">
				                    <label class="form-check-label" for="tidak">Tidak, Saya yg supir</label>
				                 </div>
			              	</div>
			              	<div class="col-lg-4 col-sm-12">
			              		<label>Biaya Sopir / jam</label>
			              		<input type="text" name="biaya_supir" class="form-control" value="{{old('biaya_supir') ? old('biaya_supir') : $car->biaya_supir}}">
			              	</div>
			              </div>
			              <div class="row mt-3">
		                  	<div class="col-12 col-lg-12 form-group">
		                  		<label>Deskripsi Mobil</label>
		                  		<textarea name="deskripsi_mobil" class="form-control @error('deskripsi_mobil') is-invalid @enderror">{{$car->deskripsi_mobil}}</textarea>
		                  		@error('deskripsi_mobil')
		                          <span class="invalid-feedback" role="alert">
		                              <strong>{{ $message }}</strong>
		                          </span>
		                      	@enderror
		                  	</div>
		                  </div>
			            <div class="mt-2 text-center">
			              <button type="submit" class="btn btn-primary btn-block btn-sm">Update</button>
			              <a class="text-muted" href="{{route('car.index')}}"><i class="fa fa-arrow-left"></i> Back</a>
			            </div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<div class="card-title">
			Setting Foto Mobil - {{$car->nama_mobil}}
		</div>
	</div>
	<div class="card-body">
		<div class="row">
          @foreach ($car->gallery as $gallery)
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
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <input name="foto" type="file" id="file" style="display: none;" onchange="form.submit()">
                @if($car->gallery->count() == 6)
                <a class="btn btn-success btn-block mt-3" href="{{route('car.index')}}">
                    Selesai 
                </a>
                @else
                <button class="btn btn-secondary btn-block mt-3" style="margin-bottom: 70px;" onclick="thisFileUpload()" type="button">
                    Add Photo
                </button>
                @endif
              </form>
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
    });

     var fasilitas = {!! $car->fasilitas !!}
    fasilitas.forEach(function(fasilitas){
        var option = new Option(fasilitas.nama_fasilitas, fasilitas.id, true, true);
        $('.fasilitas').append(option).trigger('change');
    });
  </script>

  @push('scripts')
<script>
    function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
@endpush

