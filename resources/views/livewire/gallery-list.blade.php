<div
    x-data="{
        handleKey(e) {
            if (e.key === 'ArrowRight') { @this.nextLightbox({{ $items->count() }}); }
            if (e.key === 'ArrowLeft') { @this.prevLightbox({{ $items->count() }}); }
            if (e.key === 'Escape') { @this.closeLightbox(); }
        }
    }"
    @keydown.window="handleKey($event)"
>
    <!-- Filter & Tab Toolbar -->
    <div class="bg-stage-card border border-stage-border rounded-2xl p-5 mb-8 space-y-4">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
            
            <!-- Type Tabs: Semua / Foto / Video -->
            <div class="flex items-center p-1 bg-stage-dark rounded-xl border border-stage-border w-full md:w-auto">
                <button
                    type="button"
                    wire:click="$set('tab', 'semua')"
                    class="flex-1 md:flex-initial px-5 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $tab === 'semua' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    Semua Koleksi
                </button>
                <button
                    type="button"
                    wire:click="$set('tab', 'foto')"
                    class="flex-1 md:flex-initial px-5 py-1.5 rounded-lg text-xs font-semibold flex items-center justify-center gap-1.5 transition-all {{ $tab === 'foto' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    <span>📷</span> Foto
                </button>
                <button
                    type="button"
                    wire:click="$set('tab', 'video')"
                    class="flex-1 md:flex-initial px-5 py-1.5 rounded-lg text-xs font-semibold flex items-center justify-center gap-1.5 transition-all {{ $tab === 'video' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    <span>🎬</span> Video
                </button>
            </div>

            <!-- Category & Event Dropdown Filters -->
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <select
                    wire:model.live="selectedCategory"
                    class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-100 focus:border-gold-500"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>

                <select
                    wire:model.live="selectedEventId"
                    class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-100 focus:border-gold-500 max-w-xs"
                >
                    <option value="">Semua Lakon / Pentas</option>
                    @foreach($events as $ev)
                        <option value="{{ $ev->id }}">{{ Str::limit($ev->judul, 25) }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    <!-- Masonry Grid Items -->
    @if($items->isEmpty())
        <x-empty-state
            title="Galeri Belum Tersedia"
            message="Belum ada foto atau rekaman video yang sesuai dengan pilihan filter saat ini."
            icon="📸"
            actionText="Tampilkan Semua Galeri"
            actionClick="$set('tab', 'semua'); $set('selectedCategory', ''); $set('selectedEventId', '');"
        />
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($items as $idx => $item)
                @php
                    $fallbackPhotos = [
                        'https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1469488865564-c2de10f69f96?auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1460723237483-7a6dc9d0b212?auto=format&fit=crop&w=800&q=80',
                        'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=800&q=80',
                    ];
                    $imgUrl = $item->file_path ? asset($item->file_path) : $fallbackPhotos[$item->id % count($fallbackPhotos)];
                @endphp

                <div class="card-theater overflow-hidden rounded-2xl group relative flex flex-col justify-between">
                    
                    <!-- Media Container -->
                    <div
                        wire:click="openLightbox({{ $idx }})"
                        class="relative h-60 w-full overflow-hidden bg-stage-surface cursor-pointer"
                    >
                        <img
                            src="{{ $imgUrl }}"
                            alt="{{ $item->judul }}"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-stage-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>

                        <!-- Media Indicator Icon Overlay -->
                        @if($item->tipe === 'video')
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="w-12 h-12 rounded-full bg-maroon-800/90 text-gold-400 border border-gold-500/50 flex items-center justify-center text-xl shadow-lg group-hover:scale-110 transition-transform">
                                    ▶
                                </span>
                            </div>
                        @else
                            <div class="absolute bottom-3 right-3 text-parchment-200 text-xs px-2 py-1 rounded-md bg-stage-black/70 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                Perbesar 🔍
                            </div>
                        @endif

                        <!-- Badge Tipe & Kategori -->
                        <div class="absolute top-3 left-3 flex items-center gap-1.5">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-stage-black/80 text-gold-400 border border-gold-500/30">
                                {{ $item->tipe === 'video' ? '🎬 Video' : '📷 Foto' }}
                            </span>
                            @if($item->kategori)
                                <span class="px-2 py-0.5 rounded text-[10px] uppercase tracking-wider bg-maroon-900/80 text-parchment-200">
                                    {{ $item->kategori }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Caption Detail -->
                    <div class="p-4 space-y-1">
                        <h4 class="font-serif text-base font-bold text-parchment-100 group-hover:text-gold-300 transition-colors line-clamp-1">
                            {{ $item->judul }}
                        </h4>
                        @if($item->event)
                            <p class="text-xs text-parchment-300 line-clamp-1">
                                Pentas: {{ $item->event->judul }}
                            </p>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        @if($totalItems > $perPage)
            <div class="text-center pt-4">
                <button
                    type="button"
                    wire:click="loadMore"
                    wire:loading.attr="disabled"
                    class="px-8 py-3 rounded-xl bg-stage-card border border-gold-500/40 hover:border-gold-400 text-gold-400 font-semibold text-xs uppercase tracking-wider shadow-md hover:shadow-gold-500/20 transition-all flex items-center gap-2 mx-auto"
                >
                    <span wire:loading.remove wire:target="loadMore">Muat Lebih Banyak Dokumentasi ✦</span>
                    <span wire:loading wire:target="loadMore">Memuat panggung...</span>
                </button>
            </div>
        @endif
    @endif

    <!-- LIGHTBOX MODAL WITH KEYBOARD & NAVIGATION -->
    @if($lightboxIndex !== null && isset($items[$lightboxIndex]))
        @php
            $current = $items[$lightboxIndex];
            $currentImg = $current->file_path ? asset($current->file_path) : $fallbackPhotos[$current->id % count($fallbackPhotos)];
        @endphp

        <div class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center p-4 sm:p-6 bg-stage-black/95 backdrop-blur-xl">
            <!-- Close Button -->
            <button
                type="button"
                wire:click="closeLightbox"
                class="absolute top-6 right-6 z-20 text-parchment-300 hover:text-gold-400 text-2xl font-bold p-2"
                title="Tutup (Esc)"
            >
                ✕
            </button>

            <!-- Previous Button -->
            <button
                type="button"
                wire:click="prevLightbox({{ $items->count() }})"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-stage-surface/80 hover:bg-gold-500 hover:text-stage-black text-parchment-100 border border-stage-border text-lg transition-all"
                title="Sebelumnya (Panah Kiri)"
            >
                ←
            </button>

            <!-- Next Button -->
            <button
                type="button"
                wire:click="nextLightbox({{ $items->count() }})"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-stage-surface/80 hover:bg-gold-500 hover:text-stage-black text-parchment-100 border border-stage-border text-lg transition-all"
                title="Berikutnya (Panah Kanan)"
            >
                →
            </button>

            <!-- Lightbox Main Content -->
            <div class="relative max-w-4xl w-full flex flex-col items-center z-10 space-y-4">
                
                @if($current->tipe === 'video')
                    <!-- Video Embed Lazy Facade -->
                    <div class="w-full aspect-video rounded-2xl overflow-hidden bg-black border border-gold-500/40 shadow-2xl">
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?autoplay=1"
                            title="{{ $current->judul }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                @else
                    <!-- Photo Display -->
                    <div class="max-h-[75vh] rounded-2xl overflow-hidden border border-gold-500/30 shadow-2xl bg-stage-surface">
                        <img
                            src="{{ $currentImg }}"
                            alt="{{ $current->judul }}"
                            class="max-h-[75vh] w-auto object-contain mx-auto"
                        />
                    </div>
                @endif

                <!-- Lightbox Title & Info -->
                <div class="text-center text-parchment-100 max-w-xl space-y-1">
                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-gold-400">
                        {{ $current->judul }}
                    </h3>
                    @if($current->event)
                        <p class="text-xs text-parchment-300">Pentas: {{ $current->event->judul }}</p>
                    @endif
                    <p class="text-[11px] text-stage-muted pt-1">
                        {{ $lightboxIndex + 1 }} dari {{ $items->count() }} dokumentasi • Gunakan tombol panah keyboard ← → untuk navigasi
                    </p>
                </div>

            </div>
        </div>
    @endif
</div>