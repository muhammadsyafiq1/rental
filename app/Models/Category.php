<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
    	'kategori_mobil','kategori_slug_mobil','deskripsi_kategori','icon_kategori'
    ];
}
