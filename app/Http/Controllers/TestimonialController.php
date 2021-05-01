<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
    	$testimonials = Testimonial::with('user')->where('user_id', \Auth::user()->id)->get();
    	return view('dashboard.testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
    	$testi = new Testimonial;
    	$testi->user_id = \Auth::user()->id;
    	$testi->testimonial = $request->testimonial;
    	$testi->save();
    	return redirect()->back();
    }
}
