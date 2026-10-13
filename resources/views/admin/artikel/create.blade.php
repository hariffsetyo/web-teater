@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.artikel.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Daftar Artikel
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Tulis Artikel Baru</h2>
            <p class="text-xs text-parchment-400">Bagikan wawasan teater, catatan pementasan, atau teknik keaktoran.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf

        <!-- Judul -->
        <x-admin.form-field
            label="Judul Artikel"
            name="judul"
            placeholder="Contoh: Mengolah Rasa dan Vokal di Balik Tirai Panggung"
            :required="true"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Kategori -->
            <x-admin.form-field
                label="Kategori / Topik"
                name="kategori"
                placeholder="Keaktoran, Tata Panggung, Naskah, Ulasan Pentas"
            />

            <!-- Status Publikasi -->
            <div class="space-y-1.5">
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Status Publikasi <span class="text-rose-400">*</span>
                </label>
                <select id="status" name="status" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Terbitkan Sekarang (Published)</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Simpan sebagai Draf (Draft)</option>
                </select>
                @error('status') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Thumbnail Banner -->
        <x-admin.image-upload
            name="thumbnail"
            label="Gambar Sampul / Thumbnail Artikel (Lanskap)"
        />

        <!-- Konten dengan Trix Editor -->
        <div class="space-y-1.5">
            <label for="konten" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                Isi Lengkap Artikel <span class="text-rose-400">*</span>
            </label>
            <input id="konten" type="hidden" name="konten" value="{{ old('konten') }}">
            <div class="trix-dark-container">
                <trix-editor input="konten" class="min-h-[280px] bg-stage-dark border border-stage-border rounded-2xl p-4 text-sm text-parchment-100 focus:outline-none focus:border-gold-500"></trix-editor>
            </div>
            @error('konten') <p class="text-xs text-rose-400 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.artikel.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan & Publikasikan
            </button>
        </div>
    </form>

</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<style>
    .trix-button-row { background: #1A0D10; border-radius: 0.75rem; border: 1px solid rgba(212, 175, 55, 0.2); }
    trix-toolbar .trix-button { filter: invert(0.8); }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
