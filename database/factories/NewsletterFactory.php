<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class NewsletterFactory extends Factory {
    public function definition(): array {
        return [
            'email'         => $this->faker->unique()->safeEmail(),
            'subscribed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}