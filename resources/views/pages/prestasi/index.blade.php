<x-layouts.public title="Prestasi & Penghargaan — Teater Siklus">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[['label' => 'Prestasi & Rekam Jejak', 'url' => null]]" />

        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <x-badge variant="gold">✦ ETALASE TROFI & KEJUARAAN ✦</x-badge>
            <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                Piala, Karya & <span class="text-gold-gradient gold-glow">Rekam Jejak Juara</span>
            </h1>
            <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                Setiap keringat di ruang gladi dan penghayatan peran berbuah manis. Berikut catatan piala festival teater, monolog, dan penulisan naskah yang berhasil dipersembahkan bagi sekolah.
            </p>
        </div>

        <livewire:achievement-list />

    </div>
</x-layouts.public>