@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.event.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Agenda Event
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Edit Agenda Event</h2>
            <p class="text-xs text-parchment-400">Perbarui jadwal, lokasi, atau status {{ $event->judul }}.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.event.update', $event) }}" enctype="multipart/form-data" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <x-admin.form-field
            label="Judul Agenda / Nama Lakon Pementasan"
            name="judul"
            :value="old('judul', $event->judul)"
            :required="true"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Tipe -->
            <div class="space-y-1.5">
                <label for="tipe" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Tipe Agenda <span class="text-rose-400">*</span>
                </label>
                <select id="tipe" name="tipe" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="pementasan" {{ old('tipe', $event->tipe) == 'pementasan' ? 'selected' : '' }}>🎭 Pementasan Teater</option>
                    <option value="latihan" {{ old('tipe', $event->tipe) == 'latihan' ? 'selected' : '' }}>⏱️ Latihan Rutin</option>
                    <option value="lomba" {{ old('tipe', $event->tipe) == 'lomba' ? 'selected' : '' }}>🏆 Lomba / Festival Teater</option>
                </select>
                @error('tipe') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div class="space-y-1.5">
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Status Event <span class="text-rose-400">*</span>
                </label>
                <select id="status" name="status" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="aktif" {{ old('status', $event->status) == 'aktif' ? 'selected' : '' }}>Aktif (Dipublikasikan)</option>
                    <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft (Simpan Dulu)</option>
                    <option value="selesai" {{ old('status', $event->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ old('status', $event->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
                @error('status') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Tanggal & Jam Mulai -->
            <x-admin.form-field
                label="Tanggal & Waktu Mulai"
                name="tanggal_mulai"
                type="datetime-local"
                :value="old('tanggal_mulai', $event->tanggal_mulai ? $event->tanggal_mulai->format('Y-m-d\TH:i') : '')"
                :required="true"
            />

            <!-- Tanggal & Jam Selesai -->
            <x-admin.form-field
                label="Tanggal & Waktu Selesai (Opsional)"
                name="tanggal_selesai"
                type="datetime-local"
                :value="old('tanggal_selesai', $event->tanggal_selesai ? $event->tanggal_selesai->format('Y-m-d\TH:i') : '')"
            />
        </div>

        <!-- Lokasi -->
        <x-admin.form-field
            label="Lokasi / Gedung Pertunjukan"
            name="lokasi"
            :value="old('lokasi', $event->lokasi)"
        />

        <!-- Deskripsi -->
        <x-admin.form-field
            label="Deskripsi Lengkap / Sinopsis Agenda"
            name="deskripsi"
            type="textarea"
            :value="old('deskripsi', $event->deskripsi)"
        />

        <!-- Poster Banner -->
        <x-admin.image-upload
            name="poster"
            label="Ganti Poster / Banner Resmi"
            :current="$event->poster"
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.event.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection
