<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
    	'car_id','foto'
    ];

    public function car()
    {
    	return $this->belongsTo(Car::class ,'car_id');
    }
}
