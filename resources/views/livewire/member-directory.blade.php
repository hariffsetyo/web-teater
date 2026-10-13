<div>
    <!-- Filter & Search Toolbar -->
    <div class="bg-stage-card border border-stage-border rounded-2xl p-5 mb-8 space-y-4">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
            
            <!-- Live Search Bar -->
            <div class="relative w-full md:w-80">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama pemeran / kru..."
                    class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 pl-10 text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500 focus:ring-1 focus:ring-gold-500"
                />
                <span class="absolute left-3.5 top-3 text-stage-muted text-sm">🔍</span>
                @if(!empty($search))
                    <button wire:click="$set('search', '')" class="absolute right-3 top-2.5 text-xs text-parchment-300 hover:text-gold-400">✕</button>
                @endif
            </div>

            <!-- Status Tabs (Aktif / Alumni / Semua) -->
            <div class="flex items-center gap-1.5 p-1 bg-stage-dark rounded-xl border border-stage-border">
                <button
                    type="button"
                    wire:click="$set('selectedStatus', 'aktif')"
                    class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $selectedStatus === 'aktif' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    Anggota Aktif
                </button>
                <button
                    type="button"
                    wire:click="$set('selectedStatus', 'alumni')"
                    class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $selectedStatus === 'alumni' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    Alumni
                </button>
                <button
                    type="button"
                    wire:click="$set('selectedStatus', '')"
                    class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $selectedStatus === '' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    Semua
                </button>
            </div>
        </div>

        <!-- Division Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 pt-1 scrollbar-none">
            @foreach($divisions as $key => $label)
                <button
                    type="button"
                    wire:click="$set('selectedDivisi', '{{ $key }}')"
                    class="px-3.5 py-1.5 rounded-full text-xs font-medium whitespace-nowrap transition-all {{ $selectedDivisi === $key ? 'bg-maroon-800 text-gold-300 border border-gold-500/50 shadow-sm' : 'bg-stage-surface/70 text-parchment-300 border border-stage-border hover:border-gold-500/30 hover:text-gold-400' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Livewire Loading State Skeleton -->
    <div wire:loading wire:target="search, selectedDivisi, selectedStatus" class="w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for($i=0; $i<8; $i++)
                <div class="bg-stage-card border border-stage-border rounded-2xl p-5 space-y-3">
                    <x-skeleton height="h-44" rounded="rounded-xl" />
                    <x-skeleton width="w-3/4" height="h-4" />
                    <x-skeleton width="w-1/2" height="h-3" />
                </div>
            @endfor
        </div>
    </div>

    <!-- Member Cards Grid -->
    <div wire:loading.remove wire:target="search, selectedDivisi, selectedStatus">
        @if($members->isEmpty())
            <x-empty-state
                title="Pemeran Tidak Ditemukan"
                message="Tidak ada data anggota teater yang cocok dengan kriteria pencarian atau filter yang Anda pilih."
                icon="🎭"
                actionText="Reset Filter"
                actionClick="$set('search', ''); $set('selectedDivisi', ''); $set('selectedStatus', 'aktif');"
            />
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($members as $m)
                    @php
                        // Divisi color & badge
                        $divisiColors = [
                            'akting'        => 'gold',
                            'naskah'        => 'maroon',
                            'tata_rias'     => 'neutral',
                            'tata_panggung' => 'gold',
                            'musik'         => 'maroon',
                            'humas'         => 'neutral',
                        ][$m->divisi] ?? 'gold';

                        // Avatar fallback berdasarkan nama
                        $initials = collect(explode(' ', $m->nama))->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->join('');
                        $portraits = [
                            'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80',
                            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                            'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80',
                            'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=400&q=80',
                        ];
                        $photoUrl = $m->foto ? asset($m->foto) : ($portraits[$m->id % count($portraits)]);
                    @endphp

                    <div
                        wire:click="selectMember({{ $m->id }})"
                        class="card-theater p-5 cursor-pointer flex flex-col justify-between group text-center hover:scale-[1.02]"
                    >
                        <div>
                            <!-- Photo / Portrait -->
                            <div class="relative w-full h-48 rounded-xl overflow-hidden mb-4 bg-stage-surface">
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $m->nama }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover filter brightness-95 group-hover:brightness-105 group-hover:scale-105 transition-all duration-500"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-stage-card via-transparent to-transparent opacity-70"></div>
                                
                                <!-- Status Badge -->
                                <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $m->status === 'aktif' ? 'bg-emerald-950/80 text-emerald-400 border border-emerald-500/40' : 'bg-stage-black/80 text-parchment-300 border border-stage-border' }}">
                                    {{ $m->status === 'aktif' ? 'Aktif' : 'Alumni' }}
                                </span>
                            </div>

                            <!-- Nama & Divisi -->
                            <h4 class="font-serif text-lg font-bold text-parchment-100 group-hover:text-gold-300 transition-colors line-clamp-1 mb-1">
                                {{ $m->nama }}
                            </h4>
                            <p class="text-xs text-parchment-300 mb-3">{{ $m->kelas }} • Angkatan {{ $m->angkatan }}</p>
                        </div>

                        <div class="pt-3 border-t border-stage-border/70 flex items-center justify-between text-xs">
                            <x-badge variant="{{ $divisiColors }}" size="sm">
                                {{ $m->divisi_label }}
                            </x-badge>
                            <span class="text-gold-400 text-xs font-semibold group-hover:translate-x-0.5 transition-transform">
                                Lihat Profil →
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal Detail Anggota (Bio & Rekam Jejak) -->
    @if($selectedMember)
        <div class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 flex items-center justify-center">
            <div wire:click="closeModal" class="fixed inset-0 bg-stage-black/80 backdrop-blur-md"></div>
            
            <div class="relative w-full max-w-lg bg-stage-card border border-gold-500/40 rounded-3xl p-6 sm:p-8 shadow-2xl z-10 text-left">
                <!-- Close Button -->
                <button wire:click="closeModal" class="absolute top-5 right-5 text-parchment-300 hover:text-gold-400 text-lg">✕</button>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                    <!-- Photo -->
                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl overflow-hidden bg-stage-surface border border-gold-500/30 flex-shrink-0 shadow-lg">
                        <img
                            src="{{ $selectedMember->foto ? asset($selectedMember->foto) : ($portraits[$selectedMember->id % count($portraits)]) }}"
                            alt="{{ $selectedMember->nama }}"
                            class="w-full h-full object-cover"
                        />
                    </div>

                    <!-- Main Info -->
                    <div class="flex-1 text-center sm:text-left space-y-2">
                        <x-badge variant="gold" size="sm">
                            Divisi {{ $selectedMember->divisi_label }}
                        </x-badge>
                        <h3 class="font-serif text-2xl font-bold text-parchment-100">
                            {{ $selectedMember->nama }}
                        </h3>
                        <p class="text-xs text-parchment-300">
                            Kelas: <strong class="text-parchment-100">{{ $selectedMember->kelas }}</strong> • Angkatan: <strong class="text-gold-400">{{ $selectedMember->angkatan }}</strong>
                        </p>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $selectedMember->status === 'aktif' ? 'bg-emerald-950/80 text-emerald-400 border border-emerald-500/30' : 'bg-stage-surface text-parchment-300' }}">
                            Status: {{ ucfirst($selectedMember->status) }}
                        </span>
                    </div>
                </div>

                <!-- Bio & Kutipan -->
                <div class="mt-6 pt-5 border-t border-stage-border space-y-3">
                    <h5 class="text-xs font-semibold uppercase tracking-widest text-gold-400">
                        ✦ Catatan & Biodata Seniman
                    </h5>
                    <p class="text-sm text-parchment-200 italic leading-relaxed bg-stage-surface/50 p-4 rounded-xl border border-stage-border">
                        &ldquo;{{ $selectedMember->bio ?: 'Mendedikasikan energi kreatif dan kecintaannya pada seni peran untuk memajukan karya pementasan Sanggar Teater Siklus.' }}&rdquo;
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-stage-border flex justify-end">
                    <x-button type="button" wire:click="closeModal" variant="outline" size="sm">
                        Tutup Profil
                    </x-button>
                </div>
            </div>
        </div>
    @endif
</div>