<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id','mulai_rental','tanggal_kembali','lama_rental','lokasi_detail','berapa_orang','lokasi_tujuan','kode_transaksi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookingdetail()
    {
        return $this->hasMany(Booking_detail::class, 'booking_id');
    }
}
