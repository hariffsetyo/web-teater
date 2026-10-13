@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.event.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Agenda Event
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Jadwalkan Event Baru</h2>
            <p class="text-xs text-parchment-400">Atur jadwal pementasan teater, latihan rutin bersama, atau pendaftaran lomba.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf

        <!-- Judul -->
        <x-admin.form-field
            label="Judul Agenda / Nama Lakon Pementasan"
            name="judul"
            placeholder="Contoh: Pementasan Akbar 'Tirai Terakhir Sang Raja'"
            :required="true"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Tipe -->
            <div class="space-y-1.5">
                <label for="tipe" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Tipe Agenda <span class="text-rose-400">*</span>
                </label>
                <select id="tipe" name="tipe" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="pementasan" {{ old('tipe', 'pementasan') == 'pementasan' ? 'selected' : '' }}>🎭 Pementasan Teater</option>
                    <option value="latihan" {{ old('tipe') == 'latihan' ? 'selected' : '' }}>⏱️ Latihan Rutin</option>
                    <option value="lomba" {{ old('tipe') == 'lomba' ? 'selected' : '' }}>🏆 Lomba / Festival Teater</option>
                </select>
                @error('tipe') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div class="space-y-1.5">
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Status Event <span class="text-rose-400">*</span>
                </label>
                <select id="status" name="status" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif (Dipublikasikan)</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan Dulu)</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
                @error('status') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Tanggal & Jam Mulai -->
            <x-admin.form-field
                label="Tanggal & Waktu Mulai"
                name="tanggal_mulai"
                type="datetime-local"
                :required="true"
            />

            <!-- Tanggal & Jam Selesai -->
            <x-admin.form-field
                label="Tanggal & Waktu Selesai (Opsional)"
                name="tanggal_selesai"
                type="datetime-local"
            />
        </div>

        <!-- Lokasi -->
        <x-admin.form-field
            label="Lokasi / Gedung Pertunjukan"
            name="lokasi"
            placeholder="Contoh: Gedung Kesenian Rumentang Siang / Aula Utama Sekolah"
        />

        <!-- Deskripsi -->
        <x-admin.form-field
            label="Deskripsi Lengkap / Sinopsis Agenda"
            name="deskripsi"
            type="textarea"
            placeholder="Jelaskan alur, dress code, atau informasi penting acara..."
        />

        <!-- Poster Banner -->
        <x-admin.image-upload
            name="poster"
            label="Unggah Poster / Banner Resmi (Disarankan Lanskap 16:9)"
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.event.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan & Jadwalkan
            </button>
        </div>
    </form>

</div>
@endsection
