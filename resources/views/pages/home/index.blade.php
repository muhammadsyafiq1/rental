@extends('layouts.front')

@section('title')
    Home
@stop

@section('content')
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>


    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay" style="background-image: url('/frontend/images/hero_1.jpg')">

      </div>
    </div>


    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h3>Mobil Baru masuk</h3>
            <p class="mb-4">Mobil terfavorit yang mungkin kamu sukai untuk perjalananmu.</p>
            <p>
              <a href="#" class="btn btn-primary custom-prev">Previous</a>
              <span class="mx-2">/</span>
              <a href="#" class="btn btn-primary custom-next">Next</a>
            </p>
          </div>
          <div class="col-lg-9">
            <div class="nonloop-block-13 owl-carousel">
              @foreach($cars as $car)
              <div class="item-1">
                <a href="#"><img src="{{ Storage::url($car->gallery->first()->foto ?? '') }}" alt="Image" class="img-fluid"></a>
                <div class="item-1-contents">
                  <div class="text-center">
                  <h3><a href="{{route('detail',$car->id)}}">{{ $car->nama_mobil }}</a></h3>
                  <div class="rating">
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                    <span class="icon-star text-warning"></span>
                  </div>
                  <div class="rent-price"><span>Rp. {{ number_format($car->harga_rental) }} / </span>day</div>
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
                  <div class="d-flex justify-content-between action">
                    <div>
                      <a href="{{route('detail',$car->id)}}" class="btn btn-primary">Detail</a>
                    </div>
                    <div>
                      @auth
                        <a href="{{route('simpan.mobil',$car->id)}}" class="btn btn-warning">Simpan</a>
                      @else
                        <a href="{{route('login')}}" class="btn btn-warning" onclick="return confirm('kamu harus login dulu.')">Simpan</a>
                      @endauth
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section section-3" style="background-image: url('/frontend/images/hero_2.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center mb-5">
            <h2 class="text-white">Service Kami</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-car-1"></span>
              </span>
              <div class="service-1-contents">
                <h3>Keamanan</h3>
                <p>Kami melakukan survey kepada mitra kami agar tidak terjadi kecurangan</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-traffic"></span>
              </span>
              <div class="service-1-contents">
                <h3>Terjamin</h3>
                <p>Kami memberikan jaminan bahwa semuab mobil layak pakai</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="service-1">
              <span class="service-1-icon">
                <span class="flaticon-valet"></span>
              </span>
              <div class="service-1-contents">
                <h3>Responsive</h3>
                <p>Jika terjadi kesalahan segera hubungi admin. kami akan menanggapi secepatnya</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-7 text-center mb-3">
            <h2>Testimonial Pengguna</h2>
            <p>Testimoni dari pengguna rent car. yang akan memberikan kamu gambaran tentang rent car</p>
          </div>
        </div>
        <div class="row">
          @foreach($testimonials as $testimonial)
            <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="testimonial-2">
              <blockquote class="mb-4">
                <q>{{$testimonial->testimonial}}</q>
              </blockquote>
              <div class="d-flex v-card align-items-center">
                <img src="/frontend/images/person_1.jpg" alt="Image" class="img-fluid mr-3">
                <span>{{$testimonial->user->name}}</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        {{$testimonials->links()}}
      </div>
    </div>
@stop

