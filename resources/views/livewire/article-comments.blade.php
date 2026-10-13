<div class="space-y-8">
    <div class="flex items-center justify-between pb-4 border-b border-stage-border">
        <h3 class="font-serif text-2xl font-bold text-parchment-100 flex items-center gap-2">
            <span>💬</span> Ulasan & Komentar Pembaca ({{ $comments->count() }})
        </h3>
    </div>

    <!-- Alert Sukses Kirim Komentar -->
    @if($submitted)
        <div class="p-4 rounded-2xl bg-emerald-950/70 border border-emerald-500/40 text-emerald-300 text-sm flex items-start gap-3">
            <span class="text-2xl">🎭</span>
            <div class="space-y-1">
                <p class="font-semibold text-parchment-100">Komentar Berhasil Terkirim!</p>
                <p class="text-xs text-emerald-400/90 leading-relaxed">
                    Terima kasih atas tanggapan Anda. Komentar akan ditinjau dan disetujui oleh moderator admin sebelum ditampilkan ke publik.
                </p>
            </div>
        </div>
    @endif

    <!-- Form Kirim Komentar -->
    <div class="bg-stage-card border border-stage-border rounded-2xl p-6 sm:p-8">
        <h4 class="font-serif text-lg font-bold text-gold-400 mb-4 flex items-center gap-2">
            <span>✍️</span> Tinggalkan Tanggapan Anda
        </h4>

        <form wire:submit.prevent="submitComment" class="space-y-4">
            <!-- Honeypot anti-spam -->
            <div class="hidden">
                <input type="text" wire:model="trap" tabindex="-1" autocomplete="off">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">
                        Nama Lengkap
                    </label>
                    <input
                        type="text"
                        wire:model="nama_guest"
                        required
                        placeholder="Contoh: Rian Pratama"
                        class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500"
                    />
                    @error('nama_guest')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">
                        Alamat Email (Tidak Dipublikasikan)
                    </label>
                    <input
                        type="email"
                        wire:model="email_guest"
                        required
                        placeholder="email@anda.com"
                        class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500"
                    />
                    @error('email_guest')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">
                    Isi Tanggapan / Refleksi Naskah
                </label>
                <textarea
                    rows="3"
                    wire:model="isi"
                    required
                    placeholder="Tuliskan ulasan, pemikiran, atau apresiasi Anda terhadap artikel lakon ini..."
                    class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500"
                ></textarea>
                @error('isi')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end pt-2">
                <x-button type="submit" variant="primary" size="md">
                    Kirim Komentar ✦
                </x-button>
            </div>
        </form>
    </div>

    <!-- Approved Comments List -->
    <div class="space-y-4">
        @forelse($comments as $c)
            <div class="p-5 rounded-2xl bg-stage-card border border-stage-border space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-stage-surface border border-gold-500/30 flex items-center justify-center text-xs font-bold text-gold-400">
                            {{ strtoupper(substr($c->nama_guest, 0, 1)) }}
                        </span>
                        <h5 class="font-serif font-bold text-sm text-parchment-100">{{ $c->nama_guest }}</h5>
                    </div>
                    <span class="text-[11px] text-stage-muted">{{ $c->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs sm:text-sm text-parchment-200 leading-relaxed pl-10">
                    {{ $c->isi }}
                </p>
            </div>
        @empty
            <p class="text-center py-8 text-xs text-stage-muted italic">
                Belum ada komentar untuk artikel ini. Jadilah yang pertama memberikan apresiasi!
            </p>
        @endforelse
    </div>
</div>