<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->enum('kategori', ['kostum','properti','alat_musik','lighting','lainnya']);
            $table->enum('kondisi', ['baik','rusak_ringan','rusak_berat'])->default('baik');
            $table->unsignedInteger('jumlah_stok')->default(1);
            $table->string('foto')->nullable();
            $table->string('lokasi_simpan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inventory_items'); }
};
