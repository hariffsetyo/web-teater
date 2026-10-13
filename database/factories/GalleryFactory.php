<?php
namespace Database\Factories;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
class GalleryFactory extends Factory {
    public function definition(): array {
        $tipe = $this->faker->randomElement(['foto','foto','foto','video']);
        return [
            'judul'     => $this->faker->randomElement(['Momen Behind the Scene Malam Jahanam','Foto Pentas Sangkuriang','Rehearsal Petang di Taman','Dokumentasi Latihan Akting','Gladi Bersih Pementasan','Sesi Make-up Tata Rias','Pengukuhan Anggota Baru','Lomba Monolog Juara 1']),
            'tipe'      => $tipe,
            'file_path' => $tipe==='foto' ? 'galleries/foto-'.$this->faker->numberBetween(1,100).'.jpg' : null,
            'url_video' => $tipe==='video' ? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' : null,
            'event_id'  => Event::inRandomOrder()->value('id'),
            'kategori'  => $this->faker->randomElement(['pementasan','latihan','lomba','dokumentasi']),
            'deskripsi' => $this->faker->sentence(8),
        ];
    }
}