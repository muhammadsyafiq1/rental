@extends('layouts.app')

@section('title')
    Data transaksi
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data transaksi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data transaksi</li>
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
    <table id="tb_transaksi" class="table table-striped">
      <thead>
        <tr>
          <th>Email</th>
          <th>Handphone</th>
          <th>Berlangganan</th>
          <th>Total bayar</th>
          <th> Rekening</th>
          <th>Bukti Bayar</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transaksis as $transaksi)
              <tr class="bg-dark">
                  <td style="font-weight: bold;" class="text-success">{{$transaksi->user->email ?? 'invalid'}}</td>
                  <td>{{$transaksi->user->phone ?? 'invalid'}}</td>
                  <td>{{$transaksi->lama_jadi_mitra}} Bulan</td>
                  <td>Rp. {{number_format($transaksi->total_bayar)}}</td>
                  <td>
                    {{$transaksi->rekening->nomor_rekening}} <br>
                    <small class="text-muted">{{$transaksi->rekening->atas_nama}}</small>
                  </td>
                  <td>
                    <a href="{{asset('storage/'.$transaksi->bukti_bayar)}}">
                      Lihat bukti
                    </a>
                  </td>
                  <td>{{$transaksi->status}}</td>
                  <td>
                    @if($transaksi->status == 'diterima')
                      <span class="badge badge-info">Transaksi User berhasil</span>
                    @else
                      <a href="{{route('transaksi.diterima',$transaksi->id)}}" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i>
                      </a>
                      <a href="{{route('transaksi.ditolak',$transaksi->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin pembayaran ditolak ? segera hubungi nomor {{$transaksi->user->phone}}  untuk memberitahu.')">
                        <i class="fa fa-times"></i>
                      </a>
                    @endif
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
        $('#tb_transaksi').DataTable();
      });
    </script>
@endpush