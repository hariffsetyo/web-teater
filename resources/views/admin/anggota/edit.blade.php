@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.anggota.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Daftar Anggota
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Edit Data Anggota</h2>
            <p class="text-xs text-parchment-400">Perbarui profil dan status keanggotaan {{ $member->nama }}.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.anggota.update', $member) }}" enctype="multipart/form-data" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Nama -->
            <x-admin.form-field
                label="Nama Lengkap"
                name="nama"
                :value="old('nama', $member->nama)"
                :required="true"
            />

            <!-- Divisi -->
            <div class="space-y-1.5">
                <label for="divisi" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Divisi Panggung <span class="text-rose-400">*</span>
                </label>
                <select id="divisi" name="divisi" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    @foreach(['akting' => '🎭 Akting (Pemeran)', 'naskah' => '📜 Penulisan Naskah', 'tata_rias' => '💄 Tata Rias & Kostum', 'tata_panggung' => '🔨 Tata Panggung & Artistik', 'musik' => '🎵 Musik & Efek Suara', 'humas' => '📢 Humas & Dokumentasi'] as $k => $v)
                        <option value="{{ $k }}" {{ old('divisi', $member->divisi) == $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
                @error('divisi') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Angkatan -->
            <x-admin.form-field
                label="Tahun Angkatan"
                name="angkatan"
                type="number"
                :value="old('angkatan', $member->angkatan)"
                :required="true"
            />

            <!-- Kelas -->
            <x-admin.form-field
                label="Kelas / Jurusan"
                name="kelas"
                :value="old('kelas', $member->kelas)"
                :required="true"
            />

            <!-- No HP / WhatsApp -->
            <x-admin.form-field
                label="Nomor WhatsApp"
                name="no_hp"
                :value="old('no_hp', $member->no_hp)"
            />

            <!-- Status -->
            <div class="space-y-1.5">
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Status Keanggotaan <span class="text-rose-400">*</span>
                </label>
                <select id="status" name="status" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="aktif" {{ old('status', $member->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="alumni" {{ old('status', $member->status) == 'alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
                @error('status') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Bio / Catatan Singkat -->
        <x-admin.form-field
            label="Biografi Singkat / Pengalaman Seni"
            name="bio"
            type="textarea"
            :value="old('bio', $member->bio)"
        />

        <!-- Foto Anggota -->
        <x-admin.image-upload
            name="foto"
            label="Ganti Foto Profil Anggota"
            :current="$member->foto"
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.anggota.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection
