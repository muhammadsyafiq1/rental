@extends('layouts.app')

@section('title')
    Daftar mitra
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar mitra rental</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Daftar mitra rental</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <h5 style="font-weight: bold;" class="mb-3">Syarat dan ketentuan menjadi mitra</h5>
    <div class="alert alert-warning">
      Harap Lengkapi dahulu data pribadi anda pada menu profile. agar pendaftaran anda terhitung valid !
    </div>
    <ul>
      <li class="nav-item">Memberikan pelayanan sebaik-baiknya pada customer</li>
      <li class="nav-item">Tidak melakukan penipuan dan kecurangan</li>
      <li class="nav-item">Benar-benar mendaftarkan mobil yang layak digunakan</li>
      <li class="nav-item">Berdomisili disekitar kampar</li>
      <li class="nav-item">Rent car akan menindak siapapun yang melakukan hal yg melanggar hukum</li>
      <li class="nav-item">Rent car berdiri dibawah payung hukum yang berlaku di indonesia</li>
      <li class="nav-item">Tidak melakukan rental palsu. jika terjadi maka account akan dihapus</li>
    </ul>

    <ul>
      <li class="nav-item">Biaya menjadi mitra rent car perbulannya sebesar 50000</li>
      <li class="nav-item">Setalah menjadi mitra harap membayar biaya bulanan tepat waktu</li>
      <li class="nav-item">Saat masa mitra telah habis mobil yang terdaftar akan dinonaktifkan hingga pembaharuan masa mitra</li>
      <li class="nav-item">Jika anda tertarik menjadi mitra silahkan mendaftar <a href="#" data-toggle="modal" data-target="#exampleModal">Disini</a></li>
    </ul>
  </div>
  <!-- /.card-body -->
</div>


{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran mitra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Nama</label>
                <input class="form-control" disabled value="{{Auth::user()->name}}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" disabled value="{{Auth::user()->email}}">
              </div>
              <div class="form-group">
                <label>No hp</label>
                <input class="form-control" disabled value="{{Auth::user()->phone}}">
              </div>
              <div class="form-group">
                <label for="lama_jadi_mitra">Pilih berapa Bulan</label>
                <select name="lama_jadi_mitra" class="form-control" id="lama_jadi_mitra">
                  <option>--Pilih--</option>
                  @for($i = 1; $i < 13; $i++)
                    <option value="{{$i}}">{{$i}}&nbsp;Bulan</option>
                  @endfor
                </select>
              </div>
              <div class="form-group">
                <label for="rekening_id">Rekening yang dipilih</label>
                <select name="rekening_id" class="form-control" required>
                  <option value="0" selected disabled>--Pilih--</option>
                  @foreach($rekenings as $rekening)
                    <option value="{{$rekening->id}}">
                      {{$rekening->atas_nama}} - {{$rekening->nomor_rekening}}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="bukti_bayar">Bukti Bayar</label>
                <input type="file" name="bukti_bayar" class="form-control" required >
              </div>
              <div class="form-group">
                <div class="">
                  <p>Saya "{{Auth::user()->name}}" ingin mendaftar menjadi mitra rent car. 
                    <br>dan akan mematuhi segala kebijakan yang ada pada rent car.
                    <br>dan siap menerima konsekuensi jika melanggar hukum .
                  </p>
                </div>
              </div>
              <div class="form-check">
                <input  type="checkbox" class="form-check-input" id="tidak" required>
                <label class="form-check-label" for="tidak">Ya. Saya mengerti</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
      $(document).ready(function(){
        $('#tb_bank').DataTable();
      });
    </script>
@endpush