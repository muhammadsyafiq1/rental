@extends('layouts.front')

@section('title')
	Detail {{$car->slug}}
@stop

@section('content')
<div class="ftco-blocks-cover-1">
     <div class="ftco-cover-1 overlay innerpage" style="background-image: url('{{Storage::url($car->gallery->first()->foto)}}')">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <h1>Booking Mobil</h1>
              <p>{{$car->nama_mobil}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>{{$car->nama_mobil}} - <span class="text-success" style="font-weight: bold;">{{number_format($car->harga_rental)}}</span> / Day</h2>
        </div>
      </div>
        <div class=" row">
          <div class="col-lg-8 mb-5" >
          	 <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              {{-- @foreach ($car->gallery as $gallery) --}}
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ Storage::url($car->gallery->first()->foto) }}" alt="First slide">
              </div>
              {{-- @endforeach --}}
              @foreach ($car->gallery as $gallery)
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ Storage::url($gallery->foto) }}" alt="">
              </div>
              @endforeach
            </div>
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
          <div class="col-lg-4">
            <div class="card" style="width: 22rem;">
			  <div class="card-header " style="font-weight: bold;">
			    {{$car->nama_mobil}}
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
			    <div class="card-header " style="font-weight: bold;">
				    Teknologi & Fasilitas
				</div>
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
      </div>
    </div>

@endsection