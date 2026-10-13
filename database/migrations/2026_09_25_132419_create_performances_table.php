<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('judul_pementasan');
            $table->text('sinopsis')->nullable();
            $table->unsignedInteger('kuota_kursi')->default(100);
            $table->decimal('harga_tiket', 10, 2)->nullable()->comment('null = gratis');
            $table->enum('status', ['buka','tutup'])->default('tutup');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('performances'); }
};
