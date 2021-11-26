<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_mobil' => $this->faker->name,
            'kategori_id' => 1,
            'jumlah_kursi' => 4,
            'jumlah_pintu' => 4,
            'warna_mobil' => 'hitam',
            'tranmisi_mobil' => 'matic',
            'lepas_kunci' => 0,
            'stnk_mobil' => $this->faker->uuid,
            'nomor_plat' => $this->faker->uuid,
            'user_id' => 1,
            'slug' => 'test-mobil-slug',
            'harga_rental' => 1000000,
            'deskripsi_mobil' => $this->faker->text,
            'status' => 'tersedia',
            'approved_admin' => 'disetujui',
        ];
    }
}
