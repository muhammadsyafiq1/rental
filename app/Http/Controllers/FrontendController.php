<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class FrontendController extends Controller
{
    public function index()
    {
    	
    	$cars = Car::with('gallery','kategori')->orderBy('id','DESC')->take(6)->get();
    	return view('pages.home.index', compact('cars')); 
    }

    public function detailMobil($slug)
    {
        $journeyDate = 
        $returnDate = 
        $car = Car::with('user','kategori','gallery')->where('slug',$slug)->first(); 
    	return view('pages.detail-mobil.index', compact('car'));
    }

    public function SemuaMobil()
    {
    	$totCar = Car::count();
    	$cars = Car::with('gallery','kategori')->orderBy('id','DESC')->paginate(64);
    	return view('pages.semua-mobil.index', compact('totCar','cars'));
    }
}
