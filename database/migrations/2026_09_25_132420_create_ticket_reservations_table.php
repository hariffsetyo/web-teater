<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ticket_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp', 20);
            $table->unsignedTinyInteger('jumlah_tiket')->default(1);
            $table->string('kode_tiket')->unique();
            $table->enum('status', ['pending','confirmed','hadir','batal'])->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ticket_reservations'); }
};
