<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp', 20);
            $table->string('kelas', 20);
            $table->text('alasan_daftar');
            $table->text('motivasi')->nullable();
            $table->string('file_audisi')->nullable();
            $table->enum('status', ['pending','diterima','ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrations'); }
};
