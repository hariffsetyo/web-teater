<x-layouts.public :title="$episode->judul . ' — Teater Radio'">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[
            ['label' => 'Teater Radio', 'url' => route('podcast.index')],
            ['label' => Str::limit($episode->judul, 35), 'url' => null]
        ]" />

        <div class="card-theater p-8 sm:p-10 rounded-3xl mb-12 space-y-6 border-gold-500/30">
            <div class="flex flex-wrap items-center gap-2.5">
                <x-badge variant="gold">{{ ucfirst(str_replace('_', ' ', $episode->kategori)) }}</x-badge>
                <span class="text-xs text-parchment-300">⏱️ Durasi: {{ $episode->durasi ?? '15 Menit' }}</span>
                <span class="text-xs text-stage-muted">•</span>
                <span class="text-xs text-parchment-300">🎧 {{ $episode->jumlah_play }} kali didengarkan</span>
            </div>

            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-extrabold text-parchment-100">
                {{ $episode->judul }}
            </h1>

            <div class="p-6 rounded-2xl bg-stage-dark border border-stage-border space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-maroon-800 to-stage-black border border-gold-500/40 flex items-center justify-center text-3xl">
                        🎙️
                    </div>
                    <div>
                        <span class="text-xs font-semibold uppercase text-gold-400">Putar Episode Sekarang</span>
                        <p class="text-xs text-parchment-300">Format Stereo High Definition Drama Audio</p>
                    </div>
                </div>

                <!-- Native Player Fallback -->
                <audio controls class="w-full">
                    <source src="{{ $episode->url_audio ?: 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3' }}" type="audio/mpeg">
                    Browser Anda tidak mendukung elemen audio.
                </audio>
            </div>

            <div class="space-y-3 pt-4 border-t border-stage-border">
                <h3 class="font-serif text-xl font-bold text-parchment-100">Sinopsis & Catatan Sutradara Audio</h3>
                <p class="text-sm sm:text-base text-parchment-200 leading-relaxed">
                    {{ $episode->deskripsi }}
                </p>
            </div>
        </div>

        <!-- Episode Terkait -->
        @if($related->isNotEmpty())
            <div class="pt-6 border-t border-stage-border">
                <h3 class="font-serif text-2xl font-bold text-parchment-100 mb-6 flex items-center gap-2">
                    <span class="text-gold-400">✦</span> Episode Siniar Terkait
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($related as $rel)
                        <div class="card-theater p-5 rounded-2xl flex flex-col justify-between group">
                            <div>
                                <span class="text-[10px] text-gold-400 uppercase font-semibold">{{ ucfirst(str_replace('_', ' ', $rel->kategori)) }}</span>
                                <h4 class="font-serif text-base font-bold text-parchment-100 group-hover:text-gold-300 transition-colors line-clamp-2 mt-1">
                                    <a href="{{ route('podcast.show', $rel->id) }}">{{ $rel->judul }}</a>
                                </h4>
                            </div>
                            <div class="pt-3 border-t border-stage-border/60 flex items-center justify-between text-xs text-stage-muted mt-4">
                                <span>⏱️ {{ $rel->durasi ?? '15:00' }}</span>
                                <a href="{{ route('podcast.show', $rel->id) }}" class="text-gold-400 font-semibold">Putar →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</x-layouts.public>