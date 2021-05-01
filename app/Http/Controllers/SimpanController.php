<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpan;

class SimpanController extends Controller
{

	public function index()
	{
		$simpan = Simpan::with('car.gallery')->where('user_id', \Auth::user()->id)->get(); 
		return view('dashboard.simpan.index', compact(['simpan']));
	}

    public function simpan($id)
    {
    	$simpanMobil = new Simpan;
    	$simpanMobil->car_id = $id;
    	$simpanMobil->user_id = \Auth::user()->id;
    	$simpanMobil->save();
    	return redirect()->back();
    }

    public function remove($id)
    {
    	$simpan  = Simpan::findOrFail($id); 
    	$simpan->delete();
    	return redirect()->back()->with('status','Mobil tersimpan berhasil dihapus');
    }
}
