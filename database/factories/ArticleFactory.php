<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ArticleFactory extends Factory {
    public function definition(): array {
        static $i = 0;
        $judulList = [
            'Mengenal Teknik Akting Stanislavski dalam Dunia Teater',
            'Sejarah Teater Tradisional Nusantara',
            'Cara Menulis Naskah Drama yang Baik dan Benar',
            'Tips Mengatasi Grogi di Atas Panggung',
            'Peran Tata Rias dalam Kesuksesan Pertunjukan',
            'Proses Kreatif di Balik Pementasan Malam Jahanam',
            'Workshop Akting Bersama Sutradara Nasional',
            'Mendalami Karakter Perjalanan Seorang Aktor Muda',
            'Keberhasilan Tim Teater Raih Juara 1 Festival Provinsi',
            'Pentingnya Latihan Vokal dan Diksi bagi Aktor',
            'Teater sebagai Sarana Pengembangan Diri Siswa',
            'Behind The Scene Persiapan Pentas Sangkuriang',
            'Kisah Sukses Alumni Teater Sekolah',
            'Teknik Pernafasan untuk Aktor Panggung',
            'Membangun Karakter Antagonis yang Kuat',
        ];
        $j = $judulList[$i % count($judulList)];
        $i++;
        $status = $this->faker->randomElement(['published','published','draft']);
        return [
            'judul'        => $j,
            'slug'         => Str::slug($j) . '-' . $i,
            'konten'       => implode("\n\n", $this->faker->paragraphs(5)),
            'thumbnail'    => null,
            'kategori'     => $this->faker->randomElement(['berita','tips','sejarah','dokumentasi','prestasi']),
            'status'       => $status,
            'views'        => $this->faker->numberBetween(10, 1500),
            'published_at' => $status==='published' ? $this->faker->dateTimeBetween('-1 year','now') : null,
        ];
    }
}