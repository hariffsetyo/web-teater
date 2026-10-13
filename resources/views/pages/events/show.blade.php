<x-layouts.public :title="$event->judul . ' — Detail Pementasan'">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[
            ['label' => 'Agenda Pementasan', 'url' => route('events.index')],
            ['label' => $event->judul, 'url' => null]
        ]" />

        <!-- Header Event Title & Badges -->
        <div class="space-y-4 mb-8">
            <div class="flex flex-wrap items-center gap-2">
                <x-badge variant="gold">{{ ucfirst($event->tipe) }}</x-badge>
                <span class="text-xs px-2.5 py-0.5 rounded-full {{ $event->status === 'aktif' ? 'bg-emerald-950 text-emerald-400 border border-emerald-500/40' : 'bg-stage-surface text-parchment-300' }}">
                    Status: {{ ucfirst($event->status) }}
                </span>
            </div>
            
            <h1 class="font-serif text-3xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                {{ $event->judul }}
            </h1>
        </div>

        <!-- Event Poster & Main Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-16">
            
            <!-- Poster Showcase (5 col) -->
            <div class="md:col-span-5">
                <div class="rounded-3xl overflow-hidden bg-stage-surface border border-gold-500/30 shadow-2xl relative">
                    <img
                        src="https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?auto=format&fit=crop&w=800&q=80"
                        alt="{{ $event->judul }}"
                        class="w-full h-auto object-cover"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-stage-black/80 via-transparent to-transparent"></div>
                </div>
            </div>

            <!-- Detail Info & Actions (7 col) -->
            <div class="md:col-span-7 space-y-6 flex flex-col justify-between">
                
                <div class="space-y-6">
                    <!-- Tanggal, Waktu, Lokasi Box -->
                    <div class="bg-stage-card border border-stage-border rounded-2xl p-6 space-y-4">
                        <div class="flex items-start gap-4">
                            <span class="text-2xl p-2 rounded-xl bg-stage-surface">📅</span>
                            <div>
                                <h4 class="text-xs font-semibold uppercase text-gold-400 tracking-wider">Tanggal & Jam</h4>
                                <p class="font-semibold text-sm sm:text-base text-parchment-100">
                                    {{ $event->tanggal_mulai ? $event->tanggal_mulai->translatedFormat('l, d F Y') : 'Segera' }}
                                </p>
                                <p class="text-xs text-parchment-300">
                                    Pukul {{ $event->tanggal_mulai ? $event->tanggal_mulai->format('H:i') : '15:30' }} WIB
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 pt-3 border-t border-stage-border">
                            <span class="text-2xl p-2 rounded-xl bg-stage-surface">📍</span>
                            <div>
                                <h4 class="text-xs font-semibold uppercase text-gold-400 tracking-wider">Tempat / Panggung</h4>
                                <p class="font-semibold text-sm sm:text-base text-parchment-100">
                                    {{ $event->lokasi ?? 'Aula Utama Sekolah' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Sinopsis / Deskripsi -->
                    <div class="space-y-3">
                        <h3 class="font-serif text-xl font-bold text-parchment-100">Sinopsis & Catatan Pementasan</h3>
                        <p class="text-sm text-parchment-200 leading-relaxed">
                            {{ $event->deskripsi ?: 'Sebuah eksplorasi seni lakon dramatik yang disutradarai dengan konsep panggung modern, memadukan dialog reflektif dan musik latar yang menggugah nurani.' }}
                        </p>
                    </div>
                </div>

                <!-- Action CTA: Google Calendar & Tiket -->
                <div class="pt-6 border-t border-stage-border flex flex-wrap gap-4 items-center">
                    <a
                        href="{{ $googleCalendarUrl }}"
                        target="_blank"
                        rel="noopener"
                        class="px-5 py-3 rounded-xl bg-stage-surface hover:bg-gold-500/10 text-gold-400 hover:text-gold-300 border border-gold-500/40 font-semibold text-xs uppercase tracking-wider flex items-center gap-2 transition-all"
                    >
                        <span>📅</span>
                        <span>Tambah ke Google Calendar</span>
                    </a>

                    @if($event->performances->isNotEmpty())
                        <x-button href="{{ route('home') }}#gabung" variant="primary" size="md">
                            Reservasi Tiket Pementasan 🎟️
                        </x-button>
                    @endif
                </div>

            </div>

        </div>

        <!-- Galeri Terkait Event -->
        @if($event->galleries->isNotEmpty())
            <div class="mt-20 pt-10 border-t border-stage-border">
                <x-section-title
                    subtitle="DOKUMENTASI LAKON INI"
                    title="Galeri & Cuplikan Adegan"
                    align="left"
                />

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($event->galleries as $g)
                        <div class="card-theater overflow-hidden rounded-2xl group">
                            <div class="h-48 overflow-hidden bg-stage-surface">
                                <img
                                    src="https://images.unsplash.com/photo-1469488865564-c2de10f69f96?auto=format&fit=crop&w=600&q=80"
                                    alt="{{ $g->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="p-4">
                                <h4 class="font-serif text-sm font-bold text-parchment-100">{{ $g->judul }}</h4>
                                <span class="text-[10px] text-gold-400 uppercase tracking-wider mt-1 block">{{ $g->kategori ?? 'Dokumentasi' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</x-layouts.public>