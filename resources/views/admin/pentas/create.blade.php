@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.pentas.index') }}" class="text-xs text-gold-400 hover:underline flex items-center gap-1 mb-1">
                ← Kembali ke Lakon & Tiket
            </a>
            <h2 class="font-serif text-2xl font-bold text-parchment-100">Buka Lakon Pementasan Baru</h2>
            <p class="text-xs text-parchment-400">Hubungkan dengan agenda pementasan, atur kuota kursi penonton dan tarif tiket.</p>
        </div>
    </div>

    <!-- Form Box -->
    <form method="POST" action="{{ route('admin.pentas.store') }}" class="bg-stage-card/80 border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
        @csrf

        <!-- Judul Pementasan -->
        <x-admin.form-field
            label="Judul Lakon Pementasan"
            name="judul_pementasan"
            placeholder="Contoh: Sang Pangeran dalam Tirai Kelam"
            :required="true"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Event Relasi -->
            <div class="space-y-1.5">
                <label for="event_id" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Agenda Event Terkait <span class="text-rose-400">*</span>
                </label>
                <select id="event_id" name="event_id" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="">Pilih Jadwal Event...</option>
                    @foreach($events as $ev)
                        <option value="{{ $ev->id }}" {{ old('event_id') == $ev->id ? 'selected' : '' }}>
                            {{ $ev->judul }} ({{ $ev->tanggal_mulai ? $ev->tanggal_mulai->format('d/m/Y') : '-' }})
                        </option>
                    @endforeach
                </select>
                @error('event_id') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Status Loket -->
            <div class="space-y-1.5">
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
                    Status Loket Tiket <span class="text-rose-400">*</span>
                </label>
                <select id="status" name="status" required class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="buka" {{ old('status', 'buka') == 'buka' ? 'selected' : '' }}>🟢 Buka (Dapat Dipesan Penonton)</option>
                    <option value="tutup" {{ old('status') == 'tutup' ? 'selected' : '' }}>🔴 Tutup (Loket Belum Dibuka)</option>
                </select>
                @error('status') <p class="text-xs text-rose-400">{{ $message }}</p> @enderror
            </div>

            <!-- Kuota Kursi -->
            <x-admin.form-field
                label="Kapasitas Kuota Kursi (Jumlah Tiket)"
                name="kuota_kursi"
                type="number"
                placeholder="Contoh: 150"
                :value="old('kuota_kursi', 100)"
                :required="true"
            />

            <!-- Harga Tiket -->
            <x-admin.form-field
                label="Harga Tiket (Rp) — Kosongkan jika Gratis"
                name="harga_tiket"
                type="number"
                placeholder="Contoh: 25000 (0 atau kosong = Gratis)"
                :value="old('harga_tiket')"
            />
        </div>

        <!-- Sinopsis -->
        <x-admin.form-field
            label="Sinopsis Lakon / Petunjuk Tempat Duduk"
            name="sinopsis"
            type="textarea"
            placeholder="Tuliskan gambaran cerita pentas dan ketentuan tiket untuk penonton..."
        />

        <!-- Actions -->
        <div class="pt-4 border-t border-stage-border flex items-center justify-end gap-3">
            <a href="{{ route('admin.pentas.index') }}" class="px-5 py-2.5 rounded-xl bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 text-xs font-semibold transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition">
                Simpan & Buka Pementasan
            </button>
        </div>
    </form>

</div>
@endsection
