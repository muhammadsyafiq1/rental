@extends('layouts.front')

@section('title')
	Detail {{$car->slug}}
@stop

@section('content')
@php 
	$tot = $car->harga_rental + $car->biaya_supir; 
@endphp
<div class="ftco-blocks-cover-1">
 <div class="ftco-cover-1 overlay innerpage" style="background-image: url('{{Storage::url($car->gallery->first()->foto ?? '')}}')">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 text-center">
          <h1>Reservasi Mobil</h1>
          <p>{{$car->nama_mobil}}</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="sitesty-section bg-light" id="contact-section">
  <div class="container">
    <div class="row justify-content-center text-center">
    <div class="col-7 text-center pt-4 pb-4">
    	{{-- tidak 0 lepas 1 --}}
      @if($car->lepas_kunci == 1)
      	<h2>
      	{{$car->nama_mobil}} - 
      	<span class="text-success" style="font-weight: bold;">
      		{{number_format($car->harga_rental)}}
      	</span> 
      	/ Day
      </h2>
      @else
      <h2>
      	{{$car->nama_mobil}} - 
      	<span class="text-success" style="font-weight: bold;">
      		{{number_format($tot)}}
      	</span> 
      	/ Day
      </h2>
      @endif
    </div>
  </div>
    <div class=" row">
      <div class="col-lg-7 mb-5" >
      	 <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              {{-- @foreach ($car->gallery as $gallery) --}}
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ Storage::url($car->gallery->first()->foto ?? '') }}" alt="First slide">
              </div>
              {{-- @endforeach --}}
              @foreach ($car->gallery as $gallery)
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ Storage::url($gallery->foto) }}" alt="">
              </div>
              @endforeach
            </div>
            {{-- form --}}
            <div class="row pt-3" >
            	<div class="col-lg-6 col-sm-12">
            		<div class="card" style="width: 19rem;">
					  <div class="card-header " style="font-weight: bold;">
					    {{$car->nama_mobil}}
					  </div>
					  <ul class="list-group list-group-flush">
					  	<li class="d-flex justify-content-between list-group-item">
					    	<div class="">
					    		Lepas kunci <br>
					    		@if($car->lepas_kunci == 0)
					    		<span style="font-size: 12px;">Biaya Supir</span>
					    		@endif
					    	</div>
					    	<div class="text-success">
					    		{{$car->lepas_kunci == 0 ? 'Tidak' : 'Iya'}} <br>
					    		@if($car->lepas_kunci == 0)
					    		<span class="text-warning" style="font-size: 12px;">+ {{number_format($car->biaya_supir)}}</span>
					    		@endif
					    	</div>
					    </li>
					    <li class="d-flex justify-content-between list-group-item">
					    	<div class="">
					    		Kursi
					    	</div>
					    	<div class="text-success">
					    		{{$car->jumlah_kursi}}  Unit
					    	</div>
					    </li>
					    <li class="d-flex justify-content-between list-group-item">
					    	<div class="">
					    		Pintu
					    	</div>
					    	<div class="text-success">
					    		{{$car->jumlah_pintu}}  Unit
					    	</div>
					    </li>
					    <li class="d-flex justify-content-between list-group-item">
					    	<div class="">
					    		Warna
					    	</div>
					    	<div class="text-success">
					    		{{$car->warna_mobil}} 
					    	</div>
					    </li>
					    
					  </ul>
					</div>
            	</div>
            	<div class="col-lg-6 col-sm-12">
            		<div class="card">
            			<div class="card-header " style="font-weight: bold;">
						    Teknologi & Fasilitas
						</div>
            			<ul class="list-group list-group-flush">          	
							 <li class="d-flex justify-content-between list-group-item">
						    	<div class="">
						    		Type
						    	</div>
						    	<div class="text-success">
						    		{{$car->kategori->kategori_mobil}}
						    	</div>
						    </li>
						     <li class="d-flex justify-content-between list-group-item">
						    	<div class="">
						    		Tranmisi
						    	</div>
						    	<div class="text-success">
						    		{{$car->tranmisi_mobil}}
						    	</div>
						    </li>
						     <li class="d-flex justify-content-between list-group-item">
						    	<div class="">
						    		Fasilitas
						    	</div>
						    	<div class="text-success">
						    		@foreach($car->fasilitas as $fasilitas)
						    			&middot; {{$fasilitas->nama_fasilitas}}
						    		@endforeach
						    	</div>
						    </li>
            			</ul>
            		</div>
            	</div>
            </div>
          	{{-- endform --}}
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      </div>
      <div class="col-lg-5">
      	<form action="{{route('booking.store')}}" method="post">
      		@csrf
      		<input type="hidden" name="tot" value="{{$tot}}">
	      	<input type="hidden" name="car_id" value="{{$car->id}}">
	        <div class="row">
	        	<div class="form-group col-lg-6 col-sm-12">
		            <label for="cf-3">Journey date</label>
		            <input required name="mulai_rental" type="text" id="cf-3" placeholder="Your pickup address" class="form-control datepicker px-3">
		          </div>
		          <div class="form-group col-lg-6 col-sm-12">
		            <label required for="cf-4">Return date</label>
		            <input name="tanggal_kembali" type="text" id="cf-4" placeholder="Your pickup address" class="form-control datepicker px-3">
		        </div>
		        <div class="form-group col-12">
		        	<label>Lokasi tujuan anda</label>
		        	<input required type="text" name="lokasi_tujuan" class="form-control" autocomplete>
		        </div>
		        <div class="form-group col-12">
		        	<label>Berapa orang</label>
		        	<input required type="number" name="berapa_orang" class="form-control" autocomplete>
		        </div>
		        <div class="form-group col-12">
		        	<span>Apakah anda ingin mobil diantar ketempat anda ?</span> <br>
		        	<div class="form-check">
					  <input  class="form-check-input" type="radio" name="exampleRadios" id="tombol_show" value="option1">
					  <label class="form-check-label" for="tombol_show">
					    Iya terimakasih, Silahkan diantar
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="exampleRadios" id="tombol_hide" value="option2">
					  <label class="form-check-label" for="tombol_hide">
					    Tidak terimakasih, saya yang akan menjemput
					  </label>
					</div>
		        </div>
				
		        <div class="form-group col-12" id="box">
		        	<label for="keterangan_detail">Lokasi detail pengantaran Mobil</label>
		        	<textarea name="lokasi_detail" class="form-control"></textarea>
		        </div>
		        <div class="form-group col-12">
		        	@auth
						@if($car->status == 'dirental')
			        		<button class="btn btn-block btn-sm btn-warning" type="submit" disabled>
								Sedang dirental
							</button>
						@else
							@if(Auth::user()->photo_ktp == NULL)
			        		<a href="{{route('home')}}" onClick="return confirm('lengkapi profil anda terlebih dahulu')" class="btn btn-block btn-sm btn-warning" type="button">Reservasi</a>
			        		@else
			        		<button class="btn btn-block btn-sm btn-warning" type="submit">Reservasi</button>
			        		@endif
						@endif

			        	<button class="btn btn-block btn-sm btn-success" type="submit">Telefon</button>
		        	@else
			        	<a href="{{route('login')}}" onclick="return confirm('Sebelum order kamu harus login dulu sebelum lakukan order.')" class="btn btn-block btn-sm btn-warning" type="submit">Order</a>
			        	<a href="{{route('login')}}" onclick="return confirm('Sebelum order kamu harus login dulu untuk melakukan contact.')" class="btn btn-block btn-sm btn-success" type="submit">Telefon</a>
		        	@endauth
		        </div>
	        </div>
      	</form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
   $(document).ready(function() {
  
     $("#tombol_hide").click(function() {
       $("#box").hide();
     })
  
     $("#tombol_show").click(function() {
       $("#box").show();
     })
  
   });
   </script>
@endpush