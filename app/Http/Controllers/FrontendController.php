<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class FrontendController extends Controller
{
    public function index()
    {
    	$cars = Car::with('user')->orderBy('id','DESC')->take(10)->get();
    	return view('welcome', compact('cars'));
    }
}
