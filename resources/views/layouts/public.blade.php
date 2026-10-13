<!DOCTYPE html>
<html
    lang="id"
    x-data="{ 
        darkMode: $persist(true).as('teater_dark_mode'),
        scrolled: false,
        mobileOpen: false,
        showScrollTop: false
    }"
    :class="{ 'dark': darkMode }"
    class="scroll-smooth"
    @scroll.window="
        scrolled = (window.pageYOffset > 30);
        showScrollTop = (window.pageYOffset > 400);
    "
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' — Teater Sekolah' : 'Teater Sekolah — Panggung Sandiwara & Eksplorasi Seni' }}</title>
    
    <!-- Meta SEO & Open Graph -->
    <meta name="description" content="{{ $metaDescription ?? 'Website resmi ekstrakurikuler Teater Sekolah. Wadah ekspresi, pementasan drama, seni peran, naskah, dan musikalitas siswa.' }}">
    <meta property="og:title" content="{{ isset($title) ? $title . ' — Teater Sekolah' : 'Teater Sekolah — Panggung Seni & Sandiwara' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Saksikan pementasan, galeri karya, artikel dramaturgi, dan pendaftaran anggota baru Teater Sekolah.' }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-theater.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts & Assets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400;1,700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-stage-black text-parchment-100 dark:bg-stage-black dark:text-parchment-100 min-h-screen flex flex-col selection:bg-gold-500 selection:text-stage-black">

    <!-- Top Theatrical Valence Pelmet (Aksen Tirai Gantung Panggung Atas) -->
    <div class="fixed top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-maroon-800 via-gold-500 to-maroon-800 z-50 shadow-sm"></div>

    <!-- Navigation Header Sticky -->
    <header
        class="fixed top-1.5 left-0 right-0 z-40 transition-all duration-300"
        :class="scrolled 
            ? 'bg-stage-black/95 dark:bg-stage-black/95 bg-parchment-50/95 backdrop-blur-md border-b border-gold-500/20 shadow-2xl py-3' 
            : 'bg-gradient-to-b from-stage-black/90 via-stage-black/60 to-transparent py-5'"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- Logo Topeng Komedi & Tragedi -->
                <a href="{{ route('home') }}" class="group flex items-center gap-3">
                    <div class="relative w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-gradient-to-br from-maroon-900 via-maroon-800 to-stage-black border border-gold-500/40 p-1.5 shadow-gold-glow/40 group-hover:border-gold-400 group-hover:scale-105 transition-all duration-300 flex items-center justify-center">
                        <!-- SVG Topeng Teater Kembar -->
                        <svg class="w-full h-full text-gold-400 transition-transform duration-300 group-hover:rotate-6" viewBox="0 0 24 24" fill="currentColor">
                            <!-- Topeng Kiri (Senyum) -->
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-3 8c.83 0 1.5.67 1.5 1.5S9.83 13 9 13s-1.5-.67-1.5-1.5S8.17 10 9 10zm6 0c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm-3 8c-2.33 0-4.31-1.46-5.11-3.5h10.22c-.8 2.04-2.78 3.5-5.11 3.5z" opacity="0.3"/>
                            <path d="M9 3C5.13 3 2 6.13 2 10c0 4.18 3.32 8.5 7 11 .5.34 1 .34 1.5 0 1.25-.85 2.5-2.07 3.5-3.5-2.5 0-5-2.5-5-6 0-1.66.67-3.18 1.76-4.29C9.94 3.09 9.48 3 9 3zm-1.5 6a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm5.5 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm-2 4.5c1.5 0 2.5 1 2.5 1s-.7 1.5-2.5 1.5-2.5-1.5-2.5-1.5 1-1 2.5-1z"/>
                            <!-- Topeng Kanan (Sedih) ornamen -->
                            <path d="M15 4c3.87 0 7 3.13 7 7 0 4.18-3.32 8.5-7 11-.3-.2-.6-.44-.9-.7 1.18-1.53 1.9-3.4 1.9-5.3 0-4-3-6.5-5-7.5C12.3 5.4 13.5 4 15 4z" fill="#D4AF37"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif font-bold text-lg sm:text-xl tracking-tight text-gold-400 group-hover:text-gold-300 transition-colors">
                            TEATER SIKLUS
                        </span>
                        <span class="text-[10px] tracking-widest uppercase text-parchment-300 dark:text-parchment-300 text-stage-muted">
                            Panggung Seni & Sastra
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <a href="{{ route('home') }}" class="px-3 py-1.5 text-xs xl:text-sm font-medium rounded-md transition-colors {{ request()->routeIs('home') ? 'text-gold-400 bg-gold-500/10 border-b-2 border-gold-400' : 'text-parchment-200 hover:text-gold-300 hover:bg-white/5' }}">
                        Beranda
                    </a>
                    <a href="{{ route('tentang') }}" class="px-3 py-1.5 text-xs xl:text-sm font-medium rounded-md transition-colors {{ request()->routeIs('tentang*') ? 'text-gold-400 bg-gold-500/10 border-b-2 border-gold-400' : 'text-parchment-200 hover:text-gold-300 hover:bg-white/5' }}">
                        Tentang
                    </a>
                    <a href="{{ route('events.index') }}" class="px-3 py-1.5 text-xs xl:text-sm font-medium rounded-md transition-colors {{ request()->routeIs('events*') ? 'text-gold-400 bg-gold-500/10 border-b-2 border-gold-400' : 'text-parchment-200 hover:text-gold-300 hover:bg-white/5' }}">
                        Pementasan
                    </a>
                    <a href="{{ route('galeri.index') }}" class="px-3 py-1.5 text-xs xl:text-sm font-medium rounded-md transition-colors {{ request()->routeIs('galeri*') ? 'text-gold-400 bg-gold-500/10 border-b-2 border-gold-400' : 'text-parchment-200 hover:text-gold-300 hover:bg-white/5' }}">
                        Galeri
                    </a>
                    <a href="{{ route('artikel.index') }}" class="px-3 py-1.5 text-xs xl:text-sm font-medium rounded-md transition-colors {{ request()->routeIs('artikel*') ? 'text-gold-400 bg-gold-500/10 border-b-2 border-gold-400' : 'text-parchment-200 hover:text-gold-300 hover:bg-white/5' }}">
                        Artikel
                    </a>
                    <a href="{{ route('prestasi.index') }}" class="px-3 py-1.5 text-xs xl:text-sm font-medium rounded-md transition-colors {{ request()->routeIs('prestasi*') ? 'text-gold-400 bg-gold-500/10 border-b-2 border-gold-400' : 'text-parchment-200 hover:text-gold-300 hover:bg-white/5' }}">
                        Prestasi
                    </a>
                </nav>

                <!-- Actions: Theme Toggle + CTA Button + Mobile Trigger -->
                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- Theme Toggle Button -->
                    <button
                        type="button"
                        @click="darkMode = !darkMode"
                        class="p-2 text-parchment-300 hover:text-gold-400 rounded-lg hover:bg-white/10 transition-colors"
                        :title="darkMode ? 'Beralih ke mode terang' : 'Beralih ke mode gelap'"
                        aria-label="Toggle tema tampilan"
                    >
                        <!-- Moon icon (when dark) -->
                        <svg x-show="darkMode" class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- Sun icon (when light) -->
                        <svg x-show="!darkMode" x-cloak class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    <!-- CTA Gabung Button (Desktop) -->
                    <a
                        href="{{ route('home') }}#gabung"
                        class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold uppercase tracking-wider bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 hover:from-gold-400 hover:to-gold-300 text-stage-black rounded-lg shadow-md hover:shadow-gold-500/30 transition-all duration-300 hover:-translate-y-0.5"
                    >
                        <span>Gabung</span>
                        <span>✦</span>
                    </a>

                    <!-- Mobile Menu Hamburger Button -->
                    <button
                        type="button"
                        @click="mobileOpen = !mobileOpen"
                        class="lg:hidden p-2 text-parchment-200 hover:text-gold-400 focus:outline-none"
                        aria-label="Buka menu navigasi"
                    >
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Curtain Drawer (Membuka seperti tirai panggung) -->
        <div
            x-show="mobileOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="lg:hidden bg-stage-dark/95 border-b border-gold-500/30 backdrop-blur-xl shadow-2xl py-6 px-6"
            @click.away="mobileOpen = false"
        >
            <nav class="flex flex-col space-y-3">
                <a @click="mobileOpen = false" href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium rounded-lg text-parchment-100 hover:text-gold-400 hover:bg-gold-500/10 flex items-center justify-between">
                    <span>Beranda</span>
                    <span class="text-gold-500/40">✦</span>
                </a>
                <a @click="mobileOpen = false" href="{{ route('tentang') }}" class="px-3 py-2 text-sm font-medium rounded-lg text-parchment-100 hover:text-gold-400 hover:bg-gold-500/10 flex items-center justify-between">
                    <span>Tentang Teater</span>
                    <span class="text-gold-500/40">✦</span>
                </a>
                <a @click="mobileOpen = false" href="{{ route('events.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg text-parchment-100 hover:text-gold-400 hover:bg-gold-500/10 flex items-center justify-between">
                    <span>Pementasan & Tiket</span>
                    <span class="text-gold-500/40">✦</span>
                </a>
                <a @click="mobileOpen = false" href="{{ route('galeri.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg text-parchment-100 hover:text-gold-400 hover:bg-gold-500/10 flex items-center justify-between">
                    <span>Galeri & Dokumentasi</span>
                    <span class="text-gold-500/40">✦</span>
                </a>
                <a @click="mobileOpen = false" href="{{ route('artikel.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg text-parchment-100 hover:text-gold-400 hover:bg-gold-500/10 flex items-center justify-between">
                    <span>Artikel & Wawasan</span>
                    <span class="text-gold-500/40">✦</span>
                </a>
                <a @click="mobileOpen = false" href="{{ route('prestasi.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg text-parchment-100 hover:text-gold-400 hover:bg-gold-500/10 flex items-center justify-between">
                    <span>Prestasi & Rekam Jejak</span>
                    <span class="text-gold-500/40">✦</span>
                </a>

                <div class="pt-4 border-t border-stage-border">
                    <a
                        @click="mobileOpen = false"
                        href="{{ route('home') }}#gabung"
                        class="w-full text-center py-3 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 text-stage-black font-bold rounded-lg shadow-lg uppercase tracking-wider text-xs flex items-center justify-center gap-2"
                    >
                        <span>Daftar Audisi Anggota Baru</span>
                        <span>🎭</span>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow pt-20">
        {{ $slot }}
    </main>

    <!-- Theatrical Footer -->
    <footer class="relative bg-stage-dark border-t border-gold-500/20 text-parchment-300 overflow-hidden">
        <!-- Background subtle velvet glow -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-3/4 h-32 bg-maroon-900/30 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
                
                <!-- Col 1: About Teater -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">🎭</span>
                        <h3 class="font-serif text-xl font-bold text-gold-400 tracking-wide">
                            TEATER SIKLUS
                        </h3>
                    </div>
                    <p class="text-sm text-parchment-300 leading-relaxed">
                        Wadah eksplorasi seni peran, penulisan lakon naskah, tata panggung, dan musik bagi generasi muda yang berani berekspresi di panggung peradaban.
                    </p>
                    <div class="pt-2 text-xs text-parchment-400 flex items-center gap-2">
                        <span class="text-gold-400">📍</span>
                        <span>SMA Negeri 1 • Ruang Sanggar Seni & Aula Utama</span>
                    </div>
                </div>

                <!-- Col 2: Jam Latihan & Agenda -->
                <div class="space-y-4">
                    <h4 class="font-serif text-base font-bold text-parchment-100 flex items-center gap-2">
                        <span class="text-gold-400">✦</span> Jadwal Latihan Rutin
                    </h4>
                    <ul class="space-y-2.5 text-sm text-parchment-300">
                        <li class="flex items-start justify-between border-b border-stage-border/60 pb-2">
                            <span>Rabu (Olah Tubuh & Vokal)</span>
                            <span class="text-gold-400 font-medium">15.30 - 17.30</span>
                        </li>
                        <li class="flex items-start justify-between border-b border-stage-border/60 pb-2">
                            <span>Sabtu (Bedah Naskah & Gladi)</span>
                            <span class="text-gold-400 font-medium">09.00 - 12.30</span>
                        </li>
                        <li class="flex items-start justify-between">
                            <span>Minggu (Khusus Musim Pentas)</span>
                            <span class="text-maroon-400 font-medium">Kondisional</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Navigasi Cepat & Sosial Media -->
                <div class="space-y-4">
                    <h4 class="font-serif text-base font-bold text-parchment-100 flex items-center gap-2">
                        <span class="text-gold-400">✦</span> Panggung Digital
                    </h4>
                    <div class="flex flex-wrap gap-2 text-sm">
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-stage-surface hover:bg-gold-500/10 border border-stage-border hover:border-gold-500/40 text-xs text-parchment-200 hover:text-gold-400 transition-colors flex items-center gap-1.5">
                            <span>📷</span> Instagram
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-stage-surface hover:bg-gold-500/10 border border-stage-border hover:border-gold-500/40 text-xs text-parchment-200 hover:text-gold-400 transition-colors flex items-center gap-1.5">
                            <span>🎬</span> YouTube
                        </a>
                        <a href="https://tiktok.com" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-stage-surface hover:bg-gold-500/10 border border-stage-border hover:border-gold-500/40 text-xs text-parchment-200 hover:text-gold-400 transition-colors flex items-center gap-1.5">
                            <span>🎵</span> TikTok
                        </a>
                        <a href="https://spotify.com" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-lg bg-stage-surface hover:bg-gold-500/10 border border-stage-border hover:border-gold-500/40 text-xs text-parchment-200 hover:text-gold-400 transition-colors flex items-center gap-1.5">
                            <span>🎙️</span> Podcast
                        </a>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('admin.login') }}" class="text-xs text-stage-muted hover:text-gold-400/80 transition-colors inline-flex items-center gap-1">
                            <span>🔒</span> Akses Backstage Admin
                        </a>
                    </div>
                </div>

                <!-- Col 4: Newsletter Subscription (Livewire) -->
                <div class="space-y-4">
                    <h4 class="font-serif text-base font-bold text-parchment-100 flex items-center gap-2">
                        <span class="text-gold-400">✦</span> Warta Teater
                    </h4>
                    <p class="text-xs text-parchment-300 leading-relaxed">
                        Dapatkan jadwal pementasan perdana, tiket gratis, dan rangkuman naskah terbaru langsung di email Anda.
                    </p>
                    
                    <livewire:newsletter-form />
                </div>
            </div>

            <!-- Bottom Copyright & Flourish -->
            <div class="mt-12 pt-8 border-t border-stage-border/60 flex flex-col sm:flex-row items-center justify-between text-xs text-stage-muted gap-4">
                <p>&copy; {{ date('Y') }} Sanggar Teater Sekolah. Semua hak cipta dilindungi.</p>
                <div class="flex items-center gap-2 text-gold-400/70">
                    <span>✦</span>
                    <span class="italic font-serif">"Hidup adalah panggung sandiwara, mainkan peranmu dengan sepenuh jiwa."</span>
                    <span>✦</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button
        type="button"
        x-show="showScrollTop"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-6"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-6"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-40 p-3 bg-gradient-to-br from-gold-500 to-gold-600 text-stage-black rounded-full shadow-gold-glow hover:scale-110 active:scale-95 transition-all duration-300 group"
        aria-label="Kembali ke atas"
    >
        <svg class="w-5 h-5 transition-transform group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    @livewireScripts
</body>
</html>