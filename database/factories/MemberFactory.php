<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class MemberFactory extends Factory {
    public function definition(): array {
        return [
            'nama'    => $this->faker->name(),
            'foto'    => null,
            'divisi'  => $this->faker->randomElement(['akting','naskah','tata_rias','tata_panggung','musik','humas']),
            'angkatan'=> $this->faker->numberBetween(2019, 2025),
            'kelas'   => $this->faker->randomElement(['X IPA 1','X IPA 2','X IPS 1','XI IPA 1','XI IPA 2','XI IPS 1','XII IPA 1','XII IPA 2']),
            'no_hp'   => '08' . $this->faker->numerify('##########'),
            'bio'     => $this->faker->sentence(10),
            'status'  => $this->faker->randomElement(['aktif','aktif','aktif','alumni']),
        ];
    }
}