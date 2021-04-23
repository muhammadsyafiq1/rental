<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id','rekening_id','lama_jadi_mitra','bukti_bayar','total_bayar','status'
    ];

    public function user()
    {
    	return $this->hasOne(User::class, 'id' ,'user_id');
    }

      public function rekening()
    {
    	return $this->belongsTo(Bank::class, 'rekening_id');
    }
}
