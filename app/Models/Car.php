<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    protected $fillable = [
    	'nama_mobil','kategori_id','panjang_mobil','tinggi_mobil','umur_mobil','jumlah_kursi','jumlah_pintu',
    	'warna_mobil','tranmisi_mobil','lepas_kunci','status_mobil','stnk_mobil','nomor_plat','user_id','slug',
        'harga_rental','deskripsi_mobil'
    ];

    public function kategori()
    {
    	return $this->belongsTo(Category::class, 'kategori_id');
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fasilitas()
    {
    	return $this->belongsToMany('App\Models\Fasilitas');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'car_id');
    }
}
