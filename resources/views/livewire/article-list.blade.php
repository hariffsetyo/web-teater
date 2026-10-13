<div>
    <!-- Featured Article Highlight Banner (Jika sedang tidak melakukan search) -->
    @if($featuredArticle && empty($search) && empty($selectedCategory))
        <div class="mb-14 card-theater overflow-hidden p-6 sm:p-10 border-gold-500/40 relative">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Thumbnail -->
                <div class="lg:col-span-5 h-64 sm:h-72 rounded-2xl overflow-hidden bg-stage-surface relative">
                    <img
                        src="https://images.unsplash.com/photo-1460723237483-7a6dc9d0b212?auto=format&fit=crop&w=800&q=80"
                        alt="{{ $featuredArticle->judul }}"
                        class="w-full h-full object-cover"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-stage-card via-transparent to-transparent"></div>
                    <div class="absolute top-3 left-3">
                        <x-badge variant="gold">★ ARTIKEL UNGGULAN</x-badge>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="flex items-center gap-3 text-xs text-parchment-300">
                        <span>📅 {{ $featuredArticle->published_at ? $featuredArticle->published_at->format('d F Y') : date('d F Y') }}</span>
                        <span>•</span>
                        <span>👁️ {{ $featuredArticle->views }} pembaca</span>
                        <span>•</span>
                        <x-badge variant="maroon" size="sm">{{ $featuredArticle->kategori ?? 'Dramaturgi' }}</x-badge>
                    </div>

                    <h2 class="font-serif text-2xl sm:text-4xl font-bold text-parchment-100 hover:text-gold-300 transition-colors">
                        <a href="{{ route('artikel.show', $featuredArticle->slug) }}">
                            {{ $featuredArticle->judul }}
                        </a>
                    </h2>

                    <p class="text-sm text-parchment-300 leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($featuredArticle->konten), 220) }}
                    </p>

                    <div class="pt-2">
                        <x-button href="{{ route('artikel.show', $featuredArticle->slug) }}" variant="primary" size="sm">
                            Baca Ulasan Lengkap →
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Filter & Search Toolbar -->
    <div class="bg-stage-card border border-stage-border rounded-2xl p-5 mb-8 flex flex-col sm:flex-row gap-4 justify-between items-center">
        <!-- Live Search -->
        <div class="relative w-full sm:w-80">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari judul atau isi artikel..."
                class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 pl-10 text-xs sm:text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500 focus:ring-1 focus:ring-gold-500"
            />
            <span class="absolute left-3.5 top-3 text-stage-muted text-xs sm:text-sm">🔍</span>
            @if(!empty($search))
                <button wire:click="$set('search', '')" class="absolute right-3 top-2.5 text-xs text-parchment-300 hover:text-gold-400">✕</button>
            @endif
        </div>

        <!-- Category Pills -->
        <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0 scrollbar-none">
            <button
                type="button"
                wire:click="$set('selectedCategory', '')"
                class="px-3.5 py-1.5 rounded-full text-xs font-medium whitespace-nowrap transition-all {{ $selectedCategory === '' ? 'bg-gold-500 text-stage-black shadow-md' : 'bg-stage-dark text-parchment-300 border border-stage-border hover:border-gold-500/40' }}"
            >
                Semua Kategori
            </button>
            @foreach($categories as $cat)
                <button
                    type="button"
                    wire:click="$set('selectedCategory', '{{ $cat }}')"
                    class="px-3.5 py-1.5 rounded-full text-xs font-medium whitespace-nowrap transition-all {{ $selectedCategory === $cat ? 'bg-gold-500 text-stage-black shadow-md' : 'bg-stage-dark text-parchment-300 border border-stage-border hover:border-gold-500/40' }}"
                >
                    {{ ucfirst($cat) }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Livewire Loading State Skeleton -->
    <div wire:loading wire:target="search, selectedCategory" class="w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @for($i=0; $i<6; $i++)
                <div class="bg-stage-card border border-stage-border rounded-2xl p-5 space-y-4">
                    <x-skeleton height="h-44" rounded="rounded-xl" />
                    <x-skeleton width="w-1/3" height="h-3" />
                    <x-skeleton width="w-3/4" height="h-5" />
                    <x-skeleton width="w-full" height="h-10" />
                </div>
            @endfor
        </div>
    </div>

    <!-- Articles Grid -->
    <div wire:loading.remove wire:target="search, selectedCategory">
        @if($articles->isEmpty())
            <x-empty-state
                title="Artikel Tidak Ditemukan"
                message="Tidak ada catatan naskah atau artikel yang sesuai dengan kata kunci pencarian Anda."
                icon="📜"
                actionText="Reset Pencarian"
                actionClick="$set('search', ''); $set('selectedCategory', '');"
            />
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($articles as $art)
                    @php
                        $estTime = max(1, ceil(str_word_count(strip_tags($art->konten)) / 180));
                    @endphp
                    <article class="card-theater overflow-hidden flex flex-col justify-between group">
                        
                        <div>
                            <!-- Thumbnail -->
                            <div class="relative h-48 w-full overflow-hidden bg-stage-surface">
                                <img
                                    src="https://images.unsplash.com/photo-1460723237483-7a6dc9d0b212?auto=format&fit=crop&w=600&q=80"
                                    alt="{{ $art->judul }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-stage-card via-transparent to-transparent"></div>
                                <div class="absolute top-3 left-3">
                                    <x-badge variant="gold" size="sm">{{ $art->kategori ?? 'Wawasan' }}</x-badge>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-3">
                                <div class="flex items-center gap-3 text-xs text-stage-muted">
                                    <span>📅 {{ $art->published_at ? $art->published_at->format('d M Y') : date('d M Y') }}</span>
                                    <span>•</span>
                                    <span>⏱️ {{ $estTime }} mnt baca</span>
                                </div>

                                <h3 class="font-serif text-xl font-bold text-parchment-100 group-hover:text-gold-300 transition-colors line-clamp-2">
                                    <a href="{{ route('artikel.show', $art->slug) }}">
                                        {{ $art->judul }}
                                    </a>
                                </h3>

                                <p class="text-xs sm:text-sm text-parchment-300 line-clamp-3 leading-relaxed">
                                    {{ Str::limit(strip_tags($art->konten), 120) }}
                                </p>
                            </div>
                        </div>

                        <!-- Read Link -->
                        <div class="px-6 pb-6 pt-2 border-t border-stage-border/60">
                            <a
                                href="{{ route('artikel.show', $art->slug) }}"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-gold-400 group-hover:text-gold-300 group-hover:translate-x-1 transition-all"
                            >
                                <span>Baca Selengkapnya</span>
                                <span>→</span>
                            </a>
                        </div>

                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pt-4">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</div>