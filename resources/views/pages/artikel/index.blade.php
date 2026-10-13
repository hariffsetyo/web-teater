<x-layouts.public title="Khazanah Artikel & Dramaturgi — Teater Siklus">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[['label' => 'Artikel & Wawasan Teater', 'url' => null]]" />

        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <x-badge variant="gold">✦ KHAZANAH KATA & LAKON ✦</x-badge>
            <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                Warta, Esai & <span class="text-gold-gradient gold-glow">Dramaturgi Seni</span>
            </h1>
            <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                Kumpulan pemikiran keaktoran, sejarah sandiwara klasik Nusantara, tips mengatasi demam panggung, hingga catatan reflektif di balik setiap naskah pementasan.
            </p>
        </div>

        <livewire:article-list />

    </div>
</x-layouts.public>