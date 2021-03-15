<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class pegawaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pegawai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_pegawai' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['perempuan','laki-laki']),
            'email' => $this->faker->unique()->safeEmail,
            'alamat' => $this->faker->secondaryAddress,
        ];
    }
}
