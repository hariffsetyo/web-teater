<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['hadir','izin','alpha'])->default('alpha');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->unique(['member_id', 'event_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('attendances'); }
};
