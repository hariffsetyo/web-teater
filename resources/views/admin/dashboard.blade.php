@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Hero / Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-curtain-950 via-curtain-900 to-stage-card border border-gold-500/30 p-6 sm:p-8 shadow-2xl">
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-gold-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gold-500/20 text-gold-300 border border-gold-500/30">
                    🎭 Panggung Utama Teater Siklus
                </span>
                <h1 class="font-serif text-2xl sm:text-3xl font-extrabold text-parchment-100 tracking-wide">
                    Selamat Datang, <span class="text-gold-400">{{ auth('admin')->user()->name ?? 'Administrator' }}</span>
                </h1>
                <p class="text-xs sm:text-sm text-parchment-300 max-w-xl">
                    Pantau dinamika panggung, data keanggotaan, reservasi tiket, dan publikasi konten seni dalam satu kendali terpadu.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.pentas.index') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-lg shadow-gold-500/20 transition flex items-center gap-2">
                    <span>🎟️ Kelola Tiket</span>
                </a>
                <a href="{{ route('admin.artikel.create') }}" class="px-4 py-2 rounded-xl bg-stage-surface hover:bg-stage-card border border-stage-border text-parchment-200 text-xs font-semibold transition flex items-center gap-2">
                    <span>✏️ Tulis Artikel</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 1. Six Stat Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <!-- Anggota Aktif -->
        <div class="p-4 rounded-2xl bg-stage-card/80 border border-stage-border hover:border-gold-500/40 transition group">
            <div class="flex items-center justify-between">
                <span class="text-xl">👥</span>
                <span class="text-[10px] font-semibold text-gold-400 bg-gold-500/10 px-2 py-0.5 rounded-full">Aktif</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-bold font-serif text-parchment-100 group-hover:text-gold-400 transition">{{ $stats['active_members'] }}</div>
                <div class="text-[11px] text-parchment-400">Anggota Aktif</div>
            </div>
        </div>

        <!-- Event Bulan Ini -->
        <div class="p-4 rounded-2xl bg-stage-card/80 border border-stage-border hover:border-curtain-600/40 transition group">
            <div class="flex items-center justify-between">
                <span class="text-xl">📅</span>
                <span class="text-[10px] font-semibold text-curtain-300 bg-curtain-900/40 px-2 py-0.5 rounded-full">Bulan Ini</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-bold font-serif text-parchment-100 group-hover:text-curtain-300 transition">{{ $stats['events_this_month'] }}</div>
                <div class="text-[11px] text-parchment-400">Agenda Event</div>
            </div>
        </div>

        <!-- Pendaftar Pending -->
        <div class="p-4 rounded-2xl bg-stage-card/80 border border-stage-border hover:border-rose-500/40 transition group">
            <div class="flex items-center justify-between">
                <span class="text-xl">📋</span>
                <span class="text-[10px] font-semibold text-rose-300 bg-rose-950/50 px-2 py-0.5 rounded-full {{ $stats['pending_registrations'] > 0 ? 'animate-pulse' : '' }}">Antrean</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-bold font-serif text-parchment-100 group-hover:text-rose-400 transition">{{ $stats['pending_registrations'] }}</div>
                <div class="text-[11px] text-parchment-400">Pendaftar Pending</div>
            </div>
        </div>

        <!-- Tiket Terjual -->
        <div class="p-4 rounded-2xl bg-stage-card/80 border border-stage-border hover:border-amber-500/40 transition group">
            <div class="flex items-center justify-between">
                <span class="text-xl">🎟️</span>
                <span class="text-[10px] font-semibold text-amber-400 bg-amber-500/10 px-2 py-0.5 rounded-full">Terjual</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-bold font-serif text-parchment-100 group-hover:text-amber-400 transition">{{ number_format($stats['tickets_sold']) }}</div>
                <div class="text-[11px] text-parchment-400">Tiket Terkonfirmasi</div>
            </div>
        </div>

        <!-- Total Views Artikel -->
        <div class="p-4 rounded-2xl bg-stage-card/80 border border-stage-border hover:border-cyan-500/40 transition group">
            <div class="flex items-center justify-between">
                <span class="text-xl">👁️</span>
                <span class="text-[10px] font-semibold text-cyan-300 bg-cyan-950/50 px-2 py-0.5 rounded-full">Artikel</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-bold font-serif text-parchment-100 group-hover:text-cyan-400 transition">{{ number_format($stats['total_article_views']) }}</div>
                <div class="text-[11px] text-parchment-400">Total Pembaca</div>
            </div>
        </div>

        <!-- Total Play Podcast -->
        <div class="p-4 rounded-2xl bg-stage-card/80 border border-stage-border hover:border-purple-500/40 transition group">
            <div class="flex items-center justify-between">
                <span class="text-xl">🎙️</span>
                <span class="text-[10px] font-semibold text-purple-300 bg-purple-950/50 px-2 py-0.5 rounded-full">Audio</span>
            </div>
            <div class="mt-3">
                <div class="text-2xl font-bold font-serif text-parchment-100 group-hover:text-purple-400 transition">{{ number_format($stats['total_podcast_plays']) }}</div>
                <div class="text-[11px] text-parchment-400">Total Putar Podcast</div>
            </div>
        </div>
    </div>

    <!-- 2. Four Interactive Charts (2x2 Grid) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 1: Pendaftar per Bulan -->
        <div class="p-5 rounded-3xl bg-stage-card/80 border border-stage-border shadow-xl space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-sm sm:text-base font-bold text-parchment-100 flex items-center gap-2">
                        <span>📈 Tren Pendaftaran Audisi</span>
                    </h3>
                    <p class="text-[11px] text-parchment-400">Jumlah calon anggota baru selama 6 bulan terakhir</p>
                </div>
            </div>
            <div class="h-64 relative">
                <canvas id="chartRegistrations"></canvas>
            </div>
        </div>

        <!-- Chart 2: Tiket per Pementasan -->
        <div class="p-5 rounded-3xl bg-stage-card/80 border border-stage-border shadow-xl space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-sm sm:text-base font-bold text-parchment-100 flex items-center gap-2">
                        <span>🎟️ Okupansi Kursi Pementasan</span>
                    </h3>
                    <p class="text-[11px] text-parchment-400">Perbandingan tiket terjual vs kapasitas kuota kursi</p>
                </div>
            </div>
            <div class="h-64 relative">
                <canvas id="chartPerformances"></canvas>
            </div>
        </div>

        <!-- Chart 3: Anggota per Divisi (Donut) -->
        <div class="p-5 rounded-3xl bg-stage-card/80 border border-stage-border shadow-xl space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-sm sm:text-base font-bold text-parchment-100 flex items-center gap-2">
                        <span>🎭 Distribusi Anggota per Divisi</span>
                    </h3>
                    <p class="text-[11px] text-parchment-400">Komposisi kekuatan tim kreatif & panggung aktif</p>
                </div>
            </div>
            <div class="h-64 relative flex items-center justify-center">
                <canvas id="chartDivisions"></canvas>
            </div>
        </div>

        <!-- Chart 4: Artikel Terpopuler -->
        <div class="p-5 rounded-3xl bg-stage-card/80 border border-stage-border shadow-xl space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-sm sm:text-base font-bold text-parchment-100 flex items-center gap-2">
                        <span>📝 Pembaca Artikel Terbanyak</span>
                    </h3>
                    <p class="text-[11px] text-parchment-400">5 artikel wawasan teater dengan views tertinggi</p>
                </div>
            </div>
            <div class="h-64 relative">
                <canvas id="chartArticles"></canvas>
            </div>
        </div>
    </div>

    <!-- 3. Operational Widgets (3 Columns) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Widget 1: Agenda Event Terdekat -->
        <div class="p-5 rounded-3xl bg-stage-card/80 border border-stage-border shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-stage-border pb-3">
                <h3 class="font-serif text-sm font-bold text-parchment-100 flex items-center gap-2">
                    <span>📅 Agenda Terdekat</span>
                </h3>
                <a href="{{ route('admin.event.index') }}" class="text-[11px] text-gold-400 hover:underline">Lihat Semua →</a>
            </div>

            <div class="space-y-3">
                @forelse($upcomingEvents as $evt)
                    <div class="p-3 rounded-2xl bg-stage-surface/70 border border-stage-border hover:border-gold-500/30 transition flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gold-500/10 border border-gold-500/20 text-gold-400 flex flex-col items-center justify-center flex-shrink-0 text-[10px] font-bold">
                            <span>{{ $evt->tanggal_mulai->format('d') }}</span>
                            <span class="text-[8px] uppercase text-parchment-400">{{ $evt->tanggal_mulai->translatedFormat('M') }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-semibold text-parchment-100 truncate">{{ $evt->judul }}</h4>
                            <p class="text-[10px] text-parchment-400 truncate">{{ $evt->lokasi ?? 'Aula Teater' }} • {{ $evt->tanggal_mulai->format('H:i') }} WIB</p>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold {{ $evt->tipe === 'pementasan' ? 'bg-curtain-800 text-gold-300' : 'bg-stage-dark text-parchment-400' }}">
                            {{ ucfirst($evt->tipe) }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-parchment-500 py-4 text-center">Belum ada agenda terdekat.</p>
                @endforelse
            </div>
        </div>

        <!-- Widget 2: Pendaftar Audisi Terbaru -->
        <div class="p-5 rounded-3xl bg-stage-card/80 border border-stage-border shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-stage-border pb-3">
                <h3 class="font-serif text-sm font-bold text-parchment-100 flex items-center gap-2">
                    <span>📋 Audisi Terbaru</span>
                </h3>
                <a href="{{ route('admin.pendaftaran.index') }}" class="text-[11px] text-gold-400 hover:underline">Kelola →</a>
            </div>

            <div class="space-y-3">
                @forelse($recentRegistrations as $reg)
                    <div class="p-3 rounded-2xl bg-stage-surface/70 border border-stage-border hover:border-gold-500/30 transition flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 rounded-full bg-stage-dark border border-stage-border flex items-center justify-center text-xs font-bold text-gold-400 flex-shrink-0">
                                {{ substr($reg->nama, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs font-semibold text-parchment-100 truncate">{{ $reg->nama }}</h4>
                                <p class="text-[10px] text-parchment-400 truncate">{{ $reg->kelas }} • Minat: {{ ucfirst($reg->divisi ?? 'Akting') }}</p>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold flex-shrink-0
                            {{ $reg->status === 'diterima' ? 'bg-emerald-950/60 text-emerald-400 border border-emerald-500/40' : ($reg->status === 'ditolak' ? 'bg-rose-950/60 text-rose-400 border border-rose-500/40' : 'bg-amber-950/60 text-amber-400 border border-amber-500/40') }}">
                            {{ ucfirst($reg->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-parchment-500 py-4 text-center">Belum ada pendaftaran terbaru.</p>
                @endforelse
            </div>
        </div>

        <!-- Widget 3: Reminder Operasional -->
        <div class="p-5 rounded-3xl bg-stage-card/80 border border-stage-border shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-stage-border pb-3">
                <h3 class="font-serif text-sm font-bold text-parchment-100 flex items-center gap-2">
                    <span>⚠️ Pengingat Operasional</span>
                </h3>
            </div>

            <!-- Tab / Sub-sections -->
            <div class="space-y-4">
                <!-- Pinjaman Properti -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-[11px] font-bold text-gold-400 uppercase tracking-wider">
                        <span>📦 Inventaris Dipinjam</span>
                        <a href="{{ route('admin.inventaris.index') }}" class="text-[10px] text-parchment-400 hover:text-white">Cek</a>
                    </div>
                    @forelse($unreturnedInventory as $loan)
                        <div class="p-2.5 rounded-xl bg-stage-dark/70 border border-amber-500/20 text-xs flex items-center justify-between gap-2">
                            <div class="min-w-0">
                                <p class="font-semibold text-parchment-200 truncate">{{ $loan->inventoryItem->nama_barang ?? 'Barang Properti' }}</p>
                                <p class="text-[10px] text-parchment-400 truncate">Oleh: {{ $loan->dipinjam_oleh }} ({{ $loan->jumlah_pinjam }} unit)</p>
                            </div>
                            <span class="text-[9px] px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 font-semibold flex-shrink-0">
                                Rencana: {{ $loan->tanggal_kembali_rencana ? $loan->tanggal_kembali_rencana->format('d/m') : '-' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-[11px] text-parchment-500 italic">Semua inventaris tersimpan di gudang.</p>
                    @endforelse
                </div>

                <!-- Komentar Menunggu -->
                <div class="space-y-2 pt-2 border-t border-stage-border/60">
                    <div class="flex items-center justify-between text-[11px] font-bold text-amber-400 uppercase tracking-wider">
                        <span>💬 Moderasi Komentar</span>
                        <a href="{{ route('admin.artikel.index') }}" class="text-[10px] text-parchment-400 hover:text-white">Cek</a>
                    </div>
                    @forelse($pendingComments as $com)
                        <div class="p-2.5 rounded-xl bg-stage-dark/70 border border-stage-border text-xs flex items-center justify-between gap-2">
                            <div class="min-w-0">
                                <p class="font-semibold text-parchment-200 truncate">{{ $com->nama_guest }}</p>
                                <p class="text-[10px] text-parchment-400 truncate">"{{ \Illuminate\Support\Str::limit($com->isi, 30) }}"</p>
                            </div>
                            <span class="text-[9px] px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 font-semibold flex-shrink-0">
                                Pending
                            </span>
                        </div>
                    @empty
                        <p class="text-[11px] text-parchment-500 italic">Tidak ada komentar menunggu verifikasi.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Chart.defaults.color = '#A89F91';
        Chart.defaults.borderColor = 'rgba(212, 175, 55, 0.08)';
        Chart.defaults.font.family = 'Poppins, Inter, sans-serif';

        // 1. Chart Registrations per Month
        const ctxReg = document.getElementById('chartRegistrations').getContext('2d');
        const gradientReg = ctxReg.createLinearGradient(0, 0, 0, 250);
        gradientReg.addColorStop(0, 'rgba(212, 175, 55, 0.35)');
        gradientReg.addColorStop(1, 'rgba(212, 175, 55, 0.0)');

        new Chart(ctxReg, {
            type: 'line',
            data: {
                labels: @json($regMonthsLabels),
                datasets: [{
                    label: 'Pendaftar Baru',
                    data: @json($regMonthsData),
                    borderColor: '#D4AF37',
                    backgroundColor: gradientReg,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#F1D77A',
                    pointBorderColor: '#0D0B0C',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // 2. Chart Performances Seats vs Sold
        const ctxPerf = document.getElementById('chartPerformances').getContext('2d');
        new Chart(ctxPerf, {
            type: 'bar',
            data: {
                labels: @json($perfLabels),
                datasets: [
                    {
                        label: 'Tiket Terjual',
                        data: @json($perfSoldData),
                        backgroundColor: '#D4AF37',
                        borderRadius: 6,
                    },
                    {
                        label: 'Kapasitas Kuota',
                        data: @json($perfQuotaData),
                        backgroundColor: 'rgba(139, 30, 45, 0.4)',
                        borderColor: '#8B1E2D',
                        borderWidth: 1,
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { boxWidth: 12, font: { size: 10 } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // 3. Chart Divisions Donut
        const ctxDiv = document.getElementById('chartDivisions').getContext('2d');
        new Chart(ctxDiv, {
            type: 'doughnut',
            data: {
                labels: @json($divisiLabels),
                datasets: [{
                    data: @json($divisiData),
                    backgroundColor: [
                        '#D4AF37', // Gold
                        '#8B1E2D', // Maroon
                        '#E07A5F', // Terra
                        '#3D405B', // Deep Blue
                        '#81B29A', // Sage
                        '#F2CC8F', // Parchment Gold
                    ],
                    borderColor: '#0D0B0C',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { boxWidth: 10, font: { size: 10 } }
                    }
                },
                cutout: '65%'
            }
        });

        // 4. Chart Top Articles Horizontal Bar
        const ctxArt = document.getElementById('chartArticles').getContext('2d');
        new Chart(ctxArt, {
            type: 'bar',
            data: {
                labels: @json($articleLabels),
                datasets: [{
                    label: 'Total Views',
                    data: @json($articleViewsData),
                    backgroundColor: 'rgba(212, 175, 55, 0.75)',
                    hoverBackgroundColor: '#D4AF37',
                    borderRadius: 6,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    });
</script>
@endpush
