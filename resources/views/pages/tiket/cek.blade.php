<x-layouts.public title="Cek Tiket Saya — Teater Siklus">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[
            ['label' => 'Tiket Pementasan', 'url' => route('tiket.index')],
            ['label' => 'Cek Tiket Saya', 'url' => null]
        ]" />

        <div class="text-center space-y-3 mb-10">
            <span class="text-4xl">🔍</span>
            <h1 class="font-serif text-3xl sm:text-4xl font-extrabold text-parchment-100">
                Cari & Unduh Tiket Anda
            </h1>
            <p class="text-xs sm:text-sm text-parchment-300 max-w-md mx-auto">
                Masukkan kode tiket unik (contoh: <code>TKT-xxxx-xxxx</code>) atau alamat email yang Anda gunakan saat memesan tiket.
            </p>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('tiket.cek') }}" method="GET" class="card-theater p-6 rounded-2xl mb-10">
            <div class="flex flex-col sm:flex-row gap-3">
                <input
                    type="text"
                    name="q"
                    value="{{ $search }}"
                    placeholder="Contoh: TKT-2609-AB12 atau email@anda.com"
                    class="flex-1 bg-stage-dark border border-stage-border rounded-xl px-4 py-3 text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500"
                    required
                />
                <x-button type="submit" variant="primary" size="md">
                    Cari Tiket ✦
                </x-button>
            </div>
        </form>

        <!-- Hasil Pencarian -->
        @if($search)
            @if($ticket)
                <div class="space-y-6">
                    <div class="relative bg-stage-card border-2 border-gold-500/60 rounded-3xl overflow-hidden shadow-2xl">
                        <div class="bg-gradient-to-r from-maroon-900 via-maroon-800 to-maroon-900 px-6 py-3 border-b border-gold-500/40 flex items-center justify-between text-xs">
                            <span class="font-serif font-bold text-gold-400 tracking-widest uppercase">TIKET RESMI DITEMUKAN</span>
                            <span class="text-parchment-300 font-mono">{{ $ticket->kode_tiket }}</span>
                        </div>

                        <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                            <div class="md:col-span-8 space-y-4">
                                <h4 class="font-serif text-2xl font-bold text-parchment-100">
                                    {{ $ticket->performance->judul_pementasan }}
                                </h4>
                                <div class="grid grid-cols-2 gap-3 text-xs text-parchment-300">
                                    <div>
                                        <span class="text-stage-muted block text-[10px] uppercase">Waktu</span>
                                        <strong class="text-parchment-100">{{ $ticket->performance->event->tanggal_mulai ? $ticket->performance->event->tanggal_mulai->translatedFormat('d M Y, H:i') : '-' }} WIB</strong>
                                    </div>
                                    <div>
                                        <span class="text-stage-muted block text-[10px] uppercase">Lokasi</span>
                                        <strong class="text-parchment-100">{{ $ticket->performance->event->lokasi ?? 'Aula Utama Sekolah' }}</strong>
                                    </div>
                                    <div>
                                        <span class="text-stage-muted block text-[10px] uppercase">Pemesan</span>
                                        <strong class="text-parchment-100">{{ $ticket->nama }}</strong>
                                    </div>
                                    <div>
                                        <span class="text-stage-muted block text-[10px] uppercase">Jumlah Kursi</span>
                                        <strong class="text-gold-400 font-bold">{{ $ticket->jumlah_tiket }} Orang</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-4 md:border-l-2 md:border-dashed md:border-gold-500/40 md:pl-6 flex flex-col items-center text-center space-y-2 pt-4 md:pt-0 border-t md:border-t-0 border-dashed border-gold-500/40">
                                <div class="p-2 bg-white rounded-xl shadow-md">
                                    {!! $qrSvg !!}
                                </div>
                                <span class="font-mono text-xs font-bold text-gold-400">{{ $ticket->kode_tiket }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center pt-2">
                        <a
                            href="{{ route('tiket.download', $ticket->kode_tiket) }}"
                            class="px-8 py-3.5 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 text-stage-black font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-lg hover:shadow-gold-500/30 transition-all inline-flex items-center gap-2"
                        >
                            <span>📥</span>
                            <span>Unduh Berkas Tiket PDF</span>
                        </a>
                    </div>
                </div>
            @else
                <x-empty-state
                    title="Tiket Tidak Ditemukan"
                    message="Tidak ditemukan data reservasi tiket dengan kode atau email '{{ $search }}'. Silakan periksa kembali ketikan Anda."
                    icon="🔍"
                />
            @endif
        @endif

    </div>
</x-layouts.public>