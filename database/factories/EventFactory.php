<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class EventFactory extends Factory {
    public function definition(): array {
        static $judul = 0;
        $judulList = [
            'Pementasan Malam Jahanam','Pertunjukan Sangkuriang','Drama Petang di Taman',
            'Latihan Rutin Mingguan','Festival Teater Pelajar','Workshop Akting Dasar',
            'Pementasan Malin Kundang','Lomba Monolog Antar Sekolah','Latihan Intensif',
            'Pementasan Romeo dan Juliet Nusantara','Audisi Anggota Baru 2025',
            'Workshop Penulisan Naskah','Pentas Seni Akhir Tahun','Latihan Vokal dan Diksi',
            'Pementasan Bulan Bisu',
        ];
        $j = $judulList[$judul % count($judulList)];
        $judul++;
        $start = $this->faker->dateTimeBetween('-1 year', '+6 months');
        return [
            'judul'           => $j,
            'slug'            => Str::slug($j) . '-' . $judul,
            'deskripsi'       => $this->faker->paragraph(3),
            'tanggal_mulai'   => $start,
            'tanggal_selesai' => (clone $start)->modify('+' . $this->faker->numberBetween(1,3) . ' hours'),
            'lokasi'          => $this->faker->randomElement(['Aula Sekolah','Gedung Kesenian Kota','Ruang Serba Guna','Panggung Outdoor','Balai Budaya Kabupaten']),
            'poster'          => null,
            'tipe'            => $this->faker->randomElement(['latihan','latihan','pementasan','lomba']),
            'status'          => $this->faker->randomElement(['aktif','aktif','selesai','draft']),
        ];
    }
}