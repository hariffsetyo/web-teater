<x-layouts.public title="Beranda — Panggung Sandiwara & Eksplorasi Seni">

    {{-- A. INTRO OPENING CURTAIN ANIMATION (Sekali per sesi) --}}
    <div
        x-data="{
            opened: false,
            init() {
                if (sessionStorage.getItem('curtain_opened')) {
                    this.opened = true;
                } else {
                    setTimeout(() => { this.openCurtain(); }, 2400);
                }
            },
            openCurtain() {
                this.opened = true;
                sessionStorage.setItem('curtain_opened', 'true');
            }
        }"
        x-show="!opened"
        x-cloak
        class="fixed inset-0 z-50 overflow-hidden pointer-events-auto flex items-center justify-center bg-stage-black"
    >
        <div class="absolute top-0 left-0 bottom-0 w-1/2 velvet-curtain border-r-2 border-gold-500/40 z-10 transition-transform duration-1000 ease-[cubic-bezier(0.77,0,0.175,1)]" :class="opened ? '-translate-x-full' : 'translate-x-0'">
            <div class="h-full w-full bg-gradient-to-r from-black/60 via-transparent to-black/70"></div>
        </div>
        <div class="absolute top-0 right-0 bottom-0 w-1/2 velvet-curtain border-l-2 border-gold-500/40 z-10 transition-transform duration-1000 ease-[cubic-bezier(0.77,0,0.175,1)]" :class="opened ? 'translate-x-full' : 'translate-x-0'">
            <div class="h-full w-full bg-gradient-to-l from-black/60 via-transparent to-black/70"></div>
        </div>
        <div class="relative z-20 text-center px-4 max-w-lg transition-opacity duration-700" :class="opened ? 'opacity-0 scale-90' : 'opacity-100 scale-100'">
            <div class="inline-block p-4 rounded-full bg-maroon-900/80 border border-gold-500/50 shadow-gold-glow mb-6 animate-pulse">
                <span class="text-5xl sm:text-6xl">🎭</span>
            </div>
            <h2 class="font-serif text-3xl sm:text-4xl font-extrabold text-gold-400 tracking-wider mb-2">TEATER SIKLUS</h2>
            <p class="text-sm font-sans tracking-widest uppercase text-parchment-200 mb-8 opacity-90">Tirai Dibuka • Sandiwara Dimulai</p>
            <button type="button" @click="openCurtain()" class="px-6 py-2.5 bg-stage-black/80 hover:bg-gold-500 hover:text-stage-black text-gold-400 border border-gold-500/60 rounded-full text-xs font-semibold uppercase tracking-widest transition-all duration-300 shadow-lg hover:shadow-gold-500/30">
                Buka Panggung Sekarang ✦
            </button>
        </div>
    </div>

    {{-- B. HERO SECTION --}}
    <section
        x-data="{
            mouseX: 50, mouseY: 30,
            textArray: ['Seni Peran Menghidupkan Jiwa.', 'Panggung Tempat Ekspresi Bersuara.', 'Lakon Nyata Menembus Zaman.'],
            textIndex: 0, charIndex: 0, currentText: '', isDeleting: false, typeSpeed: 100,
            init() { this.typeLoop(); },
            typeLoop() {
                const fullText = this.textArray[this.textIndex];
                if (this.isDeleting) {
                    this.currentText = fullText.substring(0, this.charIndex - 1);
                    this.charIndex--;
                    this.typeSpeed = 50;
                } else {
                    this.currentText = fullText.substring(0, this.charIndex + 1);
                    this.charIndex++;
                    this.typeSpeed = 110;
                }
                if (!this.isDeleting && this.charIndex === fullText.length) {
                    this.isDeleting = true;
                    this.typeSpeed = 2200;
                } else if (this.isDeleting && this.charIndex === 0) {
                    this.isDeleting = false;
                    this.textIndex = (this.textIndex + 1) % this.textArray.length;
                    this.typeSpeed = 400;
                }
                setTimeout(() => this.typeLoop(), this.typeSpeed);
            }
        }"
        @mousemove=\"mouseX = ($event.clientX / window.innerWidth) * 100; mouseY = ($event.clientY / window.innerHeight) * 100;\"
        class="relative min-h-[90vh] flex items-center justify-center overflow-hidden py-24 sm:py-32"
    >
        <div class="absolute inset-0 pointer-events-none transition-all duration-75" :style=\"`background: radial-gradient(850px circle at ${mouseX}% ${mouseY}%, rgba(212, 175, 55, 0.12) 0%, rgba(91, 15, 26, 0.08) 35%, transparent 75%)\`\"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-stage-black via-stage-card/40 to-stage-black pointer-events-none"></div>
        <div class="hidden md:block absolute top-0 left-0 w-24 lg:w-36 h-full velvet-curtain opacity-40 shadow-2xl pointer-events-none"></div>
        <div class="hidden md:block absolute top-0 right-0 w-24 lg:w-36 h-full velvet-curtain opacity-40 shadow-2xl pointer-events-none"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-stage-surface/80 border border-gold-500/30 text-gold-400 text-xs sm:text-sm font-medium mb-8 shadow-sm backdrop-blur-sm animate-float">
                <span class="text-base">🎭</span>
                <span>Sanggar Teater SMA Negeri 1 • Musim Pementasan 2026</span>
                <span class="text-gold-500">✦</span>
            </div>
            <h1 class="font-serif text-4xl sm:text-6xl md:text-7xl font-extrabold text-parchment-100 tracking-tight leading-[1.15] mb-6">
                Di Balik Tirai Sandiwara,<br/>
                <span class="text-gold-gradient gold-glow inline-block min-h-[1.2em]">
                    <span x-text="currentText"></span><span class="typewriter-cursor"></span>
                </span>
            </h1>
            <p class="max-w-2xl mx-auto text-base sm:text-lg md:text-xl text-parchment-300 leading-relaxed mb-10 opacity-90">
                Tempat naskah klasik bernyawa, karakter ditemukan, dan setiap tepuk tangan penonton menjadi saksi lahirnya karya seni yang abadi.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
                <x-button href="#gabung" variant="primary" size="lg">Gabung Jadi Anggota 🎭</x-button>
                <x-button href="#pementasan" variant="outline" size="lg">Lihat Pementasan Terkini ✦</x-button>
            </div>
        </div>
    </section>
    {{-- C. STATISTIK COUNTER ANIMASI --}}
    <section
        id="tentang"
        x-data="{
            shown: false,
            members: 0, performances: 0, achievements: 0, alumni: 0,
            animate() {
                this.shown = true;
                this.countTo('members', {{ $stats['members'] }}, 1200);
                this.countTo('performances', {{ $stats['performances'] }}, 1000);
                this.countTo('achievements', {{ $stats['achievements'] }}, 1400);
                this.countTo('alumni', {{ $stats['alumni'] }}, 1500);
            },
            countTo(key, target, duration) {
                if (target === 0) return;
                let start = 0;
                let stepTime = Math.max(Math.floor(duration / target), 30);
                let timer = setInterval(() => {
                    start++;
                    this[key] = start;
                    if (start >= target) clearInterval(timer);
                }, stepTime);
            }
        }"
        x-intersect.once="animate()"
        class="relative py-16 bg-stage-card border-y border-gold-500/20"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <div class="flex flex-col items-center text-center p-4">
                    <span class="text-3xl mb-2 text-gold-400">👥</span>
                    <div class="font-serif font-black text-4xl sm:text-5xl text-parchment-100 flex items-center">
                        <span x-text="members">0</span><span class="text-gold-400 text-2xl sm:text-3xl ml-1">+</span>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-parchment-300 mt-2">Aktor & Kru Aktif</span>
                    <span class="text-[11px] text-stage-muted mt-0.5">Enam divisi teatrikal</span>
                </div>
                <div class="flex flex-col items-center text-center p-4">
                    <span class="text-3xl mb-2 text-gold-400">🎭</span>
                    <div class="font-serif font-black text-4xl sm:text-5xl text-parchment-100 flex items-center">
                        <span x-text="performances">0</span><span class="text-gold-400 text-2xl sm:text-3xl ml-1">+</span>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-parchment-300 mt-2">Lakon Pementasan</span>
                    <span class="text-[11px] text-stage-muted mt-0.5">Dari klasik hingga modern</span>
                </div>
                <div class="flex flex-col items-center text-center p-4">
                    <span class="text-3xl mb-2 text-gold-400">🏆</span>
                    <div class="font-serif font-black text-4xl sm:text-5xl text-parchment-100 flex items-center">
                        <span x-text="achievements">0</span><span class="text-gold-400 text-2xl sm:text-3xl ml-1">+</span>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-parchment-300 mt-2">Piala & Penghargaan</span>
                    <span class="text-[11px] text-stage-muted mt-0.5">Tingkat Kota s.d. Nasional</span>
                </div>
                <div class="flex flex-col items-center text-center p-4">
                    <span class="text-3xl mb-2 text-gold-400">🎓</span>
                    <div class="font-serif font-black text-4xl sm:text-5xl text-parchment-100 flex items-center">
                        <span x-text="alumni">0</span><span class="text-gold-400 text-2xl sm:text-3xl ml-1">+</span>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-parchment-300 mt-2">Alumni Sanggar</span>
                    <span class="text-[11px] text-stage-muted mt-0.5">Berkiprah di dunia seni</span>
                </div>
            </div>
        </div>
    </section>

    {{-- D. PEMENTASAN / EVENT MENDATANG (COUNTDOWN REAL-TIME) --}}
    <section id="pementasan" class="relative py-24 sm:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-section-title
                subtitle="PANGGUNG UTAMA"
                title="Pementasan Mendatang"
                description="Rasakan intensitas adegan langsung dari barisan penonton. Kuota kursi terbatas untuk setiap sesi pementasan."
            />

            @if($upcomingPerformance && $upcomingPerformance->event)
                @php
                    $eventDate = $upcomingPerformance->event->tanggal_mulai ? $upcomingPerformance->event->tanggal_mulai->format('Y-m-d H:i:s') : now()->addDays(14)->format('Y-m-d H:i:s');
                @endphp
                <div
                    x-data="{
                        targetDate: new Date('{{ $eventDate }}').getTime(),
                        days: 0, hours: 0, minutes: 0, seconds: 0,
                        init() {
                            this.update(); setInterval(() => this.update(), 1000);
                        },
                        update() {
                            const diff = this.targetDate - new Date().getTime();
                            if (diff <= 0) return;
                            this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
                            this.hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            this.minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            this.seconds = Math.floor((diff % (1000 * 60)) / 1000);
                        }
                    }"
                    class="relative bg-stage-card border border-gold-500/40 rounded-3xl overflow-hidden shadow-2xl p-6 sm:p-10 lg:p-12"
                >
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        <div class="lg:col-span-7 space-y-6">
                            <div class="flex flex-wrap items-center gap-2.5">
                                <x-badge variant="gold">★ Lakon Pilihan Musim Ini</x-badge>
                                <x-badge variant="maroon">{{ $upcomingPerformance->status === 'buka' ? 'Pemesanan Dibuka' : 'Tiket Segera Hadir' }}</x-badge>
                                @if($upcomingPerformance->harga_tiket)
                                    <span class="text-xs font-semibold text-gold-300">Rp {{ number_format($upcomingPerformance->harga_tiket, 0, ',', '.') }} / tiket</span>
                                @else
                                    <span class="text-xs font-bold text-emerald-400 bg-emerald-950/40 px-2.5 py-0.5 rounded-full border border-emerald-500/30">GRATIS</span>
                                @endif
                            </div>
                            <h3 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-parchment-100">{{ $upcomingPerformance->judul_pementasan }}</h3>
                            <p class="text-sm sm:text-base text-parchment-300 leading-relaxed line-clamp-3">
                                {{ $upcomingPerformance->sinopsis ?? $upcomingPerformance->event->deskripsi }}
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm text-parchment-300">
                                <div class="flex items-center gap-3">
                                    <span class="p-2 rounded-lg bg-stage-surface text-gold-400 text-lg">📅</span>
                                    <div>
                                        <p class="text-stage-muted text-[11px] uppercase">Waktu</p>
                                        <p class="font-semibold text-parchment-100">{{ $upcomingPerformance->event->tanggal_mulai ? $upcomingPerformance->event->tanggal_mulai->translatedFormat('l, d F Y • H:i') : 'Segera' }} WIB</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="p-2 rounded-lg bg-stage-surface text-gold-400 text-lg">📍</span>
                                    <div>
                                        <p class="text-stage-muted text-[11px] uppercase">Lokasi</p>
                                        <p class="font-semibold text-parchment-100">{{ $upcomingPerformance->event->lokasi ?? 'Aula Utama Gedung Seni Budaya' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 flex flex-wrap gap-4 items-center">
                                <x-button href="{{ route('pentas.index') }}" variant="primary" size="md">Reservasi Tiket Sekarang 🎟️</x-button>
                            </div>
                        </div>
                        <div class="lg:col-span-5 flex flex-col items-center justify-center p-6 sm:p-8 bg-stage-surface/70 border border-gold-500/20 rounded-2xl text-center backdrop-blur-sm">
                            <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold mb-4">Hitung Mundur Pementasan</span>
                            <div class="grid grid-cols-4 gap-2 sm:gap-3 w-full max-w-sm mb-4">
                                <div class="bg-stage-dark border border-stage-border p-3 rounded-xl"><span class="font-serif text-2xl font-extrabold text-parchment-100" x-text="String(days).padStart(2, '0')">00</span><span class="text-[10px] text-stage-muted uppercase block">Hari</span></div>
                                <div class="bg-stage-dark border border-stage-border p-3 rounded-xl"><span class="font-serif text-2xl font-extrabold text-parchment-100" x-text="String(hours).padStart(2, '0')">00</span><span class="text-[10px] text-stage-muted uppercase block">Jam</span></div>
                                <div class="bg-stage-dark border border-stage-border p-3 rounded-xl"><span class="font-serif text-2xl font-extrabold text-parchment-100" x-text="String(minutes).padStart(2, '0')">00</span><span class="text-[10px] text-stage-muted uppercase block">Menit</span></div>
                                <div class="bg-stage-dark border border-gold-500/40 p-3 rounded-xl"><span class="font-serif text-2xl font-extrabold text-gold-400 animate-pulse" x-text="String(seconds).padStart(2, '0')">00</span><span class="text-[10px] text-gold-400 uppercase block">Detik</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    {{-- E. DIVISI EKSKUL --}}
    <section class="py-24 bg-stage-dark/50 border-t border-stage-border/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title
                subtitle="EKOSISTEM KARYA"
                title="Enam Pilar Divisi Teater"
                description="Setiap karya pementasan yang megah lahir dari sinergi enam bidang keahlian seni peran dan artistik panggung."
            />
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($divisions as $div)
                    <div class="card-theater p-7 flex flex-col justify-between group relative overflow-hidden">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <span class="text-4xl p-3 rounded-2xl bg-stage-surface border border-gold-500/20 group-hover:scale-110 transition-transform duration-300">{{ $div['icon'] }}</span>
                                <x-badge variant="gold" size="sm">{{ $div['count'] }} Anggota</x-badge>
                            </div>
                            <h3 class="font-serif text-xl sm:text-2xl font-bold text-parchment-100 group-hover:text-gold-300 transition-colors mb-3">{{ $div['name'] }}</h3>
                            <p class="text-sm text-parchment-300 leading-relaxed mb-6">{{ $div['description'] }}</p>
                        </div>
                        <div>
                            <div class="text-[11px] uppercase tracking-wider text-gold-400 font-semibold mb-2 flex items-center gap-1"><span>✦</span> Materi & Keahlian:</div>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($div['skills'] as $skill)
                                    <span class="text-[11px] px-2.5 py-1 rounded-md bg-stage-surface border border-stage-border text-parchment-200">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- F. GALERI SOROTAN (6 FOTO) --}}
    <section class="py-24 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <x-section-title subtitle="DOKUMENTASI PANGGUNG" title="Sorotan Lensa & Rekaman" description="Momen emosional, di balik layar, dan sorak kagum penonton." align="left" class="mb-0" />
                <div class="mt-4 md:mt-0">
                    <x-button href="{{ route('galeri.index') }}" variant="outline" size="md">Lihat Seluruh Galeri 📸</x-button>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredGalleries as $index => $gallery)
                    @php
                        $aspectClasses = [0 => 'sm:col-span-2 h-72 sm:h-80', 1 => 'h-72 sm:h-80', 2 => 'h-72 sm:h-80', 3 => 'h-72 sm:h-80', 4 => 'h-72 sm:h-80', 5 => 'sm:col-span-2 lg:col-span-3 h-64 sm:h-72'][$index] ?? 'h-72';
                        $fallbackImg = "https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?auto=format&fit=crop&w=800&q=80";
                        if ($index % 3 == 1) $fallbackImg = "https://images.unsplash.com/photo-1469488865564-c2de10f69f96?auto=format&fit=crop&w=800&q=80";
                        if ($index % 3 == 2) $fallbackImg = "https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=800&q=80";
                    @endphp
                    <div class="group relative rounded-2xl overflow-hidden bg-stage-card border border-stage-border hover:border-gold-500/50 transition-all duration-300 {{ $aspectClasses }}">
                        <img src="{{ $fallbackImg }}" alt="{{ $gallery->judul }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 filter brightness-90 group-hover:brightness-100" />
                        <div class="absolute inset-0 bg-gradient-to-t from-stage-black via-stage-black/40 to-transparent opacity-80 group-hover:opacity-90"></div>
                        <div class="absolute top-4 left-4 flex items-center gap-2">
                            <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-stage-black/80 text-gold-400 border border-gold-500/30 backdrop-blur-md">
                                {{ $gallery->tipe === 'video' ? '🎬 Video' : '📷 Foto' }}
                            </span>
                            @if($gallery->kategori)
                                <span class="px-2.5 py-1 rounded-md text-[10px] uppercase bg-maroon-900/80 text-parchment-200">{{ $gallery->kategori }}</span>
                            @endif
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-parchment-100">
                            <h4 class="font-serif text-lg sm:text-xl font-bold line-clamp-1 group-hover:text-gold-300 transition-colors">{{ $gallery->judul }}</h4>
                            @if($gallery->event)<p class="text-xs text-parchment-300 mt-1 line-clamp-1">Lakon: {{ $gallery->event->judul }}</p>@endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- G. ARTIKEL TERBARU (3 CARD) --}}
    <section class="py-24 bg-stage-card/50 border-t border-stage-border/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title subtitle="KHAZANAH TEATER" title="Warta, Resensi & Dramaturgi" description="Eksplorasi wawasan seputar teknik keaktoran dan catatan kreatif sutradara." />
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                    <article class="card-theater overflow-hidden flex flex-col group">
                        <div class="relative h-48 w-full overflow-hidden bg-stage-surface">
                            <img src="https://images.unsplash.com/photo-1460723237483-7a6dc9d0b212?auto=format&fit=crop&w=600&q=80" alt="{{ $article->judul }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div class="absolute inset-0 bg-gradient-to-t from-stage-card via-transparent to-transparent"></div>
                            <div class="absolute top-3 left-3"><x-badge variant="gold" size="sm">{{ $article->kategori ?? 'Wawasan' }}</x-badge></div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <div class="flex items-center gap-3 text-xs text-stage-muted mb-2.5">
                                    <span>📅 {{ $article->published_at ? $article->published_at->format('d M Y') : date('d M Y') }}</span>
                                    <span>•</span>
                                    <span>👁️ {{ $article->views }} pembaca</span>
                                </div>
                                <h3 class="font-serif text-xl font-bold text-parchment-100 group-hover:text-gold-300 transition-colors line-clamp-2">{{ $article->judul }}</h3>
                                <p class="text-xs sm:text-sm text-parchment-300 mt-2.5 line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($article->konten), 130) }}</p>
                            </div>
                            <div class="pt-2 border-t border-stage-border/60">
                                <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gold-400 group-hover:text-gold-300 transition-colors">
                                    <span>Baca Selengkapnya</span><span>→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <x-button href="{{ route('artikel.index') }}" variant="outline" size="md">Jelajahi Seluruh Artikel 📜</x-button>
            </div>
        </div>
    </section>
    {{-- H. TESTIMONI (CAROUSEL OTOMATIS) --}}
    <section class="py-24 sm:py-32 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-section-title subtitle="SUARA DARI PANGGUNG" title="Apa Kata Mereka Tentang Kami" description="Kisah transformasi, rasa percaya diri, dan ikatan keluarga di sanggar teater." />

            <div
                x-data="{
                    active: 0,
                    total: {{ $testimonials->count() }},
                    interval: null,
                    next() { this.active = (this.active + 1) % this.total; },
                    prev() { this.active = (this.active - 1 + this.total) % this.total; },
                    init() { this.interval = setInterval(() => this.next(), 6000); }
                }"
                @mouseenter="clearInterval(interval)"
                @mouseleave="interval = setInterval(() => next(), 6000)"
                class="relative bg-stage-card border border-gold-500/30 rounded-3xl p-8 sm:p-12 lg:p-14 shadow-2xl"
            >
                <div class="text-gold-500/20 text-6xl sm:text-7xl font-serif absolute top-6 left-8 pointer-events-none select-none">“</div>
                <div class="relative min-h-[170px] flex items-center justify-center">
                    @foreach($testimonials as $idx => $item)
                        <div
                            x-show="active === {{ $idx }}"
                            x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-3"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="text-center max-w-2xl mx-auto space-y-6"
                        >
                            <p class="font-serif italic text-base sm:text-xl md:text-2xl text-parchment-100 leading-relaxed">&ldquo;{{ $item->isi }}&rdquo;</p>
                            <div class="flex flex-col items-center justify-center pt-2">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gold-500 to-maroon-700 p-0.5 shadow-md mb-2 flex items-center justify-center text-lg">🎭</div>
                                <h4 class="font-serif font-bold text-lg text-gold-400">{{ $item->nama }}</h4>
                                <span class="text-xs text-parchment-300 uppercase tracking-widest mt-0.5">{{ $item->peran ?? 'Anggota Teater' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-stage-border">
                    <button type="button" @click="prev()" class="p-2.5 rounded-full bg-stage-surface hover:bg-gold-500/20 text-parchment-200 hover:text-gold-400 border border-stage-border transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <div class="flex items-center gap-2">
                        @foreach($testimonials as $idx => $item)
                            <button type="button" @click="active = {{ $idx }}" class="h-2 rounded-full transition-all duration-300" :class="active === {{ $idx }} ? 'w-6 bg-gold-400' : 'w-2 bg-stage-border hover:bg-parchment-400'"></button>
                        @endforeach
                    </div>
                    <button type="button" @click="next()" class="p-2.5 rounded-full bg-stage-surface hover:bg-gold-500/20 text-parchment-200 hover:text-gold-400 border border-stage-border transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- I. CTA AKHIR DENGAN MODAL PENDAFTARAN --}}
    <section id="gabung" class="relative py-24 sm:py-32 overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative velvet-curtain rounded-3xl p-8 sm:p-14 lg:p-16 border-2 border-gold-500/50 shadow-2xl text-center overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-3 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600"></div>
                <div class="relative z-10 max-w-3xl mx-auto space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stage-black/60 border border-gold-500/40 text-gold-300 text-xs font-semibold uppercase tracking-widest backdrop-blur-sm">
                        <span>✦</span> Audisi Anggota Baru Terbuka <span>✦</span>
                    </div>
                    <h2 class="font-serif text-3xl sm:text-5xl md:text-6xl font-black text-parchment-100 tracking-tight leading-tight">
                        Jadilah Bagian Dari<br/>
                        <span class="text-gold-gradient gold-glow">Panggung Sandiwara Kami</span>
                    </h2>
                    <p class="text-sm sm:text-base md:text-lg text-parchment-200 leading-relaxed max-w-xl mx-auto opacity-95">
                        Tidak perlu pengalaman sebelumnya. Baik Anda ingin berakting, menulis naskah, merancang riasan, hingga mengarahkan tata lampu panggung — panggung ini menanti karya Anda.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 text-xs text-parchment-300 max-w-xl mx-auto">
                        <div class="p-3 bg-stage-black/50 border border-gold-500/20 rounded-xl"><span class="text-lg block mb-1">🎭</span><span class="font-semibold text-parchment-100">Semua Jenjang</span><p class="text-[11px] text-stage-muted mt-0.5">Siswa Kelas X & XI</p></div>
                        <div class="p-3 bg-stage-black/50 border border-gold-500/20 rounded-xl"><span class="text-lg block mb-1">📜</span><span class="font-semibold text-parchment-100">Bebas Divisi</span><p class="text-[11px] text-stage-muted mt-0.5">Pilih sesuai minat</p></div>
                        <div class="p-3 bg-stage-black/50 border border-gold-500/20 rounded-xl"><span class="text-lg block mb-1">✨</span><span class="font-semibold text-parchment-100">Tanpa Biaya</span><p class="text-[11px] text-stage-muted mt-0.5">100% Gratis & Dibina</p></div>
                    </div>
                    <div class="pt-6 flex justify-center">
                        <button
                            type="button"
                            @click="$dispatch('open-modal', 'daftar-modal')"
                            class="px-8 py-4 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 hover:from-gold-400 hover:to-gold-300 text-stage-black font-extrabold text-sm uppercase tracking-wider rounded-xl shadow-xl hover:shadow-gold-500/40 hover:-translate-y-1 transition-all duration-300 flex items-center gap-2"
                        >
                            <span>Daftar Audisi Sekarang</span>
                            <span>✦</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL PENDAFTARAN --}}
    <x-modal name="daftar-modal" title="Formulir Pendaftaran Audisi Anggota Baru" maxWidth="xl">
        <form
            action="#"
            method="POST"
            @submit.prevent="alert('Terima kasih! Formulir pendaftaran berhasil dikirim. Pengurus akan menghubungi nomor WhatsApp Anda.'); $dispatch('close-modal', 'daftar-modal')"
            class="space-y-4 text-left"
        >
            <p class="text-xs text-parchment-300 leading-relaxed mb-4">
                Lengkapi formulir di bawah ini dengan data diri Anda. Pengurus teater akan mengkonfirmasi jadwal gladi audisi.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-input label="Nama Lengkap" name="nama" required placeholder="Contoh: Arya Baskara" />
                <x-input label="Nomor WhatsApp" name="no_hp" type="tel" required placeholder="08xxxxxxxxxx" />
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-input label="Email" name="email" type="email" required placeholder="nama@email.com" />
                <x-input label="Kelas / Jurusan" name="kelas" required placeholder="Contoh: X IPA 2" />
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Pilihan Divisi</label>
                <select name="divisi" required class="w-full bg-stage-dark border border-stage-border rounded-lg px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500">
                    <option value="akting">Divisi Akting & Karakterisasi</option>
                    <option value="naskah">Divisi Penulisan Naskah</option>
                    <option value="tata_rias">Divisi Tata Rias & Busana</option>
                    <option value="tata_panggung">Divisi Tata Panggung & Cahaya</option>
                    <option value="musik">Divisi Musik & Tata Suara</option>
                    <option value="humas">Divisi Humas & Dokumentasi</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Alasan Bergabung</label>
                <textarea rows="3" name="alasan" required placeholder="Ceritakan ketertarikan Anda..." class="w-full bg-stage-dark border border-stage-border rounded-lg px-4 py-2.5 text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500"></textarea>
            </div>
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-stage-border">
                <button type="button" @click="$dispatch('close-modal', 'daftar-modal')" class="px-4 py-2 text-xs font-semibold text-parchment-300 hover:text-gold-400">Batal</button>
                <x-button type="submit" variant="primary" size="sm">Kirim Pendaftaran 🎭</x-button>
            </div>
        </form>
    </x-modal>

</x-layouts.public>