@extends('layouts.front')

@section('title')
	Semua mobil
@stop

@section('content')


<div class="ftco-blocks-cover-1">
  <div class="ftco-cover-1 overlay innerpage" style="background-image: url('/frontend/images/hero_2.jpg')">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 text-center">
          <h1>Semua mobil rental</h1>
          <p>Terdapat sebanyak <span class="text-warning" style="font-weight: bold;">{{$totCar}}</span> yang bekerja sama dengan rent car.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section pt-0 pb-0 bg-light">
<div class="container">
    <div class="row">
      <div class="col-12"> 
          <form class="trip-form">
            <div class="row align-items-center mb-4">
              <div class="col-md-6">
                <h3 class="m-0">Begin your trip here</h3>
              </div>
              <div class="col-md-6 text-md-right">
                <span class="text-primary">{{$totCar}}</span> <span>Mobil Tersedia</span></span>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="cf-1">Where you from</label>
                <input type="text" id="cf-1" placeholder="Your pickup address" class="form-control">
              </div>
              <div class="form-group col-md-3">
                <label for="cf-2">Where you go</label>
                <input type="text" id="cf-2" placeholder="Your drop-off address" class="form-control">
              </div>
              <div class="form-group col-md-3">
                <label for="cf-3">Journey date</label>
                <input type="text" id="cf-3" placeholder="Your pickup address" class="form-control datepicker px-3">
              </div>
              <div class="form-group col-md-3">
                <label for="cf-4">Return date</label>
                <input type="text" id="cf-4" placeholder="Your pickup address" class="form-control datepicker px-3">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>

<div class="site-section bg-light">
  <div class="container">
    <div class="row">
    @foreach($cars as $car)
    	<div class="col-lg-4 col-md-6 mb-4">
	        <div class="item-1">
	            <a href="{{route('detail',$car->slug)}}"><img src="{{ Storage::url($car->gallery->first()->foto) }}" alt="Image" class="img-fluid"></a>
	            <div class="item-1-contents">
	              <div class="text-center">
	              <h3><a href="#">{{$car->nama_mobil}}</a></h3>
	              <div class="rent-price"><span>Rp. {{number_format($car->harga_rental)}}/</span>day</div>
	              </div>
	              	<ul class="specs">
                    <li>
                      <span>Pintu</span>
                      <span class="spec">{{$car->jumlah_pintu}}</span>
                    </li>
                    <li>
                      <span>Tempat duduk</span>
                      <span class="spec">{{ $car->jumlah_kursi }}</span>
                    </li>
                    <li>
                      <span>Tranmisi</span>
                      <span class="spec">{{ $car->tranmisi_mobil }}</span>
                    </li>
                    <li>
                      <span>Type</span>
                      <span class="spec">{{$car->kategori->kategori_mobil}}</span>
                    </li>
                  </ul>
	              <div class="d-flex action">
	                <a href="{{route('detail',$car->slug)}}" class="btn btn-primary">Detail</a>
	              </div>
	            </div>
	        </div>
      	</div>  
    @endforeach
    </div>
    <div class="row">
    	<div class="col-12">
    		{{$cars->links()}}
    	</div>
    </div>
  </div>
</div>
@stop