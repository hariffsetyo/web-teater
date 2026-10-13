<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class TestimonialFactory extends Factory {
    public function definition(): array {
        return [
            'nama'     => $this->faker->name(),
            'peran'    => $this->faker->randomElement(['Anggota Akting','Ketua Divisi Naskah','Anggota Tata Rias','Ketua Ekskul','Alumni 2023','Alumni 2022','Anggota Musik']),
            'isi'      => $this->faker->randomElement(['Bergabung dengan teater adalah keputusan terbaik. Saya belajar kepercayaan diri dan kerja sama tim.','Teater mengajarkan saya memahami perasaan orang lain dan mengekspresikannya dengan indah.','Di sini saya menemukan keluarga kedua. Setiap latihan adalah petualangan baru.','Kemampuan public speaking saya meningkat drastis setelah bergabung.','Pementasan Malam Jahanam adalah pengalaman yang tidak terlupakan.']),
            'foto'     => null,
            'featured' => $this->faker->boolean(30),
        ];
    }
}