@extends('layouts.app')

@section('title')
    Data Mobil Disimpan
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Mobil disimpan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Mobil disimpan</li>
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
    <table id="tb_simoan" class="table table-striped">
      <thead>
        <tr>
          <th>Gambar Mobil</th>
          <th>Nama mobil</th>
          <th>Lepas kunci</th>
          <th>Rental perhari</th>
          <th>Status</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($simpan as $simpan)
              <tr class="bg-dark">
                  <td>
                    <img src="{{ Storage::url($simpan->car->gallery->first()->foto) }}" style="width: 140px;">
                  </td>
                  <td>{{$simpan->car->nama_mobil}}</td>
                  <td>
                    {{$simpan->car->lepas_kunci == 0 ? 'Tidak, (Biaya supir berlaku)' : 'Iya'}} <br>
                    <small class="text-warning">Rp .{{number_format($simpan->car->biaya_supir ?? '')}}</small>
                  </td>
                  <td>Rp. {{number_format($simpan->car->harga_rental)}}</td>
                  <td>{{$simpan->car->status}}</td>
                  <td>
                    <a href="{{route('hapus.mobil.disimpan',$simpan->id)}}" class="btn btn-sm btn-danger"> Hapus Mobil</a>
                    <a href="{{route('detail',$simpan->car->slug)}}" class="btn btn-sm btn-warning"> Lihat Mobil</a>
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
        $('#tb_simoan').DataTable();
      });
    </script>
@endpush