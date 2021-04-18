<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->integer('kategori_id');
            $table->integer('panjang_mobil');
            $table->integer('tinggi_mobil');
            $table->integer('umur_mobil');
            $table->integer('jumlah_kursi');
            $table->integer('jumlah_pintu');
            $table->string('warna_mobil');
            $table->string('tranmisi_mobil');
            $table->integer('lepas_kunci');
            $table->integer('status_mobil');
            $table->integer('stnk_mobil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
