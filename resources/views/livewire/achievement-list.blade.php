<div>
    <!-- Filter Toolbar -->
    <div class="bg-stage-card border border-stage-border rounded-2xl p-5 mb-10 flex flex-col md:flex-row gap-4 justify-between items-center">
        <!-- Live Search -->
        <div class="relative w-full md:w-80">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari nama festival / kejuaraan..."
                class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2 pl-9 text-xs sm:text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500 focus:ring-1 focus:ring-gold-500"
            />
            <span class="absolute left-3 top-2.5 text-xs text-stage-muted">🔍</span>
            @if(!empty($search))
                <button wire:click="$set('search', '')" class="absolute right-3 top-2.5 text-xs text-parchment-300 hover:text-gold-400">✕</button>
            @endif
        </div>

        <!-- Filter Dropdowns (Tingkat & Tahun) -->
        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <select
                wire:model.live="selectedTingkat"
                class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-100 focus:border-gold-500"
            >
                @foreach($tingkatList as $k => $val)
                    <option value="{{ $k }}">{{ $val }}</option>
                @endforeach
            </select>

            <select
                wire:model.live="selectedYear"
                class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-100 focus:border-gold-500"
            >
                <option value="">Semua Tahun</option>
                @foreach($years as $yr)
                    <option value="{{ $yr }}">Tahun {{ $yr }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Livewire Loading Skeleton -->
    <div wire:loading wire:target="search, selectedTingkat, selectedYear" class="w-full space-y-8">
        @for($i=0; $i<3; $i++)
            <div class="space-y-4">
                <x-skeleton width="w-32" height="h-8" />
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-skeleton height="h-48" rounded="rounded-2xl" />
                    <x-skeleton height="h-48" rounded="rounded-2xl" />
                    <x-skeleton height="h-48" rounded="rounded-2xl" />
                </div>
            </div>
        @endfor
    </div>

    <!-- Grouped Achievements Timeline -->
    <div wire:loading.remove wire:target="search, selectedTingkat, selectedYear">
        @if($achievementsByYear->isEmpty())
            <x-empty-state
                title="Prestasi Tidak Ditemukan"
                message="Belum ada riwayat penghargaan piala yang cocok dengan filter pencarian Anda."
                icon="🏆"
                actionText="Reset Pencarian"
                actionClick="$set('search', ''); $set('selectedTingkat', ''); $set('selectedYear', '');"
            />
        @else
            <div class="space-y-16">
                @foreach($achievementsByYear as $year => $items)
                    <div class="relative">
                        
                        <!-- Header Tahun (Pita Emas Timeline) -->
                        <div class="flex items-center gap-4 mb-6">
                            <span class="px-5 py-2 rounded-xl bg-gradient-to-r from-maroon-800 to-maroon-900 border border-gold-500/40 text-gold-400 font-serif font-black text-xl sm:text-2xl shadow-lg flex items-center gap-2">
                                <span>🏅</span>
                                <span>Tahun {{ $year }}</span>
                            </span>
                            <div class="flex-1 h-px bg-gradient-to-r from-gold-500/40 via-stage-border to-transparent"></div>
                            <span class="text-xs text-parchment-300 font-semibold">{{ $items->count() }} Penghargaan</span>
                        </div>

                        <!-- Grid Trofi Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($items as $item)
                                @php
                                    // Deteksi medali emas / perak / perunggu
                                    $p = strtolower($item->peringkat);
                                    if (str_contains($p, '1') || str_contains($p, 'terbaik') || str_contains($p, 'utama')) {
                                        $medalType = 'gold';
                                        $medalIcon = '🥇';
                                        $medalBadge = 'bg-gold-500/20 text-gold-300 border-gold-500/50';
                                    } elseif (str_contains($p, '2')) {
                                        $medalType = 'silver';
                                        $medalIcon = '🥈';
                                        $medalBadge = 'bg-slate-700/40 text-slate-200 border-slate-500/40';
                                    } else {
                                        $medalType = 'bronze';
                                        $medalIcon = '🥉';
                                        $medalBadge = 'bg-amber-900/40 text-amber-300 border-amber-700/50';
                                    }

                                    $fallbackTrophy = "https://images.unsplash.com/photo-1578269174936-2709b6aeb913?auto=format&fit=crop&w=600&q=80";
                                @endphp

                                <div class="card-theater p-6 rounded-2xl flex flex-col justify-between group relative overflow-hidden">
                                    <!-- Aksen background glow medali emas -->
                                    @if($medalType === 'gold')
                                        <div class="absolute -top-12 -right-12 w-28 h-28 bg-gold-500/10 rounded-full blur-xl group-hover:bg-gold-500/20 transition-all"></div>
                                    @endif

                                    <div>
                                        <!-- Header: Peringkat Badge & Tingkat -->
                                        <div class="flex items-center justify-between gap-2 mb-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border flex items-center gap-1.5 {{ $medalBadge }}">
                                                <span>{{ $medalIcon }}</span>
                                                <span>{{ $item->peringkat }}</span>
                                            </span>
                                            <span class="text-[11px] text-parchment-300 uppercase tracking-wider font-medium">
                                                Tingkat {{ ucfirst($item->tingkat) }}
                                            </span>
                                        </div>

                                        <!-- Nama Lomba / Festival -->
                                        <h4 class="font-serif text-lg sm:text-xl font-bold text-parchment-100 group-hover:text-gold-300 transition-colors mb-3 leading-snug">
                                            {{ $item->nama_lomba }}
                                        </h4>

                                        <!-- Deskripsi Pencapaian -->
                                        <p class="text-xs sm:text-sm text-parchment-300 leading-relaxed mb-4">
                                            {{ $item->deskripsi ?: 'Sebuah pencapaian membanggakan yang diraih atas kerja keras seluruh pemeran dan kru panggung.' }}
                                        </p>
                                    </div>

                                    <!-- Footer info -->
                                    <div class="pt-3 border-t border-stage-border/60 flex items-center justify-between text-xs text-stage-muted">
                                        <span class="flex items-center gap-1">
                                            <span>🎭</span> Sanggar Teater Siklus
                                        </span>
                                        <span class="font-semibold text-gold-400">Tahun {{ $item->tahun }}</span>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>