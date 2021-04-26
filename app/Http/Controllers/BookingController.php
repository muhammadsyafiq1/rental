<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Booking_detail;
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
        ]);

        $booking_detail = Booking_detail::create([
            'booking_id' => $booking->id,
            'car_id' => $request->car_id,
            'total_bayar' => $request->tot * $diff->days,
        ]);

        // print pdf
        $booking_detail = Booking_detail::with('booking.user','car.gallery')->findOrFail($booking_detail->id);
        $pdf = PDF::loadView('pdf', compact('booking_detail'))->setPaper('a4', 'landscape');
        return $pdf->stream();
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

   
}
