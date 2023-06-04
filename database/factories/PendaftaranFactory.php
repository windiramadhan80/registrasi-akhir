<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendaftaran>
 */
class PendaftaranFactory extends Factory
{

    protected $model = Pendaftaran::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->dayOfMonth(),
            'bulan_lahir' => $this->faker->monthName(),
            'tahun_lahir' => $this->faker->year(),
            'jenis_kelamin' => $this->faker->word(),
            'program_studi' => $this->faker->words(3, true),
            'nim' => $this->faker->randomNumber(9, true),
        ];
    }
}
