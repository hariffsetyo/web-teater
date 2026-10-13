<x-layouts.public :title="$article->judul . ' — Teater Siklus'">
    
    <!-- Reading Progress Bar (Fixed Top) -->
    <div
        x-data="{ progress: 0 }"
        @scroll.window="
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            progress = (winScroll / height) * 100;
        "
        class="fixed top-0 left-0 right-0 h-1.5 z-50 bg-stage-dark/50"
    >
        <div class="h-full bg-gradient-to-r from-maroon-600 via-gold-500 to-gold-400 transition-all duration-75" :style="`width: ${progress}%`"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Breadcrumb -->
        <x-breadcrumb :items="[
            ['label' => 'Artikel', 'url' => route('artikel.index')],
            ['label' => Str::limit($article->judul, 40), 'url' => null]
        ]" />

        <!-- Article Header -->
        <header class="space-y-5 mb-10 text-center sm:text-left">
            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5">
                <x-badge variant="gold">{{ $article->kategori ?? 'Dramaturgi' }}</x-badge>
                <span class="text-xs text-parchment-300">⏱️ {{ $readingTime }} menit membaca</span>
                <span class="text-xs text-stage-muted">•</span>
                <span class="text-xs text-parchment-300">👁️ {{ $article->views }} kali dibaca</span>
            </div>

            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-extrabold text-parchment-100 tracking-tight leading-[1.2]">
                {{ $article->judul }}
            </h1>

            <div class="flex items-center justify-center sm:justify-start gap-3 pt-2 text-xs text-parchment-300 border-b border-stage-border pb-6">
                <span>Ditulis oleh: <strong class="text-gold-400">Redaksi Panggung Siklus</strong></span>
                <span>•</span>
                <span>Diterbitkan: <strong>{{ $article->published_at ? $article->published_at->translatedFormat('l, d F Y') : date('d F Y') }}</strong></span>
            </div>
        </header>

        <!-- Featured Thumbnail Image -->
        <div class="rounded-3xl overflow-hidden bg-stage-surface border border-gold-500/20 mb-12 shadow-2xl relative">
            <img
                src="https://images.unsplash.com/photo-1460723237483-7a6dc9d0b212?auto=format&fit=crop&w=1200&q=80"
                alt="{{ $article->judul }}"
                class="w-full h-72 sm:h-96 object-cover"
            />
        </div>

        <!-- Article Prose Content -->
        <article class="prose prose-invert prose-gold max-w-none text-parchment-200 text-base sm:text-lg leading-relaxed space-y-6 font-sans">
            {!! nl2br(e($article->konten)) !!}
        </article>

        <!-- Social Share Bar & Salin Tautan (Alpine.js) -->
        <div
            x-data="{ copied: false }"
            class="my-12 p-6 rounded-2xl bg-stage-card border border-stage-border flex flex-col sm:flex-row items-center justify-between gap-4"
        >
            <div class="flex items-center gap-2 text-xs uppercase tracking-wider text-gold-400 font-semibold">
                <span>📢</span> Bagikan tulisan ini ke rekan pemeran:
            </div>

            <div class="flex items-center gap-2.5">
                <!-- WhatsApp -->
                <a
                    href="https://api.whatsapp.com/send?text={{ urlencode($article->judul . ' ' . request()->url()) }}"
                    target="_blank"
                    rel="noopener"
                    class="p-2.5 rounded-xl bg-stage-dark border border-stage-border hover:border-emerald-500 hover:text-emerald-400 text-parchment-200 text-xs transition-colors flex items-center gap-1.5"
                    title="Bagikan ke WhatsApp"
                >
                    <span>💬 WhatsApp</span>
                </a>

                <!-- Twitter / X -->
                <a
                    href="https://twitter.com/intent/tweet?text={{ urlencode($article->judul) }}&url={{ urlencode(request()->url()) }}"
                    target="_blank"
                    rel="noopener"
                    class="p-2.5 rounded-xl bg-stage-dark border border-stage-border hover:border-sky-500 hover:text-sky-400 text-parchment-200 text-xs transition-colors flex items-center gap-1.5"
                    title="Bagikan ke Twitter / X"
                >
                    <span>🐦 Twitter/X</span>
                </a>

                <!-- Salin Link -->
                <button
                    type="button"
                    @click="
                        navigator.clipboard.writeText(window.location.href);
                        copied = true;
                        setTimeout(() => copied = false, 2500);
                    "
                    class="p-2.5 rounded-xl bg-stage-dark border border-gold-500/30 hover:border-gold-400 text-gold-400 text-xs transition-colors flex items-center gap-1.5 font-medium"
                >
                    <span x-text="copied ? 'Tautan Disalin! ✓' : '🔗 Salin Tautan'">🔗 Salin Tautan</span>
                </button>
            </div>
        </div>

        <!-- Artikel Terkait -->
        @if($relatedArticles->isNotEmpty())
            <div class="my-16 pt-10 border-t border-stage-border">
                <h3 class="font-serif text-2xl font-bold text-parchment-100 mb-6 flex items-center gap-2">
                    <span class="text-gold-400">✦</span> Bacaan Naskah Terkait
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $rel)
                        <div class="card-theater p-5 rounded-xl flex flex-col justify-between group">
                            <div>
                                <span class="text-[10px] text-gold-400 uppercase font-semibold">{{ $rel->kategori ?? 'Catatan' }}</span>
                                <h4 class="font-serif text-base font-bold text-parchment-100 group-hover:text-gold-300 transition-colors line-clamp-2 mt-1">
                                    <a href="{{ route('artikel.show', $rel->slug) }}">{{ $rel->judul }}</a>
                                </h4>
                            </div>
                            <a href="{{ route('artikel.show', $rel->slug) }}" class="text-xs text-gold-400 font-medium mt-3 inline-block">Baca →</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Komentar Interaktif (Livewire) -->
        <div class="pt-8 border-t border-stage-border">
            <livewire:article-comments :article-id="$article->id" />
        </div>

    </div>

</x-layouts.public>