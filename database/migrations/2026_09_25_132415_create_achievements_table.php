<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lomba');
            $table->year('tahun');
            $table->enum('tingkat', ['sekolah','kabupaten','provinsi','nasional','internasional']);
            $table->string('peringkat', 50);
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('achievements'); }
};
