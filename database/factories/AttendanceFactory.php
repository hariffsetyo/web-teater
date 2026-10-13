<?php
namespace Database\Factories;
use App\Models\Member; use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
class AttendanceFactory extends Factory {
    public function definition(): array {
        return [
            'member_id'  => Member::inRandomOrder()->value('id'),
            'event_id'   => Event::inRandomOrder()->value('id'),
            'status'     => $this->faker->randomElement(['hadir','hadir','hadir','izin','alpha']),
            'keterangan' => $this->faker->optional(0.4)->sentence(),
        ];
    }
}