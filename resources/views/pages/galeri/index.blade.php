<x-layouts.public title="Galeri & Rekaman Panggung — Teater Siklus">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[['label' => 'Galeri & Dokumentasi', 'url' => null]]" />

        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <x-badge variant="gold">✦ ARSIP VISUAL & SINEMATIK ✦</x-badge>
            <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                Galeri Lensa & <span class="text-gold-gradient gold-glow">Rekaman Pentas</span>
            </h1>
            <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                Jelajahi potret tata rias karakter, gladi panggung berpeluh, riuh tepuk tangan penonton, serta cuplikan video lakon yang menghidupkan teater kami.
            </p>
        </div>

        <livewire:gallery-list />

    </div>
</x-layouts.public>