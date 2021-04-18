<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use Auth;
use Str;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        $categories = Category::all();
        return view('dashboard.car.index', compact('cars','categories'));
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
        // dd($request->all()); die;
        $car = new Car;
        $car->nama_mobil = $request->nama_mobil;
        $car->kategori_id = $request->kategori_id;
        $car->panjang_mobil = $request->panjang_mobil;
        $car->tinggi_mobil = $request->tinggi_mobil;
        $car->umur_mobil = $request->umur_mobil;
        $car->jumlah_kursi = $request->jumlah_kursi;
        $car->jumlah_pintu = $request->jumlah_pintu;
        $car->warna_mobil = $request->warna_mobil;
        $car->tranmisi_mobil = $request->tranmisi_mobil;
        $car->lepas_kunci = $request->lepas_kunci;
        $car->status_mobil = 0;
        $car->stnk_mobil = $request->stnk_mobil;
        $car->nomor_plat = $request->nomor_plat;
        $car->user_id = Auth::user()->id;
        $car->slug = Str::slug($request->nama_mobil);
        $car->save();
        $car->fasilitas()->attach($request->fasilitas);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Car::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('status','Mobil berhasil dihapus');
    }
}
