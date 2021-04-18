@extends('layouts.app')

@section('title')
    Data Kategori Mobil
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Kategori</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Kategori</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row mb-2">
  <div class="col-12">
    <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"> Tambah Kategori</i>
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
    <table id="tb_category" class="table table-striped">
      <thead>
        <tr>
          <th>Icon Kategori</th>
          <th>Nama Kategori</th>
          <th>Deskripsi</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
              <tr class="bg-dark">
                  <td>
                    <img src="{{asset('storage/'.$category->icon_kategori)}}" style="width: 60px;">
                  </td>
                  <td>{{$category->kategori_mobil}}</td>
                   <td style="width: 400px;">{{$category->deskripsi_kategori}}</td>
                  <td>
                      <form action="{{route('category.destroy',$category->id)}}" method="post" class="d-inline">
                        @csrf @method('delete')
                        <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{$category->id}}">
                          <i class="fa fa-edit"> Ubah</i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Menghapus kategory {{$category->kategori_mobil}} ?')">
                          <i class="fa fa-trash"> Hapus</i>
                        </button>
                      </form>
                  </td>
              </tr>
              {{-- edit modal --}}
              <div class="modal fade" id="edit{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit - {{$category->kategori_mobil}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="kategori_mobil">Kategori Mobil</label>
                                    <input value="{{old('kategori_mobil') ? old('kategori_mobil') : $category->kategori_mobil}}" name="kategori_mobil" type="text" class="form-control @error('kategori_mobil') is-invalid @enderror" id="kategori_mobil">
                                    @error('kategori_mobil')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="row">
                                <div class="form-group col-12">
                                    <label for="deskripsi_kategori">Deskripsi Kategori</label>
                                    <textarea id="deskripsi_kategori" name="deskripsi_kategori" class="form-control @error('deskripsi_kategori') is-invalid @enderror">{{old('deskripsi_kategori') ? old('deskripsi_kategori') : $category->deskripsi_kategori}}</textarea>
                                    @error('deskripsi_kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="row">
                                <div class="form-group col-12">
                                    <label for="icon_kategori">Icon Kategori</label> <br>
                                    <img src="{{asset('storage/'.$category->icon_kategori)}}" style="width: 200px;"> <br>
                                    <input  type="file" name="icon_kategori" type="text" class="form-control @error('icon_kategori') is-invalid @enderror" id="icon_kategori">
                                    <small class="text-danger">Kosongkan bila tidak ingin merubah icon.</small>
                                    @error('icon_kategori')
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Icon Kategori</label>
                <input type="file" name="icon_kategori" class="form-control @error('icon_kategori') is-invalid @enderror">
                @error('icon_kategori')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="kategori_mobil" class="form-control @error('kategori_mobil') is-invalid @enderror">
                @error('kategori_mobil')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Deskripsi Kategori</label>
                <textarea name="deskripsi_kategori" class="form-control @error('deskripsi_kategori') is-invalid @enderror"></textarea>
                @error('deskripsi_kategori')
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
        $('#tb_category').DataTable();
      });
    </script>
@endpush