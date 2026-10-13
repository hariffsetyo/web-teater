<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ 
          darkMode: $persist(true), 
          sidebarOpen: false, 
          sidebarCollapsed: $persist(false) 
      }"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' — ' : '' }}Admin Panel | Teater Siklus</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;900&family=Playfair+Display:ital,wght@0,500;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="min-h-screen bg-stage-black text-parchment-100 font-sans antialiased selection:bg-gold-500 selection:text-stage-black overflow-x-hidden">
    <div class="flex h-screen overflow-hidden bg-stage-black">

        <!-- Mobile Sidebar Backdrop -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-stage-black/80 backdrop-blur-sm lg:hidden"
            x-cloak
        ></div>

        <!-- Sidebar -->
        <aside 
            :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full lg:translate-x-0': !sidebarOpen,
                'lg:w-64': !sidebarCollapsed,
                'lg:w-20': sidebarCollapsed
            }"
            class="fixed inset-y-0 left-0 z-50 flex flex-col bg-stage-card border-r border-stage-border transition-all duration-300 ease-in-out lg:static lg:flex-shrink-0"
            x-cloak
        >
            <!-- Brand / Logo -->
            <div class="h-16 flex items-center justify-between px-4 border-b border-stage-border">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 overflow-hidden">
                    <span class="w-10 h-10 rounded-xl bg-curtain-800/80 border border-gold-500/30 flex items-center justify-center text-xl shadow-lg shadow-curtain-950/60 flex-shrink-0">
                        🎭
                    </span>
                    <div x-show="!sidebarCollapsed" class="transition-opacity duration-200">
                        <div class="font-serif font-bold text-sm tracking-wide text-gold-400">TEATER SIKLUS</div>
                        <div class="text-[10px] text-parchment-400 uppercase tracking-widest">Admin Panggung</div>
                    </div>
                </a>

                <!-- Desktop Sidebar Collapse Toggle Button -->
                <button 
                    @click="sidebarCollapsed = !sidebarCollapsed" 
                    type="button"
                    class="hidden lg:flex p-1.5 rounded-lg text-parchment-400 hover:text-gold-400 hover:bg-stage-surface transition"
                    title="Toggle Sidebar"
                >
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': sidebarCollapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Mobile Close Button -->
                <button 
                    @click="sidebarOpen = false" 
                    type="button"
                    class="lg:hidden p-1.5 rounded-lg text-parchment-400 hover:text-white"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-3 py-4 space-y-6 overflow-y-auto custom-scrollbar text-xs">
                
                <!-- Group: Ringkasan -->
                <div class="space-y-1">
                    <div x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold uppercase tracking-wider text-parchment-500">
                        Ringkasan
                    </div>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">📊</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Dashboard</span>
                    </a>
                </div>

                <!-- Group: Konten -->
                <div class="space-y-1">
                    <div x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold uppercase tracking-wider text-parchment-500">
                        Konten Teater
                    </div>
                    
                    <a href="{{ route('admin.artikel.index') }}" 
                       class="flex items-center justify-between px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.artikel.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="text-base flex-shrink-0">📝</span>
                            <span x-show="!sidebarCollapsed" class="truncate">Artikel</span>
                        </div>
                        @if(isset($pendingCommentCount) && $pendingCommentCount > 0)
                            <span x-show="!sidebarCollapsed" class="px-1.5 py-0.5 text-[10px] font-bold rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40" title="{{ $pendingCommentCount }} komentar pending">
                                {{ $pendingCommentCount }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.galeri.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.galeri.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">🖼️</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Galeri</span>
                    </a>

                    <a href="{{ route('admin.podcast.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.podcast.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">🎙️</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Podcast</span>
                    </a>
                </div>

                <!-- Group: Keanggotaan -->
                <div class="space-y-1">
                    <div x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold uppercase tracking-wider text-parchment-500">
                        Keanggotaan
                    </div>

                    <a href="{{ route('admin.anggota.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.anggota.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">👥</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Daftar Anggota</span>
                    </a>

                    <a href="{{ route('admin.pendaftaran.index') }}" 
                       class="flex items-center justify-between px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.pendaftaran.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="text-base flex-shrink-0">📋</span>
                            <span x-show="!sidebarCollapsed" class="truncate">Pendaftaran</span>
                        </div>
                        @if(isset($pendingRegCount) && $pendingRegCount > 0)
                            <span x-show="!sidebarCollapsed" class="px-1.5 py-0.5 text-[10px] font-bold rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/40 animate-pulse" title="{{ $pendingRegCount }} pendaftar pending">
                                {{ $pendingRegCount }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.absensi.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.absensi.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">⏱️</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Presensi Latihan</span>
                    </a>
                </div>

                <!-- Group: Pementasan & Prestasi -->
                <div class="space-y-1">
                    <div x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold uppercase tracking-wider text-parchment-500">
                        Pementasan
                    </div>

                    <a href="{{ route('admin.event.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.event.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">📅</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Agenda Event</span>
                    </a>

                    <a href="{{ route('admin.pentas.index') }}" 
                       class="flex items-center justify-between px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.pentas.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="text-base flex-shrink-0">🎟️</span>
                            <span x-show="!sidebarCollapsed" class="truncate">Lakon & Tiket</span>
                        </div>
                        @if(isset($pendingTicketCount) && $pendingTicketCount > 0)
                            <span x-show="!sidebarCollapsed" class="px-1.5 py-0.5 text-[10px] font-bold rounded-full bg-gold-500/20 text-gold-300 border border-gold-500/40" title="{{ $pendingTicketCount }} tiket pending">
                                {{ $pendingTicketCount }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.prestasi.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.prestasi.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">🏆</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Prestasi</span>
                    </a>

                    <a href="{{ route('admin.testimonial.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.testimonial.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">💬</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Testimonial</span>
                    </a>
                </div>

                <!-- Group: Operasional -->
                <div class="space-y-1">
                    <div x-show="!sidebarCollapsed" class="px-3 text-[10px] font-bold uppercase tracking-wider text-parchment-500">
                        Operasional
                    </div>

                    <a href="{{ route('admin.inventaris.index') }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('admin.inventaris.*') ? 'bg-gold-500/15 text-gold-400 border border-gold-500/30 font-semibold' : 'text-parchment-300 hover:bg-stage-surface hover:text-parchment-100' }}">
                        <span class="text-base flex-shrink-0">📦</span>
                        <span x-show="!sidebarCollapsed" class="truncate">Inventaris Properti</span>
                    </a>
                </div>

            </nav>

            <!-- Bottom: Admin User & Logout -->
            <div class="p-3 border-t border-stage-border bg-stage-dark/50">
                <div class="flex items-center gap-3 p-2 rounded-xl bg-stage-surface/60 border border-stage-border">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gold-500 to-amber-700 flex items-center justify-center font-bold text-xs text-stage-black flex-shrink-0 shadow">
                        {{ substr(auth('admin')->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div x-show="!sidebarCollapsed" class="flex-1 min-w-0">
                        <div class="text-xs font-semibold text-parchment-100 truncate">{{ auth('admin')->user()->name ?? 'Administrator' }}</div>
                        <div class="text-[10px] text-parchment-400 truncate">{{ auth('admin')->user()->email ?? 'admin@teater.sch.id' }}</div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}" class="flex-shrink-0" x-show="!sidebarCollapsed">
                        @csrf
                        <button type="submit" title="Keluar dari Admin" class="p-1.5 rounded-lg text-rose-400 hover:text-rose-300 hover:bg-rose-950/40 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            
            <!-- Topbar -->
            <header class="h-16 px-4 sm:px-6 bg-stage-card/80 backdrop-blur-md border-b border-stage-border flex items-center justify-between z-30">
                <!-- Left: Hamburger (mobile) + Page Title -->
                <div class="flex items-center gap-3">
                    <button 
                        @click="sidebarOpen = true" 
                        type="button"
                        class="lg:hidden p-2 rounded-xl bg-stage-surface border border-stage-border text-parchment-300 hover:text-gold-400"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div>
                        <h1 class="font-serif text-base sm:text-lg font-bold text-parchment-100 flex items-center gap-2">
                            {{ $title ?? 'Dashboard' }}
                        </h1>
                        <p class="hidden sm:block text-[11px] text-parchment-400">
                            {{ now()->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>
                </div>

                <!-- Right: Quick actions, notifications, theme toggle, link to public -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Link to Public Website -->
                    <a href="{{ route('home') }}" target="_blank" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-stage-surface border border-stage-border text-xs text-parchment-300 hover:text-gold-400 hover:border-gold-500/40 transition">
                        <span>Lihat Website</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>

                    <!-- Notification Dropdown / Quick Links -->
                    <div x-data="{ open: false }" class="relative">
                        <button 
                            @click="open = !open" 
                            type="button"
                            class="relative p-2 rounded-xl bg-stage-surface border border-stage-border text-parchment-300 hover:text-gold-400 transition"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            @php 
                                $totalPending = ($pendingRegCount ?? 0) + ($pendingCommentCount ?? 0) + ($pendingTicketCount ?? 0); 
                            @endphp
                            @if($totalPending > 0)
                                <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-600 text-white text-[9px] font-bold flex items-center justify-center animate-pulse">
                                    {{ $totalPending }}
                                </span>
                            @endif
                        </button>

                        <div 
                            x-show="open" 
                            @click.away="open = false" 
                            x-transition
                            class="absolute right-0 mt-2 w-72 bg-stage-card border border-stage-border rounded-2xl p-3 shadow-2xl z-50 text-xs space-y-2"
                            x-cloak
                        >
                            <div class="font-bold text-parchment-100 border-b border-stage-border pb-2 flex items-center justify-between">
                                <span>Pemberitahuan Pending</span>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-gold-500/20 text-gold-400">{{ $totalPending }} Item</span>
                            </div>

                            <div class="space-y-1.5">
                                <a href="{{ route('admin.pendaftaran.index') }}" class="flex items-center justify-between p-2 rounded-xl hover:bg-stage-surface transition">
                                    <span class="text-parchment-300">📋 Pendaftar Audisi</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-500/20 text-rose-300">{{ $pendingRegCount ?? 0 }}</span>
                                </a>
                                <a href="{{ route('admin.artikel.index') }}" class="flex items-center justify-between p-2 rounded-xl hover:bg-stage-surface transition">
                                    <span class="text-parchment-300">💬 Komentar Artikel</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-500/20 text-amber-300">{{ $pendingCommentCount ?? 0 }}</span>
                                </a>
                                <a href="{{ route('admin.pentas.index') }}" class="flex items-center justify-between p-2 rounded-xl hover:bg-stage-surface transition">
                                    <span class="text-parchment-300">🎟️ Reservasi Tiket</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-gold-500/20 text-gold-300">{{ $pendingTicketCount ?? 0 }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Theme Toggle -->
                    <button 
                        @click="darkMode = !darkMode" 
                        type="button"
                        class="p-2 rounded-xl bg-stage-surface border border-stage-border text-parchment-300 hover:text-gold-400 transition"
                        title="Ganti Tema Gelap / Terang"
                    >
                        <span x-show="darkMode">🌙</span>
                        <span x-show="!darkMode">☀️</span>
                    </button>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-stage-dark/50 custom-scrollbar">
                @if(isset($slot) && $slot->isNotEmpty())
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>

    <!-- Reusable Flash Toast & Modals -->
    <x-admin.flash-toast />
    <x-admin.confirm-delete />

    @livewireScripts
    @stack('scripts')
</body>
</html>
