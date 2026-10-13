<?php
namespace Database\Factories;
use App\Models\InventoryItem;
use Illuminate\Database\Eloquent\Factories\Factory;
class InventoryLogFactory extends Factory {
    public function definition(): array {
        $pinjam = $this->faker->dateTimeBetween('-3 months','-1 week');
        $rencana = (clone $pinjam)->modify('+7 days');
        $status = $this->faker->randomElement(['dikembalikan','dikembalikan','dipinjam']);
        return [
            'inventory_item_id'       => InventoryItem::inRandomOrder()->value('id'),
            'dipinjam_oleh'           => $this->faker->name(),
            'jumlah_pinjam'           => $this->faker->numberBetween(1,3),
            'tanggal_pinjam'          => $pinjam->format('Y-m-d'),
            'tanggal_kembali_rencana' => $rencana->format('Y-m-d'),
            'tanggal_kembali_aktual'  => $status==='dikembalikan' ? (clone $rencana)->modify('+'.$this->faker->numberBetween(-2,3).' days')->format('Y-m-d') : null,
            'status'                  => $status,
            'catatan'                 => $this->faker->optional(0.4)->sentence(),
        ];
    }
}