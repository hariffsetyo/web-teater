<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class AchievementFactory extends Factory {
    public function definition(): array {
        return [
            'nama_lomba' => $this->faker->randomElement(['Festival Teater Pelajar Tingkat Provinsi','Lomba Monolog Antar SMA Se-Kabupaten','Festival Drama Remaja Nasional','Kompetisi Teater Pelajar Nusantara','Lomba Penulisan Naskah Drama Remaja','Festival Seni Budaya Pelajar','Lomba Akting Tunggal Tingkat Kota']),
            'tahun'      => $this->faker->numberBetween(2019, 2025),
            'tingkat'    => $this->faker->randomElement(['kabupaten','provinsi','nasional']),
            'peringkat'  => $this->faker->randomElement(['Juara 1','Juara 2','Juara 3','Juara Harapan 1','Pemeran Terbaik','Nominasi Terbaik']),
            'foto'       => null,
            'deskripsi'  => $this->faker->sentence(10),
        ];
    }
}