<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class PodcastEpisodeFactory extends Factory {
    public function definition(): array {
        $status = $this->faker->randomElement(['published','published','draft']);
        return [
            'judul'        => $this->faker->randomElement(['Drama Audio Malam di Ujung Desa','Wawancara Perjalanan Menjadi Aktor Profesional','Behind The Scenes Proses Produksi Sangkuriang','Drama Audio Surat dari Lautan','Wawancara Sutradara Muda tentang Teater Kontemporer','Behind The Scenes Tata Rias Karakter Raja','Drama Audio Gema di Lereng Gunung','Tips Cara Menghafal Naskah dengan Efektif','Drama Audio Bisikan Angin Malam','Wawancara Alumni Teater Kini Jadi Seniman']),
            'deskripsi'    => $this->faker->paragraph(2),
            'file_audio'   => null,
            'url_audio'    => 'https://soundcloud.com/teater-sekolah/ep-'.$this->faker->numberBetween(1,50),
            'durasi'       => sprintf('%02d:%02d', $this->faker->numberBetween(10,45), $this->faker->numberBetween(0,59)),
            'cover_image'  => null,
            'kategori'     => $this->faker->randomElement(['drama_audio','behind_the_scenes','wawancara']),
            'jumlah_play'  => $this->faker->numberBetween(0,500),
            'published_at' => $status==='published' ? $this->faker->dateTimeBetween('-6 months','now') : null,
        ];
    }
}