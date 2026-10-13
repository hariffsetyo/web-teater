<div
    x-data="{
        open: false,
        actionUrl: '',
        itemName: '',
        openModal(url, name) {
            this.actionUrl = url;
            this.itemName = name || 'item ini';
            this.open = true;
        },
        closeModal() {
            this.open = false;
        }
    }"
    @open-delete-modal.window="openModal($event.detail.url, $event.detail.name)"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stage-black/80 backdrop-blur-sm"
>
    <div class="relative w-full max-w-md bg-stage-card border border-rose-500/40 rounded-3xl p-6 sm:p-8 text-center shadow-2xl space-y-4">
        <div class="w-16 h-16 mx-auto rounded-full bg-rose-950/80 border border-rose-500/40 flex items-center justify-center text-3xl">
            🗑️
        </div>
        
        <h3 class="font-serif text-xl font-bold text-parchment-100">
            Konfirmasi Hapus Data
        </h3>

        <p class="text-xs sm:text-sm text-parchment-300">
            Apakah Anda yakin ingin menghapus <strong class="text-gold-400" x-text="itemName"></strong>? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
        </p>

        <form :action="actionUrl" method="POST" class="pt-4 flex items-center justify-center gap-3">
            @csrf
            @method('DELETE')
            <button
                type="button"
                @click="closeModal()"
                class="px-5 py-2.5 rounded-xl bg-stage-surface border border-stage-border text-parchment-300 hover:text-white text-xs font-semibold"
            >
                Batal
            </button>
            <button
                type="submit"
                class="px-6 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-600 text-white text-xs font-bold shadow-lg shadow-rose-900/40"
            >
                Ya, Hapus Permanen
            </button>
        </form>
    </div>
</div>