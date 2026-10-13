@if(session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-6 right-6 z-50 p-4 rounded-2xl bg-emerald-950/95 border border-emerald-500/50 text-emerald-200 text-sm shadow-2xl flex items-center gap-3 backdrop-blur-md"
    >
        <span class="text-xl">✅</span>
        <div>
            <p class="font-bold text-parchment-100">Aksi Berhasil</p>
            <p class="text-xs text-emerald-300">{{ session('success') }}</p>
        </div>
        <button type="button" @click="show = false" class="text-emerald-400 hover:text-white ml-2 text-xs">✕</button>
    </div>
@endif

@if(session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"
        class="fixed bottom-6 right-6 z-50 p-4 rounded-2xl bg-rose-950/95 border border-rose-500/50 text-rose-200 text-sm shadow-2xl flex items-center gap-3 backdrop-blur-md"
    >
        <span class="text-xl">⚠️</span>
        <div>
            <p class="font-bold text-parchment-100">Terjadi Kesalahan</p>
            <p class="text-xs text-rose-300">{{ session('error') }}</p>
        </div>
        <button type="button" @click="show = false" class="text-rose-400 hover:text-white ml-2 text-xs">✕</button>
    </div>
@endif