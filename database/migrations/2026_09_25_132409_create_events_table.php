<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('poster')->nullable();
            $table->enum('tipe', ['latihan','pementasan','lomba'])->default('latihan');
            $table->enum('status', ['draft','aktif','selesai','batal'])->default('draft');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('events'); }
};
