<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
    	
    	$cars = Car::with('gallery','kategori')->where('status','tersedia')->orderBy('id','DESC')->take(6)->get();
    	return view('pages.home.index', compact('cars')); 
    }

    public function detailMobil($slug)
    {
        // $journeyDate = 
        // $returnDate = 
        $car = Car::with('user','kategori','gallery')->where('slug',$slug)->first(); 
    	return view('pages.detail-mobil.index', compact('car'));
    }

    public function SemuaMobil(Request $request)
    {
        // dd($request->all()); die;
        $tot = Car::where('status','tersedia')->count();
        $lepasKunci = $request->lepas_kunci;
        $nama_mobil = $request->nama_mobil;
        if($nama_mobil){
            $cars = Car::with('gallery','kategori')->where('nama_mobil',"LIKE","%$nama_mobil%")->where('lepas_kunci', '=', $lepasKunci)->paginate(64);
        } else {
            $cars = Car::with('user','gallery','kategori')->where('status','tersedia')->orderBy('id','DESC')->paginate(64); 
        }
        return view('pages.semua-mobil.index', compact('cars','tot'));
    }
}
