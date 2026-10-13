<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('podcast_episodes', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file_audio')->nullable();
            $table->string('url_audio')->nullable();
            $table->string('durasi', 20)->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('kategori', ['drama_audio','behind_the_scenes','wawancara'])->default('drama_audio');
            $table->unsignedBigInteger('jumlah_play')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('podcast_episodes'); }
};
