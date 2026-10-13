@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.testimonial.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Testimonial
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Tambah Testimonial Baru</h2>
            <p class="text-xs text-parchment-400">Masukkan ulasan, testimoni alumni, atau apresiasi penonton pertunjukan.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.testimonial.store') }}" enctype="multipart/form-data" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Nama -->
            <x-admin.form-field
                label="Nama Tokoh / Penonton"
                name="nama"
                placeholder="Contoh: Dr. Budi Santoso, M.Sn"
                :required="true"
            />

            <!-- Peran -->
            <x-admin.form-field
                label="Jabatan / Peran"
                name="peran"
                placeholder="Contoh: Pengamat Teater / Alumni 2021"
            />
        </div>

        <!-- Isi Testimoni -->
        <x-admin.form-field
            label="Kutipan Testimoni Apresiasi"
            name="isi"
            type="textarea"
            placeholder="Tuliskan pengalaman menyaksikan pementasan atau kesan selama di Teater Siklus..."
            :required="true"
        />

        <!-- Checkbox Featured -->
        <div class="flex items-center gap-3 p-3 rounded-xl bg-stage-dark border border-stage-border">
            <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="rounded border-stage-border bg-stage-dark text-gold-500 focus:ring-gold-500/40">
            <label for="featured" class="text-xs text-parchment-200 cursor-pointer">
                <strong>Tampilkan di Slider Beranda Utama</strong> (Featured testimonial)
            </label>
        </div>

        <!-- Foto Tokoh -->
        <x-admin.image-upload
            name="foto"
            label="Foto Tokoh (Opsional, Rasio 1:1)"
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.testimonial.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan Testimonial
            </button>
        </div>
    </form>

</div>
@endsection
