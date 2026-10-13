<div>
    @if ($subscribed)
        <div class="p-4 bg-emerald-950/60 border border-emerald-500/40 rounded-xl text-emerald-300 text-sm flex items-center gap-3">
            <span class="text-xl">🎭</span>
            <div>
                <p class="font-semibold text-parchment-100">Terima kasih telah bergabung!</p>
                <p class="text-xs text-emerald-400/80">Anda akan menerima kabar pementasan dan agenda terbaru kami.</p>
            </div>
        </div>
    @else
        <form wire:submit.prevent="subscribe" class="space-y-3">
            <div class="flex flex-col sm:flex-row gap-2">
                <div class="relative flex-1">
                    <input
                        type="email"
                        wire:model="email"
                        placeholder="Masukkan alamat email Anda..."
                        class="w-full bg-stage-dark/90 dark:bg-stage-dark/90 bg-white border border-stage-border dark:border-stage-border border-parchment-300 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 rounded-lg px-4 py-3 text-sm text-parchment-100 dark:text-parchment-100 text-stage-black placeholder-stage-muted/60 transition-colors"
                        required
                    />
                    <div wire:loading wire:target="subscribe" class="absolute right-3 top-3.5">
                        <svg class="animate-spin h-5 w-5 text-gold-400" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="px-6 py-3 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 hover:from-gold-400 hover:to-gold-300 text-stage-black font-semibold text-sm rounded-lg shadow-md hover:shadow-gold-500/25 transition-all duration-200 flex items-center justify-center gap-2 whitespace-nowrap"
                >
                    <span>Berlangganan</span>
                    <span>✦</span>
                </button>
            </div>
            @error('email')
                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </form>
    @endif
</div>