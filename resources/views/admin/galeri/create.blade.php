@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.galeri.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Galeri
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Tambah Media Dokumentasi</h2>
            <p class="text-xs text-parchment-400">Unggah foto panggung atau tautkan video YouTube pementasan teater.</p>
        </div>
    </div>

    <!-- Form Box with Alpine for Type Toggle -->
    <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" 
          x-data="{ mediaType: '{{ old('tipe', 'foto') }}' }" 
          class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf

        <!-- Judul -->
        <x-admin.form-field
            label="Judul Foto / Video"
            name="judul"
            placeholder="Contoh: Gladi Resik Babak II — Tirai Terakhir Sang Raja"
            :required="true"
        />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Tipe Media -->
            <div class="space-y-1.5">
                <label for="tipe" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Tipe Media <span class="text-rose-400">*</span>
                </label>
                <select id="tipe" name="tipe" x-model="mediaType" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="foto">📷 Foto Dokumentasi</option>
                    <option value="video">🎬 Video Pementasan</option>
                </select>
                @error('tipe') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Event Terkait -->
            <div class="space-y-1.5">
                <label for="event_id" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Agenda Terkait
                </label>
                <select id="event_id" name="event_id" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="">Tidak Terikat Event (Umum)</option>
                    @foreach($events as $ev)
                        <option value="{{ $ev->id }}" {{ old('event_id') == $ev->id ? 'selected' : '' }}>
                            {{ $ev->judul }}
                        </option>
                    @endforeach
                </select>
                @error('event_id') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Kategori -->
            <x-admin.form-field
                label="Kategori / Tag"
                name="kategori"
                placeholder="Pentas, Latihan, Behind The Scene"
            />
        </div>

        <!-- Dynamic Input: Foto vs Video -->
        <div x-show="mediaType === 'foto'" class="space-y-3">
            <x-admin.image-upload
                name="foto"
                label="Unggah Berkas Foto (Maks 8MB)"
            />
        </div>

        <div x-show="mediaType === 'video'" class="space-y-1.5" x-cloak>
            <x-admin.form-field
                label="Tautan Video YouTube (URL Lengkap)"
                name="url_video"
                placeholder="https://www.youtube.com/watch?v=..."
            />
            <p class="text-[11px] text-stage-muted">Mendukung tautan standar YouTube atau YouTube Shorts.</p>
        </div>

        <!-- Deskripsi Singkat -->
        <x-admin.form-field
            label="Keterangan / Caption"
            name="deskripsi"
            type="textarea"
            placeholder="Jelaskan momen dramatis atau latar adegan dalam foto/video ini..."
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.galeri.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan Media
            </button>
        </div>
    </form>

</div>
@endsection
