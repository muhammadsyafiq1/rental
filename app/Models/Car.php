<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    protected $fillable = [
    	'nama_mobil','kategori_id','panjang_mobil','tinggi_mobil','umur_mobil','jumlah_kursi','jumlah_pintu',
    	'warna_mobil','tranmisi_mobil','lepas_kunci','status_mobil','stnk_mobil','nomor_plat','user_id','slug'
    ];

    public function kategori()
    {
    	return $this->belongsTo(Category::class, 'kattegori_id');
    }

    public function fasilitas()
    {
    	return $this->belongsToMany('App\Models\Fasilitas');
    }
}
