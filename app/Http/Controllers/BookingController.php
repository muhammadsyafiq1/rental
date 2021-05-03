<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Booking_detail;
use App\Models\Car;
use PDF;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $journey_date  = date_create($request->mulai_rental);

        $return_date = date_create($request->tanggal_kembali);

        $diff  = date_diff($journey_date, $return_date); 

        $mulai_rental = date('y-m-d',strtotime($request->mulai_rental)); 
        $tanggal_kembali = date('y-m-d',strtotime($request->tanggal_kembali)); 

        $booking = booking::create([
            'user_id' => \Auth::user()->id,
            'mulai_rental' => $mulai_rental,
            'tanggal_kembali' => $tanggal_kembali,
            'lama_rental' => $diff->days,
            'lokasi_detail' => $request->lokasi_detail,
            'berapa_orang' => $request->berapa_orang,
            'lokasi_tujuan' => $request->lokasi_tujuan,
            'kode_transaksi' => 'Booking -'. mt_rand(100000,999999),
            // 'status' => 'Pending',
        ]);

        $booking_detail = Booking_detail::create([
            'booking_id' => $booking->id,
            'car_id' => $request->car_id,
            'total_bayar' => $request->tot * $diff->days,
        ]);

        return redirect()->route('success',$booking_detail->id);
        // print pdf
        // $booking_detail = Booking_detail::with('booking.user','car.gallery')->findOrFail($booking_detail->id);
        // $pdf = PDF::loadView('pdf', compact('booking_detail'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
    }

    public function success($id)
    {
        $booking_detail = Booking_detail::with('booking.user','car.user')->findOrFail($id);
        return view('success', compact('booking_detail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }


    // roles 2
    public function riwayatBooking()
    {
        $dataSimpanBooking = Booking_detail::with(['booking.user','car.gallery'])->whereHas('car', function($car){
            $car->where('user_id', \Auth::user()->id);
        })->get(); 

        return view('dashboard.admin.riwayat', compact('dataSimpanBooking'));
    }

    // public function riwayat_laundry_saya()
    // {
    //     $buyTransaction = Transaction_detail::with(['transaction.user','laundry.gallery'])->whereHas('transaction', function($transaction){
    //         $transaction->where('user_id', Auth::user()->id);
    //     })->paginate(10);  

    //     return view('dashboard.customer.riwayat.index', compact(['buyTransaction']));
    // }

    public function mobilDikembalikan($id)
    {
        $car = Car::findOrFail($id); 
        $car->status = 'tersedia';
        $car->save();
        return redirect()->back()->with('status','Mobil telah dikembalikan');
    }

    public function mobilDirental($id)
    {
        $car = Car::findOrFail($id); 
        $car->status = 'dirental';
        $car->save();
        return redirect()->back()->with('status','Mobil telah direntalkan');
    }

}
