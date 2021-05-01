@extends('layouts.app')

@section('title')
	Beri testimonial
@stop

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Testimonial anda</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Testimonial anda</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop

@section('content')
@if($testimonials->count() < 1)
<div class="row mb-2">
  <div class="col-12">
    <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-comments"> Beri ulasan </i>
     </button>
  </div>
</div>
@endif

<div class="row">
	<div class="col-lg-5 col-sm-12">
		<div class="card">
  @if (session('status'))
      <div class="alert alert-warning text-center">
          {{session('status')}}
      </div>
  @endif
  <div class="card-body">
  	<div class="">
  		@forelse($testimonials as $testimonial)
  			<h5 class="text-muted text-uppercase mb-3"> {{$testimonial->user->name}}</h5>
	  		<q class="text-uppercase">{{$testimonial->testimonial}}</q>
  		@empty
  			<div class="row">
  				<div class="col-12 text-center">
  					<div class="alert alert-warning">
  						Anda belum memberikan ulasan.
  					</div>
  				</div>
  			</div>
  		@endforelse
    </div>
  </div>
  <!-- /.card-body -->
</div>
	</div>
</div>

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Beri ulasan dengan jujur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('testimonial.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Ulasan anda</label>
                <textarea name="testimonial" class="form-control @error('testimonial') is-invalid @enderror"></textarea>
                @error('testimonial')
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
@stop