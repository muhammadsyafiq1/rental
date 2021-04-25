<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_detail extends Model
{
    use HasFactory;

    protected $fillable [
    	'booking_id','car_id','total_bayar'
    ];


    public function booking()
    {
        return $this->hasOne(Booking::class , 'id' , 'booking_id');
    }

    public function car()
    {
        return $this->hasOne(Car::class , 'id' , 'car_id');
    }
}
