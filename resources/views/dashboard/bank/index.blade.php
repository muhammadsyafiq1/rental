@extends('layouts.app')

@section('title')
    Data Bank
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Bank</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Rekening</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row mb-2">
  <div class="col-12">
    <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"> Tambah Rekening</i>
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
    <table id="tb_bank" class="table table-striped">
      <thead>
        <tr>
          <th>Nama Bank</th>
          <th>Atas Nama</th>
          <th>Nomor rekening</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($banks as $bank)
              <tr class="bg-dark">
                  <td>{{$bank->nama_bank}}</td>
                  <td>{{$bank->atas_nama}}</td>
                  <td>{{$bank->nomor_rekening}}</td>
                  <td>
                      <form action="{{route('bank.destroy',$bank->id)}}" method="post" class="d-inline">
                        @csrf @method('delete')
                        <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{$bank->id}}">
                          <i class="fa fa-edit"> Ubah</i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Menghapus kategory {{$bank->nama_bank}} ?')">
                          <i class="fa fa-trash"> Hapus</i>
                        </button>
                      </form>
                  </td>
              </tr>
              {{-- edit modal --}}
              <div class="modal fade" id="edit{{$bank->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit - {{$bank->nama_bank}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('bank.update',$bank->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nama_bank">Nama Bank</label>
                                    <input value="{{old('nama_bank') ? old('nama_bank') : $bank->nama_bank}}" name="nama_bank" type="text" class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank">
                                    @error('nama_bank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="row">
                                <div class="form-group col-12">
                                    <label for="atas_nama">Atas Nama</label>
                                    <input value="{{old('atas_nama') ? old('atas_nama') : $bank->atas_nama}}" name="atas_nama" type="text" class="form-control @error('atas_nama') is-invalid @enderror" id="atas_nama">
                                    @error('atas_nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nomor_rekening">Nomor Rekening</label>
                                    <input value="{{old('nomor_rekening') ? old('nomor_rekening') : $bank->nomor_rekening}}" name="nomor_rekening" type="text" class="form-control @error('nomor_rekening') is-invalid @enderror" id="nomor_rekening">
                                    @error('nomor_rekening')
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Bank</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('bank.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Bank <span class="text-danger">*</span></label>
                <input type="text" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror">
                @error('nama_bank')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Atas Nama <span class="text-danger">*</span></label>
                <input type="text" name="atas_nama" class="form-control @error('atas_nama') is-invalid @enderror">
                @error('atas_nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
               <div class="form-group">
                <label>Nomor Rekening <span class="text-danger">*</span></label>
                <input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror">
                @error('nomor_rekening')
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
        $('#tb_bank').DataTable();
      });
    </script>
@endpush