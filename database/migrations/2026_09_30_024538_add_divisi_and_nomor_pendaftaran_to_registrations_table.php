<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('nomor_pendaftaran')->nullable()->unique()->after('id');
            $table->string('divisi')->nullable()->after('kelas');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['nomor_pendaftaran', 'divisi']);
        });
    }
};