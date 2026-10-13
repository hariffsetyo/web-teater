@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.prestasi.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Prestasi
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Edit Data Prestasi</h2>
            <p class="text-xs text-parchment-400">Perbarui catatan raihan {{ $achievement->nama_lomba }}.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.prestasi.update', $achievement) }}" enctype="multipart/form-data" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf
        @method('PUT')

        <!-- Nama Lomba -->
        <x-admin.form-field
            label="Nama Festival / Perlombaan Seni"
            name="nama_lomba"
            :value="old('nama_lomba', $achievement->nama_lomba)"
            :required="true"
        />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Peringkat -->
            <x-admin.form-field
                label="Peringkat / Gelar Juara"
                name="peringkat"
                :value="old('peringkat', $achievement->peringkat)"
                :required="true"
            />

            <!-- Tingkat -->
            <div class="space-y-1.5">
                <label for="tingkat" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Tingkat <span class="text-rose-400">*</span>
                </label>
                <select id="tingkat" name="tingkat" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    @foreach(['sekolah' => 'Tingkat Sekolah', 'kabupaten' => 'Tingkat Kabupaten/Kota', 'provinsi' => 'Tingkat Provinsi', 'nasional' => 'Tingkat Nasional', 'internasional' => 'Internasional'] as $k => $v)
                        <option value="{{ $k }}" {{ old('tingkat', $achievement->tingkat) == $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
                @error('tingkat') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Tahun -->
            <x-admin.form-field
                label="Tahun Raihan"
                name="tahun"
                type="number"
                :value="old('tahun', $achievement->tahun)"
                :required="true"
            />
        </div>

        <!-- Deskripsi Singkat -->
        <x-admin.form-field
            label="Keterangan / Naskah yang Dibawakan"
            name="deskripsi"
            type="textarea"
            :value="old('deskripsi', $achievement->deskripsi)"
        />

        <!-- Foto Dokumentasi Piala -->
        <x-admin.image-upload
            name="foto"
            label="Ganti Foto Piala / Penyerahan"
            :current="$achievement->foto"
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.prestasi.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection
