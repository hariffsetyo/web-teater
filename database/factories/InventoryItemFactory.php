<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class InventoryItemFactory extends Factory {
    protected array $items = [
        ['Kostum Raja Sangkuriang','kostum','Gudang Kostum A'],
        ['Kostum Dayang Sumbi','kostum','Gudang Kostum A'],
        ['Kostum Nelayan Malam Jahanam','kostum','Gudang Kostum B'],
        ['Mahkota Raja','properti','Lemari Properti 1'],
        ['Tongkat Sihir','properti','Lemari Properti 1'],
        ['Pedang Panggung','properti','Lemari Properti 2'],
        ['Kursi Panggung Kayu','properti','Gudang Properti Besar'],
        ['Meja Antik Properti','properti','Gudang Properti Besar'],
        ['Lampu Spotlight LED 200W','lighting','Gudang Teknis'],
        ['Lampu Fresnel 500W','lighting','Gudang Teknis'],
        ['Lampu Par Can RGB','lighting','Gudang Teknis'],
        ['Gitar Akustik Yamaha','alat_musik','Ruang Musik'],
        ['Keyboard Roland','alat_musik','Ruang Musik'],
        ['Cajon','alat_musik','Ruang Musik'],
        ['Wig Rambut Panjang','kostum','Gudang Kostum A'],
        ['Foundation Make-up Set','lainnya','Laci Rias'],
        ['Smoke Machine','lainnya','Gudang Teknis'],
        ['Mikrofon Lapel','lainnya','Gudang Teknis'],
        ['Kain Tirai Merah','properti','Gudang Properti Besar'],
        ['Boneka Wayang Kulit','properti','Lemari Properti 2'],
    ];
    public function definition(): array {
        $item = $this->faker->randomElement($this->items);
        return [
            'nama_barang'   => $item[0],
            'kategori'      => $item[1],
            'kondisi'       => $this->faker->randomElement(['baik','baik','baik','rusak_ringan']),
            'jumlah_stok'   => $this->faker->numberBetween(1,5),
            'foto'          => null,
            'lokasi_simpan' => $item[2],
            'deskripsi'     => $this->faker->optional(0.6)->sentence(8),
        ];
    }
}