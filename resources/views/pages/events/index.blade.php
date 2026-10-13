<x-layouts.public title="Agenda & Pementasan — Teater Siklus">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[['label' => 'Jadwal Pementasan & Agenda', 'url' => null]]" />

        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <x-badge variant="gold">✦ JADWAL & KALENDER PANGGUNG ✦</x-badge>
            <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                Pementasan, Gladi & <span class="text-gold-gradient gold-glow">Festival Seni</span>
            </h1>
            <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                Pantau seluruh linimasa lakon pementasan drama, sesi gladi resik olah tubuh, hingga keikutsertaan sanggar dalam festival tingkat regional dan nasional.
            </p>
        </div>

        <livewire:event-list />

    </div>
</x-layouts.public>