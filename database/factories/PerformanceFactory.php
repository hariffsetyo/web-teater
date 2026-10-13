<?php
namespace Database\Factories;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
class PerformanceFactory extends Factory {
    public function definition(): array {
        return [
            'event_id'         => Event::where('tipe','pementasan')->inRandomOrder()->value('id') ?? Event::inRandomOrder()->value('id'),
            'judul_pementasan' => $this->faker->randomElement(['Malam Jahanam','Sangkuriang','Petang di Taman','Malin Kundang','Romeo dan Juliet Versi Nusantara','Perahu Kertas','Senja di Pelabuhan Kecil','Bulan Bisu']),
            'sinopsis'         => $this->faker->randomElement(['Kisah tragis tentang ambisi dan pengkhianatan di desa nelayan.','Legenda tanah Sunda tentang cinta terlarang antara ibu dan putranya.','Drama tentang pertemuan dua orang asing di taman kota yang sunyi.']),
            'kuota_kursi'      => $this->faker->randomElement([50,80,100,150,200]),
            'harga_tiket'      => $this->faker->randomElement([null,null,10000,15000,20000,25000]),
            'status'           => $this->faker->randomElement(['buka','tutup','tutup']),
        ];
    }
}