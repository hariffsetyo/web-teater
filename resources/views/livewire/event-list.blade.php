<div>
    <!-- Filter & View Switcher Bar -->
    <div class="bg-stage-card border border-stage-border rounded-2xl p-5 mb-8 space-y-4">
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
            
            <!-- Search & Filters -->
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto flex-1">
                <div class="relative w-full sm:w-64">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Cari judul agenda/pentas..."
                        class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2 pl-9 text-xs sm:text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500 focus:ring-1 focus:ring-gold-500"
                    />
                    <span class="absolute left-3 top-2.5 text-xs text-stage-muted">🔍</span>
                </div>

                <!-- Tipe Filter -->
                <select
                    wire:model.live="selectedType"
                    class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-100 focus:border-gold-500"
                >
                    <option value="">Semua Tipe Agenda</option>
                    <option value="pementasan">🎭 Pementasan Sandiwara</option>
                    <option value="latihan">🏃 Latihan & Gladi</option>
                    <option value="lomba">🏆 Festival & Lomba</option>
                </select>

                <!-- Status Filter -->
                <select
                    wire:model.live="selectedStatus"
                    class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-100 focus:border-gold-500"
                >
                    <option value="">Semua Status</option>
                    <option value="aktif">🟢 Sedang Aktif / Buka</option>
                    <option value="selesai">⚪ Telah Selesai</option>
                    <option value="draft">🟡 Segera Datang</option>
                </select>
            </div>

            <!-- Switcher: List vs Calendar -->
            <div class="flex items-center p-1 bg-stage-dark rounded-xl border border-stage-border w-full md:w-auto justify-center">
                <button
                    type="button"
                    wire:click="$set('viewMode', 'list')"
                    class="px-4 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition-all {{ $viewMode === 'list' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    <span>📑</span> Daftar List
                </button>
                <button
                    type="button"
                    wire:click="$set('viewMode', 'calendar')"
                    class="px-4 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition-all {{ $viewMode === 'calendar' ? 'bg-gold-500 text-stage-black shadow-md' : 'text-parchment-300 hover:text-gold-400' }}"
                >
                    <span>📅</span> Kalender Bulanan
                </button>
            </div>
        </div>
    </div>

    <!-- TAMPILAN 1: LIST VIEW -->
    @if($viewMode === 'list')
        <div wire:loading.remove wire:target="search, selectedType, selectedStatus, viewMode">
            @if($events->isEmpty())
                <x-empty-state
                    title="Tidak Ada Agenda Ditemukan"
                    message="Belum ada jadwal latihan atau pementasan yang cocok dengan filter yang dipilih."
                    icon="📅"
                    actionText="Lihat Seluruh Agenda"
                    actionClick="$set('search', ''); $set('selectedType', ''); $set('selectedStatus', '');"
                />
            @else
                <div class="space-y-4">
                    @foreach($events as $event)
                        @php
                            $tipeBadge = [
                                'pementasan' => 'gold',
                                'latihan'    => 'neutral',
                                'lomba'      => 'maroon',
                            ][$event->tipe] ?? 'gold';

                            $hasPerformance = $event->performances->where('status', 'buka')->first();
                        @endphp

                        <div class="card-theater p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 hover:border-gold-500/50 group">
                            
                            <!-- Date Badge Box -->
                            <div class="flex items-center gap-4 sm:gap-6">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-stage-surface border border-gold-500/30 flex flex-col items-center justify-center text-center p-2 flex-shrink-0 group-hover:border-gold-400 transition-colors">
                                    <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-gold-400">
                                        {{ $event->tanggal_mulai ? $event->tanggal_mulai->translatedFormat('M') : 'TBA' }}
                                    </span>
                                    <span class="font-serif text-2xl sm:text-3xl font-black text-parchment-100 leading-none my-0.5">
                                        {{ $event->tanggal_mulai ? $event->tanggal_mulai->format('d') : '?' }}
                                    </span>
                                    <span class="text-[9px] text-stage-muted">
                                        {{ $event->tanggal_mulai ? $event->tanggal_mulai->format('Y') : '' }}
                                    </span>
                                </div>

                                <!-- Event Info -->
                                <div class="space-y-1.5">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <x-badge variant="{{ $tipeBadge }}" size="sm">
                                            {{ ucfirst($event->tipe) }}
                                        </x-badge>
                                        <span class="text-[11px] px-2 py-0.5 rounded-full {{ $event->status === 'aktif' ? 'bg-emerald-950/80 text-emerald-400 border border-emerald-500/40' : 'bg-stage-surface text-parchment-300' }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </div>

                                    <h3 class="font-serif text-xl sm:text-2xl font-bold text-parchment-100 group-hover:text-gold-300 transition-colors">
                                        <a href="{{ route('events.show', $event->id) }}">
                                            {{ $event->judul }}
                                        </a>
                                    </h3>

                                    <div class="flex flex-wrap items-center gap-4 text-xs text-parchment-300">
                                        <span class="flex items-center gap-1.5">
                                            <span>⏰</span>
                                            <span>{{ $event->tanggal_mulai ? $event->tanggal_mulai->format('H:i') : '15:30' }} WIB</span>
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <span>📍</span>
                                            <span>{{ $event->lokasi ?? 'Aula Utama Sekolah' }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-3 w-full md:w-auto justify-end pt-3 md:pt-0 border-t md:border-t-0 border-stage-border">
                                @if($hasPerformance)
                                    <x-button href="{{ route('events.show', $event->id) }}" variant="primary" size="sm">
                                        Pesan Tiket 🎟️
                                    </x-button>
                                @endif

                                <x-button href="{{ route('events.show', $event->id) }}" variant="outline" size="sm">
                                    Detail Agenda →
                                </x-button>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <!-- TAMPILAN 2: KALENDER BULANAN -->
    @if($viewMode === 'calendar')
        <div class="bg-stage-card border border-stage-border rounded-3xl p-6 sm:p-8 space-y-6">
            
            <!-- Calendar Header with Month Navigation -->
            <div class="flex items-center justify-between pb-6 border-b border-stage-border">
                <div class="flex items-center gap-3">
                    <span class="text-3xl">📅</span>
                    <div>
                        <h3 class="font-serif text-2xl font-bold text-gold-400 capitalize">
                            {{ $monthName }}
                        </h3>
                        <p class="text-xs text-parchment-300">Jadwal pementasan, latihan, dan agenda sanggar</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        wire:click="prevMonth"
                        class="p-2.5 rounded-xl bg-stage-dark border border-stage-border hover:border-gold-500/40 text-parchment-100 hover:text-gold-400 transition-colors"
                        title="Bulan Sebelumnya"
                    >
                        ←
                    </button>
                    <button
                        type="button"
                        wire:click="nextMonth"
                        class="p-2.5 rounded-xl bg-stage-dark border border-stage-border hover:border-gold-500/40 text-parchment-100 hover:text-gold-400 transition-colors"
                        title="Bulan Berikutnya"
                    >
                        →
                    </button>
                </div>
            </div>

            <!-- Days of Week Header -->
            <div class="grid grid-cols-7 gap-2 text-center text-xs font-bold uppercase tracking-wider text-gold-400/80 pb-2">
                <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span class="text-rose-400">Min</span>
            </div>

            <!-- Calendar Days Grid -->
            <div class="grid grid-cols-7 gap-2">
                <!-- Padding for Start of Month -->
                @for($p = 1; $p < $startDayOfWeek; $p++)
                    <div class="min-h-[90px] rounded-xl bg-stage-dark/30 border border-transparent p-2 text-xs text-stage-muted opacity-30"></div>
                @endfor

                <!-- Days of Current Month -->
                @for($d = 1; $d <= $daysInMonth; $d++)
                    @php
                        $dayEvents = $monthEvents->get((string)$d, collect());
                        $isToday = ($d == date('j') && $currentMonth == date('n') && $currentYear == date('Y'));
                    @endphp

                    <div class="min-h-[90px] sm:min-h-[110px] rounded-xl border p-2 flex flex-col justify-between transition-colors {{ $isToday ? 'bg-gold-500/10 border-gold-500 shadow-gold-glow/20' : 'bg-stage-dark border-stage-border/70 hover:border-gold-500/40' }}">
                        
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold {{ $isToday ? 'text-gold-400' : 'text-parchment-300' }}">
                                {{ $d }}
                            </span>
                            @if($isToday)
                                <span class="text-[9px] px-1.5 py-0.2 rounded bg-gold-500 text-stage-black font-extrabold uppercase">Hari ini</span>
                            @endif
                        </div>

                        <!-- Events on this day -->
                        <div class="space-y-1 mt-1">
                            @foreach($dayEvents as $dev)
                                <a
                                    href="{{ route('events.show', $dev->id) }}"
                                    class="block text-[10px] px-1.5 py-1 rounded bg-maroon-900/80 hover:bg-gold-500 hover:text-stage-black text-parchment-100 border border-gold-500/30 line-clamp-1 transition-colors font-medium"
                                    title="{{ $dev->judul }} ({{ $dev->tanggal_mulai->format('H:i') }})"
                                >
                                    {{ $dev->tipe === 'pementasan' ? '🎭 ' : '🏃 ' }}{{ $dev->judul }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>

        </div>
    @endif
</div>