<x-layouts.public title="Teater Radio & Siniar Suara — Teater Siklus">
    
    <!-- Alpine Audio Player State Container -->
    <div
        x-data="{
            currentTrack: null,
            isPlaying: false,
            currentTime: 0,
            duration: 0,
            volume: 1,
            playbackRate: 1,
            audio: null,
            init() {
                this.audio = new Audio();
                this.audio.addEventListener('timeupdate', () => {
                    this.currentTime = this.audio.currentTime;
                });
                this.audio.addEventListener('loadedmetadata', () => {
                    this.duration = this.audio.duration;
                });
                this.audio.addEventListener('ended', () => {
                    this.isPlaying = false;
                });
            },
            playTrack(track) {
                if (this.currentTrack && this.currentTrack.id === track.id) {
                    this.togglePlay();
                    return;
                }
                this.currentTrack = track;
                // Menggunakan audio dummy yang valid atau URL audio
                this.audio.src = track.url_audio || 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3';
                this.audio.playbackRate = this.playbackRate;
                this.audio.volume = this.volume;
                this.audio.play();
                this.isPlaying = true;

                // Hitung jumlah play ke backend
                fetch(`/podcast/${track.id}/play`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
                });
            },
            togglePlay() {
                if (this.isPlaying) {
                    this.audio.pause();
                    this.isPlaying = false;
                } else {
                    this.audio.play();
                    this.isPlaying = true;
                }
            },
            seek(e) {
                this.audio.currentTime = e.target.value;
            },
            setSpeed(speed) {
                this.playbackRate = speed;
                this.audio.playbackRate = speed;
            },
            setVolume(val) {
                this.volume = val;
                this.audio.volume = val;
            },
            formatTime(seconds) {
                if (isNaN(seconds)) return '00:00';
                let m = Math.floor(seconds / 60);
                let s = Math.floor(seconds % 60);
                return `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
            }
        }"
        class="pb-28"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            
            <x-breadcrumb :items="[['label' => 'Teater Radio & Siniar', 'url' => null]]" />

            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <x-badge variant="gold">✦ DRAMA AUDIO & SINISAN SUARA ✦</x-badge>
                <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                    Panggung Tanpa Batas <span class="text-gold-gradient gold-glow">Lewat Sandiwara Radio</span>
                </h1>
                <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                    Dengarkan lakon audio orisinal, obrolan mendalam di balik layar gladi resik, serta wawancara eksklusif bersama aktor dan sutradara pementasan.
                </p>
            </div>

            <!-- Filter Categories & Search Bar -->
            <div class="bg-stage-card border border-stage-border rounded-2xl p-5 mb-10 flex flex-col md:flex-row gap-4 justify-between items-center">
                <!-- Search Form -->
                <form action="{{ route('podcast.index') }}" method="GET" class="relative w-full md:w-80">
                    @if($category)
                        <input type="hidden" name="kategori" value="{{ $category }}">
                    @endif
                    <input
                        type="text"
                        name="q"
                        value="{{ $search }}"
                        placeholder="Cari judul episode siniar..."
                        class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 pl-10 text-xs sm:text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500"
                    />
                    <span class="absolute left-3.5 top-3 text-stage-muted text-xs sm:text-sm">🔍</span>
                </form>

                <!-- Category Filters -->
                <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-1 md:pb-0 scrollbar-none">
                    @foreach($categories as $key => $label)
                        <a
                            href="{{ route('podcast.index', array_filter(['kategori' => $key, 'q' => $search])) }}"
                            class="px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap transition-all {{ $category === $key ? 'bg-gold-500 text-stage-black shadow-md' : 'bg-stage-dark text-parchment-300 border border-stage-border hover:border-gold-500/40 hover:text-gold-400' }}"
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Episodes Grid -->
            @if($episodes->isEmpty())
                <x-empty-state
                    title="Episode Belum Ditemukan"
                    message="Belum ada episode siniar radio yang sesuai dengan pencarian atau filter yang Anda pilih."
                    icon="🎙️"
                    actionText="Lihat Seluruh Episode"
                    actionUrl="{{ route('podcast.index') }}"
                />
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($episodes as $ep)
                        @php
                            $catBadge = [
                                'drama_audio'       => ['badge' => 'gold', 'label' => 'Drama Audio'],
                                'behind_the_scenes' => ['badge' => 'maroon', 'label' => 'Di Balik Layar'],
                                'wawancara'         => ['badge' => 'neutral', 'label' => 'Wawancara'],
                            ][$ep->kategori] ?? ['badge' => 'gold', 'label' => ucfirst($ep->kategori)];

                            $fallbackCover = "https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&w=600&q=80";
                        @endphp

                        <div class="card-theater p-6 rounded-3xl flex flex-col justify-between group relative overflow-hidden">
                            <div>
                                <!-- Cover Image & Play Overlay -->
                                <div class="relative h-48 rounded-2xl overflow-hidden bg-stage-surface mb-5">
                                    <img
                                        src="{{ $fallbackCover }}"
                                        alt="{{ $ep->judul }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-stage-black/80 via-black/30 to-transparent"></div>

                                    <!-- Category Badge -->
                                    <div class="absolute top-3 left-3">
                                        <x-badge variant="{{ $catBadge['badge'] }}" size="sm">
                                            {{ $catBadge['label'] }}
                                        </x-badge>
                                    </div>

                                    <!-- Duration -->
                                    <div class="absolute bottom-3 left-3 text-xs text-parchment-200 bg-stage-black/80 px-2 py-0.5 rounded backdrop-blur-sm">
                                        ⏱️ {{ $ep->durasi ?? '15:20' }}
                                    </div>

                                    <!-- Play Button Trigger -->
                                    <button
                                        type="button"
                                        @click="playTrack({ id: {{ $ep->id }}, judul: '{{ addslashes($ep->judul) }}', durasi: '{{ $ep->durasi }}', kategori: '{{ $catBadge['label'] }}' })"
                                        class="absolute bottom-3 right-3 w-12 h-12 rounded-full bg-gold-500 hover:bg-gold-400 text-stage-black flex items-center justify-center text-xl shadow-lg shadow-gold-500/30 group-hover:scale-110 active:scale-95 transition-all"
                                        title="Putar Episode Ini"
                                    >
                                        <span x-show="!(currentTrack && currentTrack.id === {{ $ep->id }} && isPlaying)">▶</span>
                                        <span x-show="currentTrack && currentTrack.id === {{ $ep->id }} && isPlaying">⏸</span>
                                    </button>
                                </div>

                                <!-- Episode Title & Deskripsi -->
                                <h3 class="font-serif text-xl font-bold text-parchment-100 group-hover:text-gold-300 transition-colors line-clamp-2 mb-2">
                                    <a href="{{ route('podcast.show', $ep->id) }}">
                                        {{ $ep->judul }}
                                    </a>
                                </h3>

                                <p class="text-xs sm:text-sm text-parchment-300 line-clamp-3 leading-relaxed mb-4">
                                    {{ $ep->deskripsi }}
                                </p>
                            </div>

                            <!-- Footer Meta -->
                            <div class="pt-4 border-t border-stage-border/60 flex items-center justify-between text-xs text-stage-muted">
                                <span>🎧 {{ $ep->jumlah_play }} kali diputar</span>
                                <a href="{{ route('podcast.show', $ep->id) }}" class="text-gold-400 font-semibold group-hover:translate-x-1 transition-transform">
                                    Detail Episode →
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="pt-4">
                    {{ $episodes->links() }}
                </div>
            @endif

        </div>

        <!-- STICKY BOTTOM THEATRICAL AUDIO PLAYER -->
        <div
            x-show="currentTrack !== null"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-full"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="fixed bottom-0 left-0 right-0 z-50 bg-stage-dark/95 border-t-2 border-gold-500/50 backdrop-blur-xl px-4 py-3 sm:px-8 shadow-2xl"
        >
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
                
                <!-- Track Info (Left) -->
                <div class="flex items-center gap-4 w-full md:w-1/4">
                    <div class="w-12 h-12 rounded-xl bg-maroon-900 border border-gold-500/40 flex items-center justify-center text-2xl flex-shrink-0 relative overflow-hidden">
                        <span>🎙️</span>
                        <!-- Animated CSS Wave Visualizer -->
                        <div x-show="isPlaying" class="absolute inset-x-1 bottom-1 flex items-end justify-center gap-0.5 h-3">
                            <span class="w-1 bg-gold-400 animate-pulse h-full"></span>
                            <span class="w-1 bg-gold-400 animate-pulse h-2"></span>
                            <span class="w-1 bg-gold-400 animate-pulse h-3"></span>
                            <span class="w-1 bg-gold-400 animate-pulse h-1"></span>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="font-serif font-bold text-sm text-parchment-100 truncate" x-text="currentTrack ? currentTrack.judul : ''"></h4>
                        <span class="text-[10px] text-gold-400 uppercase tracking-wider block" x-text="currentTrack ? currentTrack.kategori : ''"></span>
                    </div>
                </div>

                <!-- Central Player Controls & Seekbar (Center) -->
                <div class="flex-1 w-full max-w-xl flex flex-col items-center space-y-1.5">
                    <div class="flex items-center gap-4">
                        <button type="button" @click="audio.currentTime = Math.max(0, audio.currentTime - 10)" class="text-parchment-300 hover:text-gold-400 text-xs">
                            ⏪ -10s
                        </button>

                        <button
                            type="button"
                            @click="togglePlay()"
                            class="w-10 h-10 rounded-full bg-gold-500 text-stage-black flex items-center justify-center text-lg font-bold shadow-gold-glow hover:scale-105 active:scale-95 transition-all"
                        >
                            <span x-show="!isPlaying">▶</span>
                            <span x-show="isPlaying">⏸</span>
                        </button>

                        <button type="button" @click="audio.currentTime = Math.min(duration, audio.currentTime + 10)" class="text-parchment-300 hover:text-gold-400 text-xs">
                            +10s ⏩
                        </button>
                    </div>

                    <div class="w-full flex items-center gap-3 text-xs text-parchment-300 font-mono">
                        <span x-text="formatTime(currentTime)">00:00</span>
                        <input
                            type="range"
                            min="0"
                            :max="duration || 100"
                            :value="currentTime"
                            @input="seek($event)"
                            class="flex-1 h-1.5 bg-stage-surface rounded-lg appearance-none cursor-pointer accent-gold-500"
                        />
                        <span x-text="formatTime(duration)">00:00</span>
                    </div>
                </div>

                <!-- Speed & Volume Controls (Right) -->
                <div class="hidden md:flex items-center gap-4 w-1/4 justify-end">
                    <!-- Speed buttons -->
                    <div class="flex items-center bg-stage-surface rounded-lg p-0.5 border border-stage-border text-xs">
                        <button type="button" @click="setSpeed(1)" class="px-2 py-0.5 rounded" :class="playbackRate === 1 ? 'bg-gold-500 text-stage-black font-bold' : 'text-parchment-300'">1x</button>
                        <button type="button" @click="setSpeed(1.5)" class="px-2 py-0.5 rounded" :class="playbackRate === 1.5 ? 'bg-gold-500 text-stage-black font-bold' : 'text-parchment-300'">1.5x</button>
                        <button type="button" @click="setSpeed(2)" class="px-2 py-0.5 rounded" :class="playbackRate === 2 ? 'bg-gold-500 text-stage-black font-bold' : 'text-parchment-300'">2x</button>
                    </div>

                    <!-- Volume slider -->
                    <div class="flex items-center gap-1.5 text-xs text-parchment-300">
                        <span>🔊</span>
                        <input
                            type="range"
                            min="0"
                            max="1"
                            step="0.05"
                            :value="volume"
                            @input="setVolume($event.target.value)"
                            class="w-16 h-1 bg-stage-surface rounded appearance-none accent-gold-500"
                        />
                    </div>

                    <button type="button" @click="audio.pause(); isPlaying = false; currentTrack = null;" class="text-stage-muted hover:text-gold-400 text-xs ml-2">
                        ✕
                    </button>
                </div>

            </div>
        </div>

    </div>

</x-layouts.public>