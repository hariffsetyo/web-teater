<?php
namespace Database\Factories;
use App\Models\Performance;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class TicketReservationFactory extends Factory {
    public function definition(): array {
        return [
            'performance_id' => Performance::inRandomOrder()->value('id'),
            'nama'           => $this->faker->name(),
            'email'          => $this->faker->safeEmail(),
            'no_hp'          => '08'.$this->faker->numerify('##########'),
            'jumlah_tiket'   => $this->faker->numberBetween(1,4),
            'kode_tiket'     => 'TKT-'.strtoupper(Str::random(8)),
            'status'         => $this->faker->randomElement(['pending','confirmed','confirmed','hadir','batal']),
        ];
    }
}