<!--BISMILLAHI-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Success Order</title>
    <style>
    	.page-success .section-success {
		  font-size: 28px;
		  font-weight: 200;
		  text-align: center;
		  color: #0c0d36;
		  margin-top: 0;
		}
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  </head>

  <body>

    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/frontend/images/72.jpg" class="mb-4" style="width: 300px;"> <br>
                        <p style="font-size: 18px; color:#f0ad4e;">Segera melakukan pembayaran. batas waktu <span style="font-weight: bold; color: #5cb85c;">24</span> jam mulai sekarang.</p>
                       

                        <div>
                            <h3>Id order : {{$booking_detail->booking->id}}</h3>
                        </div>
                        <p>
                            @if($booking_detail->booking->lokasi_detail == null)
                            	Terimakasih sudah order mobil rental kami <span class="text-success">{{$booking_detail->car->nama_mobil}}</span> . total biayanya adalah sebesar <br> <span style="font-weight: bold;">{{$booking_detail->total_bayar}} / Hari</span> 
                            @else
                            	Terimkasih sudah order mobil rental kami. kami akan segera menghubungi anda.
                            @endif
                        </p>  <br>
                        <div class="text-muted" style="font-size: 20px;">
                        	<a href="{{url('/')}}" class="btn btn-block btn-sm btn-secondary">Back</a>
                        	<small>Alamat kami : {{$booking_detail->car->user->address}}</small>
                        	<small>Handphone / WA kami : {{$booking_detail->car->user->phone}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>
