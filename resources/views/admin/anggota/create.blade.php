@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.anggota.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Daftar Anggota
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Tambah Anggota Baru</h2>
            <p class="text-xs text-parchment-400">Masukkan profil lengkap personil teater dan divisi panggungnya.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.anggota.store') }}" enctype="multipart/form-data" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Nama -->
            <x-admin.form-field
                label="Nama Lengkap"
                name="nama"
                placeholder="Contoh: Rian Anggara"
                :required="true"
            />

            <!-- Divisi -->
            <div class="space-y-1.5">
                <label for="divisi" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Divisi Panggung <span class="text-rose-400">*</span>
                </label>
                <select id="divisi" name="divisi" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="">Pilih Divisi...</option>
                    <option value="akting" {{ old('divisi') == 'akting' ? 'selected' : '' }}>🎭 Akting (Pemeran)</option>
                    <option value="naskah" {{ old('divisi') == 'naskah' ? 'selected' : '' }}>📜 Penulisan Naskah</option>
                    <option value="tata_rias" {{ old('divisi') == 'tata_rias' ? 'selected' : '' }}>💄 Tata Rias & Kostum</option>
                    <option value="tata_panggung" {{ old('divisi') == 'tata_panggung' ? 'selected' : '' }}>🔨 Tata Panggung & Artistik</option>
                    <option value="musik" {{ old('divisi') == 'musik' ? 'selected' : '' }}>🎵 Musik & Efek Suara</option>
                    <option value="humas" {{ old('divisi') == 'humas' ? 'selected' : '' }}>📢 Humas & Dokumentasi</option>
                </select>
                @error('divisi') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Angkatan -->
            <x-admin.form-field
                label="Tahun Angkatan"
                name="angkatan"
                type="number"
                placeholder="Contoh: 2025"
                :value="old('angkatan', date('Y'))"
                :required="true"
            />

            <!-- Kelas -->
            <x-admin.form-field
                label="Kelas / Jurusan"
                name="kelas"
                placeholder="Contoh: XI IPA 2"
                :required="true"
            />

            <!-- No HP / WhatsApp -->
            <x-admin.form-field
                label="Nomor WhatsApp"
                name="no_hp"
                placeholder="Contoh: 081234567890"
            />

            <!-- Status -->
            <div class="space-y-1.5">
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Status Keanggotaan <span class="text-rose-400">*</span>
                </label>
                <select id="status" name="status" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="alumni" {{ old('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
                @error('status') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Bio / Catatan Singkat -->
        <x-admin.form-field
            label="Biografi Singkat / Pengalaman Seni"
            name="bio"
            type="textarea"
            placeholder="Tuliskan pengalaman peran, ketertarikan naskah, atau portofolio singkat..."
        />

        <!-- Foto Anggota -->
        <x-admin.image-upload
            name="foto"
            label="Foto Profil Anggota"
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.anggota.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan Anggota
            </button>
        </div>
    </form>

</div>
@endsection
