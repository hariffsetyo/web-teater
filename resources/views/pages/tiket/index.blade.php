<x-layouts.public title="Tiket & Reservasi Pementasan — Teater Siklus">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[['label' => 'Tiket Pementasan', 'url' => null]]" />

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="space-y-4 max-w-2xl">
                <x-badge variant="gold">✦ LOKET DIGITAL SANGGAR ✦</x-badge>
                <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                    Reservasi Tiket <span class="text-gold-gradient gold-glow">Panggung Sandiwara</span>
                </h1>
                <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                    Pilih lakon yang ingin Anda tonton dan amankan kursi penonton Anda sekarang. Dapatkan e-tiket resmi lengkap dengan barcode digital.
                </p>
            </div>

            <div class="flex-shrink-0">
                <x-button href="{{ route('tiket.cek') }}" variant="outline" size="md">
                    🔍 Cek Tiket Saya
                </x-button>
            </div>
        </div>

        @if($performances->isEmpty())
            <x-empty-state
                title="Belum Ada Loket Tiket yang Buka"
                message="Saat ini belum ada lakon pementasan dengan reservasi tiket yang sedang dibuka. Pantau terus linimasa agenda kami."
                icon="🎟️"
                actionText="Lihat Kalender Agenda"
                actionUrl="{{ route('events.index') }}"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($performances as $p)
                    @php
                        $terjual = $p->ticketReservations()->whereIn('status', ['confirmed','hadir','pending'])->sum('jumlah_tiket');
                        $sisa = max(0, $p->kuota_kursi - $terjual);
                        $persenTerisi = min(100, round((($p->kuota_kursi - $sisa) / max(1, $p->kuota_kursi)) * 100));
                    @endphp

                    <div class="card-theater p-7 flex flex-col justify-between group relative overflow-hidden">
                        <div>
                            <!-- Header Badges -->
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <x-badge variant="gold">
                                    {{ $p->harga_tiket ? 'Rp ' . number_format($p->harga_tiket, 0, ',', '.') : 'TIKET GRATIS' }}
                                </x-badge>
                                <span class="text-[11px] px-2 py-0.5 rounded-full bg-emerald-950/80 text-emerald-400 border border-emerald-500/40">
                                    Loket Buka
                                </span>
                            </div>

                            <h3 class="font-serif text-2xl font-bold text-parchment-100 group-hover:text-gold-300 transition-colors mb-2">
                                {{ $p->judul_pementasan }}
                            </h3>

                            <p class="text-xs sm:text-sm text-parchment-300 leading-relaxed mb-6 line-clamp-3">
                                {{ $p->sinopsis ?? $p->event->deskripsi ?? 'Sebuah sajian pementasan drama teatrikal persembahan Sanggar Teater Siklus.' }}
                            </p>

                            <!-- Waktu & Lokasi -->
                            <div class="space-y-2 text-xs text-parchment-300 mb-6 bg-stage-surface/50 p-4 rounded-xl border border-stage-border">
                                <div class="flex items-center gap-2">
                                    <span>📅</span>
                                    <span>{{ $p->event->tanggal_mulai ? $p->event->tanggal_mulai->translatedFormat('l, d F Y') : '-' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span>⏰</span>
                                    <span>{{ $p->event->tanggal_mulai ? $p->event->tanggal_mulai->format('H:i') : '15:30' }} WIB</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span>📍</span>
                                    <span>{{ $p->event->lokasi ?? 'Aula Utama Sekolah' }}</span>
                                </div>
                            </div>

                            <!-- Kuota Bar -->
                            <div class="space-y-1.5 mb-6">
                                <div class="flex justify-between text-xs text-parchment-300">
                                    <span>Sisa Kursi: <strong class="text-gold-400">{{ $sisa }}</strong></span>
                                    <span class="text-stage-muted">{{ $p->kuota_kursi }} Total</span>
                                </div>
                                <div class="w-full h-2 rounded-full bg-stage-dark overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-maroon-600 to-gold-400 rounded-full" style="width: {{ $persenTerisi }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div>
                            @if($sisa > 0)
                                <x-button href="{{ route('tiket.show', $p->id) }}" variant="primary" size="md" class="w-full">
                                    Reservasi Kursi Sekarang 🎟️
                                </x-button>
                            @else
                                <button disabled class="w-full py-3 bg-stage-surface text-stage-muted font-bold text-xs uppercase tracking-wider rounded-xl cursor-not-allowed">
                                    Kursi Habis Terpesan
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-layouts.public>