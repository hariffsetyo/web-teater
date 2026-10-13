<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->enum('divisi', ['akting','naskah','tata_rias','tata_panggung','musik','humas']);
            $table->year('angkatan');
            $table->string('kelas', 20);
            $table->string('no_hp', 20)->nullable();
            $table->text('bio')->nullable();
            $table->enum('status', ['aktif','alumni'])->default('aktif');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('members'); }
};
