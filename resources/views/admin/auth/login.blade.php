<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin — {{ config('app.name') }}</title>
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,700,900|inter:400,500,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .curtain-left  { background: linear-gradient(to right, #6b0f1a, transparent); }
        .curtain-right { background: linear-gradient(to left,  #6b0f1a, transparent); }
        .gold-glow     { text-shadow: 0 0 20px rgba(251,191,36,0.4); }
        .input-admin:focus { box-shadow: 0 0 0 2px rgba(251,191,36,0.5); }
    </style>
</head>
<body class="h-full bg-gray-950 font-[Inter] antialiased">

    {{-- Background dengan efek curtain --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        {{-- Curtain kiri --}}
        <div class="curtain-left absolute top-0 left-0 w-48 h-full opacity-70"></div>
        {{-- Curtain kanan --}}
        <div class="curtain-right absolute top-0 right-0 w-48 h-full opacity-70"></div>
        {{-- Top drape --}}
        <div class="absolute top-0 left-0 right-0 h-20 bg-gradient-to-b from-red-950 to-transparent opacity-80"></div>
        {{-- Noise/texture overlay --}}
        <div class="absolute inset-0 opacity-5" style="background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%224%22 height=%224%22><rect width=%224%22 height=%224%22 fill=%22none%22/><path d=%22M0 0h1v1H0V0zm2 2h1v1H2V2z%22 fill=%22%23fff%22/></svg>')"></div>
    </div>

    {{-- Decorative top swag --}}
    <div class="relative z-10 flex justify-center pt-6 pointer-events-none select-none">
        <div class="flex items-center gap-1">
            @foreach(range(1,9) as $i)
            <div class="w-3 h-3 rounded-full"
                 style="background:{{ $i==5?'#f59e0b':'#7f1d1d' }};
                        margin-top:{{ abs($i-5)*6 }}px;
                        opacity:{{ $i==5?'1':'0.7' }}">
            </div>
            @endforeach
        </div>
    </div>

    {{-- Main content --}}
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">

            {{-- Logo & Header --}}
            <div class="text-center mb-8">
                <div class="text-6xl mb-4 filter drop-shadow-lg">🎭</div>
                <h1 class="font-playfair font-black text-3xl text-amber-400 gold-glow mb-1">
                    Teater Sekolah
                </h1>
                <p class="text-red-400/70 text-sm tracking-widest uppercase">
                    ✦ Admin Panel ✦
                </p>
                <div class="w-24 h-px bg-gradient-to-r from-transparent via-amber-400/50 to-transparent mx-auto mt-3"></div>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="mb-4 p-3 bg-green-900/40 border border-green-700/50 rounded-lg text-green-400 text-sm text-center">
                {{ session('success') }}
            </div>
            @endif

            {{-- Login Card --}}
            <div class="bg-gray-900/80 backdrop-blur border border-red-900/40 rounded-2xl shadow-2xl shadow-black/50 p-8">

                <h2 class="font-playfair text-xl text-white font-bold mb-6 text-center">
                    Masuk ke Backstage
                </h2>

                <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                            Email Admin
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="admin@teater.sch.id"
                            class="input-admin w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-amber-500 transition-colors @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">
                            Password
                        </label>
                        <div class="relative" x-data="{ show: false }">
                            <input
                                :type="show ? 'text' : 'password'"
                                id="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="input-admin w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 pr-12 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-amber-500 transition-colors @error('password') border-red-500 @enderror"
                            >
                            <button type="button" @click="show = !show"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-amber-400 transition">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" name="remember"
                               class="w-4 h-4 rounded border-gray-600 bg-gray-800 text-amber-500 focus:ring-amber-500 focus:ring-offset-gray-900">
                        <label for="remember" class="text-xs text-gray-400">Ingat sesi login</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-black font-bold py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-amber-500/25 text-sm tracking-wide uppercase">
                        Masuk ke Backstage
                    </button>
                </form>

                {{-- Divider --}}
                <div class="mt-6 flex items-center gap-3">
                    <div class="flex-1 h-px bg-gray-800"></div>
                    <span class="text-gray-700 text-xs">✦</span>
                    <div class="flex-1 h-px bg-gray-800"></div>
                </div>

                <p class="mt-4 text-center text-xs text-gray-600">
                    Hanya admin yang berwenang dapat mengakses panel ini.
                </p>
            </div>

            {{-- Footer --}}
            <p class="mt-6 text-center text-xs text-gray-700">
                &copy; {{ date('Y') }} Ekstrakurikuler Teater Sekolah
            </p>
        </div>
    </div>

</body>
</html>