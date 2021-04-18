@extends('layouts.app')

@section('title')
    Data Fasilitas
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Fasilitas</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Fasilitas Mobil</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row mb-2">
  <div class="col-12">
    <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"> Tambah Fasilitas</i>
      </button>
  </div>
</div>
<div class="card">
  @if (session('status'))
      <div class="alert alert-warning text-center">
          {{session('status')}}
      </div>
  @endif
  <div class="card-body">
    <table id="tb_fasilitas" class="table table-striped">
      <thead>
        <tr>
          <th>Icon Fasilitas</th>
          <th>Nama Fasiiitas</th>
          <th>Tanggal buat</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($fasilitas as $fasilitas)
              <tr class="bg-dark">
                  <td>
                    <img src="{{asset('storage/'.$fasilitas->icon_fasilitas)}}" style="width: 60px;">
                  </td>
                  <td>{{$fasilitas->nama_fasilitas}}</td>
                  <td>{{date('D, d-m-Y',strtotime($fasilitas->created_at))}}</td>
                  <td>
                      <form action="{{route('fasilitas.destroy',$fasilitas->id)}}" method="post" class="d-inline">
                        @csrf @method('delete')
                        <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{$fasilitas->id}}">
                          <i class="fa fa-edit"> Ubah</i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Menghapus kategory {{$fasilitas->nama_fasilitas}} ?')">
                          <i class="fa fa-trash"> Hapus</i>
                        </button>
                      </form>
                  </td>
              </tr>
              {{-- edit modal --}}
              <div class="modal fade" id="edit{{$fasilitas->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit - {{$fasilitas->nama_fasilitas}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('fasilitas.update',$fasilitas->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nama_fasilitas">Fasilitas Mobil</label>
                                    <input value="{{old('nama_fasilitas') ? old('nama_fasilitas') : $fasilitas->nama_fasilitas}}" name="nama_fasilitas" type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror" id="nama_fasilitas">
                                    @error('nama_fasilitas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="row">
                                <div class="form-group col-12">
                                    <label for="icon_fasilitas">Icon Fasilitas</label> <br>
                                    <img src="{{asset('storage/'.$fasilitas->icon_fasilitas)}}" style="width: 200px;"> <br>
                                    <input  type="file" name="icon_fasilitas" type="text" class="form-control @error('icon_fasilitas') is-invalid @enderror" id="icon_fasilitas">
                                    <small class="text-danger">Kosongkan bila tidak ingin merubah icon.</small>
                                    @error('icon_fasilitas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
          @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah fasilitas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('fasilitas.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Icon fasilitas</label>
                <input type="file" name="icon_fasilitas" class="form-control @error('icon_fasilitas') is-invalid @enderror">
                @error('icon_fasilitas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" class="form-control @error('nama_fasilitas') is-invalid @enderror">
                @error('nama_fasilitas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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
        $('#tb_fasilitas').DataTable();
      });
    </script>
@endpush