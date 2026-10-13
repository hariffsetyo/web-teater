<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . " — " : "" }}{{ config("app.name", "Teater Sekolah") }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,700,900|inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(["resources/css/app.css", "resources/js/app.js"])
    @livewireStyles
    @stack("styles")
</head>
<body class="min-h-screen bg-gray-950 text-gray-100 antialiased">
    <nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-black/80 backdrop-blur-md border-b border-red-900/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route("home") }}" class="flex items-center gap-3 group">
                    <span class="text-2xl">🎭</span>
                    <div class="leading-tight">
                        <div class="font-bold text-lg text-amber-400 group-hover:text-amber-300 transition">Teater Sekolah</div>
                        <div class="text-xs text-gray-400 tracking-widest uppercase">Panggung &amp; Tirai</div>
                    </div>
                </a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route("home") }}" class="text-sm text-gray-300 hover:text-amber-400 transition {{ request()->routeIs("home") ? "text-amber-400 font-semibold" : "" }}">Beranda</a>
                    <a href="{{ route("anggota.index") }}" class="text-sm text-gray-300 hover:text-amber-400 transition {{ request()->routeIs("anggota.*") ? "text-amber-400 font-semibold" : "" }}">Anggota</a>
                    <a href="{{ route("artikel.index") }}" class="text-sm text-gray-300 hover:text-amber-400 transition {{ request()->routeIs("artikel.*") ? "text-amber-400 font-semibold" : "" }}">Artikel</a>
                    <a href="{{ route("galeri.index") }}" class="text-sm text-gray-300 hover:text-amber-400 transition {{ request()->routeIs("galeri.*") ? "text-amber-400 font-semibold" : "" }}">Galeri</a>
                    <a href="{{ route("pentas.index") }}" class="text-sm text-gray-300 hover:text-amber-400 transition {{ request()->routeIs("pentas.*") ? "text-amber-400 font-semibold" : "" }}">Pentas</a>
                </div>
                <button @click="open = !open" class="md:hidden text-gray-400 hover:text-white">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
        <div x-show="open" x-transition class="md:hidden border-t border-red-900/30 bg-black/95 px-4 pb-4 pt-2 space-y-2">
            <a href="{{ route("home") }}" class="block text-sm text-gray-300 hover:text-amber-400 py-2">Beranda</a>
            <a href="{{ route("anggota.index") }}" class="block text-sm text-gray-300 hover:text-amber-400 py-2">Anggota</a>
            <a href="{{ route("artikel.index") }}" class="block text-sm text-gray-300 hover:text-amber-400 py-2">Artikel</a>
            <a href="{{ route("galeri.index") }}" class="block text-sm text-gray-300 hover:text-amber-400 py-2">Galeri</a>
            <a href="{{ route("pentas.index") }}" class="block text-sm text-gray-300 hover:text-amber-400 py-2">Pentas</a>
        </div>
    </nav>
    <div class="h-16"></div>
    <main>
        @if(isset($header))
        <div class="relative bg-gradient-to-b from-red-950/50 to-gray-950 border-b border-red-900/20 py-12">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-0 left-0 w-24 h-full bg-gradient-to-r from-red-900/40 to-transparent"></div>
                <div class="absolute top-0 right-0 w-24 h-full bg-gradient-to-l from-red-900/40 to-transparent"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">{{ $header }}</div>
        </div>
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">{{ $slot }}</div>
    </main>
    <footer class="mt-16 bg-black border-t border-red-900/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">🎭</span>
                    <div>
                        <div class="font-bold text-amber-400">Teater Sekolah</div>
                        <div class="text-xs text-gray-500">Panggung &amp; Tirai</div>
                    </div>
                </div>
                <p class="text-xs text-gray-600">&copy; {{ date("Y") }} Ekstrakurikuler Teater Sekolah.</p>
            </div>
        </div>
    </footer>
    @livewireScripts
    @stack("scripts")
</body>
</html>
