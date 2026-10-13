<div>
    @if($confirmedTicket)
        <!-- VINTAGE THEATER E-TICKET DISPLAY -->
        <div class="max-w-2xl mx-auto space-y-6">
            <div class="text-center space-y-2 mb-6">
                <span class="text-4xl">🎟️</span>
                <x-badge variant="gold">RESERVASI BERHASIL DIKONFIRMASI</x-badge>
                <h3 class="font-serif text-3xl font-extrabold text-parchment-100">
                    Tiket Pementasan Anda Telah Siap
                </h3>
                <p class="text-xs text-parchment-300">
                    Tunjukkan e-tiket ini atau berkas PDF kepada petugas loket panggung saat registrasi masuk.
                </p>
            </div>

            <!-- Tiket Fisik Vintage (Sobekan Perforasi) -->
            <div class="relative bg-stage-card border-2 border-gold-500/60 rounded-3xl overflow-hidden shadow-2xl shadow-black/80">
                <!-- Golden Top Pelmet -->
                <div class="bg-gradient-to-r from-maroon-900 via-maroon-800 to-maroon-900 px-6 py-3 border-b border-gold-500/40 flex items-center justify-between text-xs">
                    <span class="font-serif font-bold text-gold-400 tracking-widest uppercase">TEATER SIKLUS • ADMIT ONE</span>
                    <span class="text-parchment-300 font-mono">{{ $confirmedTicket->kode_tiket }}</span>
                </div>

                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                    
                    <!-- Detail Pementasan (8 col) -->
                    <div class="md:col-span-8 space-y-4">
                        <div>
                            <span class="text-[10px] text-gold-400 font-semibold uppercase tracking-wider block mb-0.5">Lakon Pementasan</span>
                            <h4 class="font-serif text-2xl font-bold text-parchment-100">
                                {{ $confirmedTicket->performance->judul_pementasan }}
                            </h4>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-xs text-parchment-300">
                            <div>
                                <span class="text-stage-muted block text-[10px] uppercase">Tanggal & Waktu</span>
                                <strong class="text-parchment-100">
                                    {{ $confirmedTicket->performance->event->tanggal_mulai ? $confirmedTicket->performance->event->tanggal_mulai->translatedFormat('d M Y') : 'Segera' }}
                                </strong>
                                <p class="text-[11px]">{{ $confirmedTicket->performance->event->tanggal_mulai ? $confirmedTicket->performance->event->tanggal_mulai->format('H:i') : '15:30' }} WIB</p>
                            </div>
                            <div>
                                <span class="text-stage-muted block text-[10px] uppercase">Lokasi Panggung</span>
                                <strong class="text-parchment-100">
                                    {{ $confirmedTicket->performance->event->lokasi ?? 'Aula Utama Sekolah' }}
                                </strong>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-stage-border/70 grid grid-cols-2 gap-3 text-xs">
                            <div>
                                <span class="text-stage-muted block text-[10px] uppercase">Nama Pemesan</span>
                                <strong class="text-parchment-100">{{ $confirmedTicket->nama }}</strong>
                            </div>
                            <div>
                                <span class="text-stage-muted block text-[10px] uppercase">Jumlah Kursi</span>
                                <strong class="text-gold-400 font-bold text-sm">{{ $confirmedTicket->jumlah_tiket }} Orang</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Stub Sobekan & QR Code (4 col) -->
                    <div class="md:col-span-4 md:border-l-2 md:border-dashed md:border-gold-500/40 md:pl-6 flex flex-col items-center justify-center text-center space-y-3 pt-4 md:pt-0 border-t md:border-t-0 border-dashed border-gold-500/40">
                        <div class="p-2 bg-white rounded-xl shadow-md inline-block">
                            {!! $qrSvg !!}
                        </div>
                        <span class="font-mono text-xs font-bold text-gold-400 tracking-wider">
                            {{ $confirmedTicket->kode_tiket }}
                        </span>
                        <span class="text-[9px] text-stage-muted uppercase">Pindai di Meja Registrasi</span>
                    </div>

                </div>

                <!-- Perforation Notches on Sides -->
                <div class="hidden md:block absolute -left-3 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-stage-black border border-gold-500/50"></div>
                <div class="hidden md:block absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-stage-black border border-gold-500/50"></div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                <a
                    href="{{ route('tiket.download', $confirmedTicket->kode_tiket) }}"
                    class="px-6 py-3 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 text-stage-black font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-lg hover:shadow-gold-500/30 transition-all flex items-center gap-2"
                >
                    <span>📥</span>
                    <span>Unduh Tiket Resmi (PDF)</span>
                </a>

                <x-button href="{{ route('tiket.index') }}" variant="outline" size="md">
                    Lihat Pementasan Lain
                </x-button>
            </div>
        </div>

    @else
        <!-- FORMULIR RESERVASI TIKET -->
        <div class="max-w-xl mx-auto card-theater p-6 sm:p-8 border-gold-500/40 shadow-2xl relative">
            
            <div class="pb-5 border-b border-stage-border mb-6">
                <div class="flex items-center justify-between mb-2">
                    <x-badge variant="gold">
                        {{ $performance->harga_tiket ? 'Rp ' . number_format($performance->harga_tiket, 0, ',', '.') : 'TIKET GRATIS' }}
                    </x-badge>
                    <span class="text-xs text-parchment-300">
                        Sisa Kuota: <strong class="text-gold-400">{{ $sisaKursi }}</strong> / {{ $performance->kuota_kursi }} Kursi
                    </span>
                </div>
                <h3 class="font-serif text-2xl font-bold text-parchment-100">
                    Formulir Reservasi Kursi Penonton
                </h3>
                <p class="text-xs text-parchment-300 mt-1">
                    Lakon: <strong>{{ $performance->judul_pementasan }}</strong>
                </p>
            </div>

            @if($errorMessage)
                <div class="mb-5 p-4 rounded-xl bg-rose-950/80 border border-rose-500/50 text-rose-300 text-xs">
                    {{ $errorMessage }}
                </div>
            @endif

            @if($sisaKursi <= 0)
                <div class="text-center py-8 space-y-3">
                    <span class="text-4xl block">🚫</span>
                    <h4 class="font-serif text-xl font-bold text-parchment-100">Kursi Telah Habis Terpesan</h4>
                    <p class="text-xs text-parchment-300">Mohon maaf, seluruh kuota tempat duduk pementasan ini telah terisi penuh.</p>
                </div>
            @else
                <form wire:submit.prevent="reserveTicket" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Nama Lengkap Pemesan *</label>
                        <input type="text" wire:model.defer="nama" required placeholder="Contoh: Budi Santoso" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500" />
                        @error('nama')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Email Pengiriman *</label>
                            <input type="email" wire:model.defer="email" required placeholder="budi@email.com" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500" />
                            @error('email')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Nomor WhatsApp *</label>
                            <input type="tel" wire:model.defer="no_hp" required placeholder="08xxxxxxxxxx" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500" />
                            @error('no_hp')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Jumlah Tiket (1 - 4) -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-2">Jumlah Kursi yang Dipesan *</label>
                        <div class="grid grid-cols-4 gap-3">
                            @foreach([1, 2, 3, 4] as $qty)
                                <label class="cursor-pointer p-3 rounded-xl border text-center transition-all {{ $jumlah_tiket == $qty ? 'bg-gold-500 text-stage-black font-extrabold border-gold-400 shadow-gold-glow/20' : 'bg-stage-dark border-stage-border text-parchment-200 hover:border-gold-500/40' }}">
                                    <input type="radio" wire:model="jumlah_tiket" value="{{ $qty }}" class="sr-only">
                                    <span class="text-base">{{ $qty }}</span>
                                    <span class="text-[10px] block opacity-80">Tiket</span>
                                </label>
                            @endforeach
                        </div>
                        @error('jumlah_tiket')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-4 border-t border-stage-border flex items-center justify-between">
                        <x-button href="{{ route('tiket.index') }}" variant="ghost" size="sm">
                            ← Batal
                        </x-button>
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="px-8 py-3 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 hover:from-gold-400 hover:to-gold-300 text-stage-black font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-lg hover:shadow-gold-500/30 transition-all flex items-center gap-2"
                        >
                            <span wire:loading.remove wire:target="reserveTicket">Konfirmasi & Terbitkan Tiket 🎟️</span>
                            <span wire:loading wire:target="reserveTicket">Memproses kursi...</span>
                        </button>
                    </div>
                </form>
            @endif

        </div>
    @endif
</div>