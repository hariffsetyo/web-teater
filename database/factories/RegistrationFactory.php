<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class RegistrationFactory extends Factory {
    public function definition(): array {
        return [
            'nama'          => $this->faker->name(),
            'email'         => $this->faker->safeEmail(),
            'no_hp'         => '08'.$this->faker->numerify('##########'),
            'kelas'         => $this->faker->randomElement(['X IPA 1','X IPA 2','X IPS 1','X IPS 2']),
            'alasan_daftar' => $this->faker->randomElement(['Saya ingin mengembangkan kemampuan akting dan kepercayaan diri.','Bergabung dengan teater sudah menjadi impian saya.','Saya ingin belajar membuat naskah drama yang baik.','Teater adalah cara saya mengekspresikan diri.']),
            'motivasi'      => $this->faker->paragraph(2),
            'file_audisi'   => null,
            'status'        => $this->faker->randomElement(['pending','diterima','diterima','ditolak']),
            'catatan_admin' => $this->faker->optional(0.5)->sentence(),
        ];
    }
}