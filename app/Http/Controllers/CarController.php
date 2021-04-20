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
        $cars = Car::with('gallery','kategori')->get(); 
        $categories = Category::all();
        return view('dashboard.car.index', compact('cars','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGallery($id)
    {
        $cars = Car::with('gallery')->where('id', $id)->firstOrFail();
        return view('dashboard.gallery.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|max:50|min:3',
            'kategori_id' => 'required',
            'panjang_mobil' => 'required|integer|min:1',
            'tinggi_mobil' => 'required|integer|min:1',
            'umur_mobil' => 'required',
            'jumlah_kursi' => 'required|min:1',
            'jumlah_pintu' => 'required|min:1',
            'warna_mobil' => 'required|string',
            'tranmisi_mobil' => 'required',
            'lepas_kunci' => 'required',
            'status_mobil' => 'required',
            'stnk_mobil' => 'required',
            'nomor_plat' => 'required',

        ]);

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

        return redirect(route('createGallery',$car->id))->with('status','Harap Tambahkan Foto Mobil.');
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
        $car = Car::with('kategori','gallery','fasilitas','user')->findOrFail($id);  
        $categories = Category::all();
        return view('dashboard.car.edit', compact('car','categories'));
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
          $request->validate([
            'nama_mobil' => 'required|max:50|min:3',
            'kategori_id' => 'required',
            'panjang_mobil' => 'required|integer|min:1',
            'tinggi_mobil' => 'required|integer|min:1',
            'umur_mobil' => 'required',
            'jumlah_kursi' => 'required|min:1',
            'jumlah_pintu' => 'required|min:1',
            'warna_mobil' => 'required|string',
            'tranmisi_mobil' => 'required',
            'lepas_kunci' => 'required',
            'status_mobil' => 'required',
            'stnk_mobil' => 'required',
            'nomor_plat' => 'required',

        ]);

        // dd($request->tranmisi_mobil); die;
        $car_edit =  Car::findOrFail($id);
        $car_edit->nama_mobil = $request->nama_mobil;
        $car_edit->kategori_id = $request->kategori_id;
        $car_edit->panjang_mobil = $request->panjang_mobil;
        $car_edit->tinggi_mobil = $request->tinggi_mobil;
        $car_edit->umur_mobil = $request->umur_mobil;
        $car_edit->jumlah_kursi = $request->jumlah_kursi;
        $car_edit->jumlah_pintu = $request->jumlah_pintu;
        $car_edit->warna_mobil = $request->warna_mobil;
        $car_edit->tranmisi_mobil = $request->tranmisi_mobil;
        $car_edit->lepas_kunci = $request->lepas_kunci;
        $car_edit->status_mobil = 0;
        $car_edit->stnk_mobil = $request->stnk_mobil;
        $car_edit->nomor_plat = $request->nomor_plat;
        $car_edit->deskripsi_mobil = $request->deskripsi_mobil;
        $car_edit->harga_rental = $request->harga_rental;
        $car_edit->user_id = Auth::user()->id;
        $car_edit->slug = Str::slug($request->nama_mobil);
        $car_edit->save();
        $car_edit->fasilitas()->sync($request->fasilitas);

        return redirect()->back()->with('status','Mobil Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeCar($id)
    {
        $item = Car::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('status','Mobil berhasil dihapus');
    }
}
