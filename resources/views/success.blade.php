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
  </head>

  <body>

    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/frontend/images/72.jpg" class="mb-4" style="width: 300px;"> <br>
                        <small style="font-size: 18px; color:#f0ad4e;">Segera melakukan pembayaran. batas waktu <span style="font-weight: bold; color: #5cb85c;">24</span> jam mulai sekarang.</small>
                        <h3>
                            Order Diproses!
                        </h3>
                        
                        <div>
                            <h5 style="background-color: #5cb85c; padding: 1px;">Id order : {{$booking_detail->booking->id}}</h5>
                        </div>
                        <p>
                            @if($booking_detail->booking->lokasi_detail == null)
                            	Terimakasih sudah order mobil rental kami. total biayanya adalah sebesar <span style="font-weight: bold;">{{$booking_detail->total_bayar}} / Hari</span> 
                            @else
                            	Terimkasih sudah order mobil rental kami. kami akan segera menghubungi anda.
                            @endif
                        </p>  <br>
                        <small style="text-align: center; margin-top: -20px;">Alamat kami : {{$booking_detail->car->user->address}}</small> <br>
                        <small style="text-align: center; margin-top: 0;">Handphone / WA kami : {{$booking_detail->car->user->phone}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
