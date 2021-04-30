<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpan;

class SimpanController extends Controller
{
    public function simpan($id)
    {
    	$simpanMobil = new Simpan;
    	$simpanMobil->car_id = $id;
    	$simpanMobil->user_id = \Auth::user()->id;
    	$simpanMobil->save();
    	return redirect()->back();
    }
}
