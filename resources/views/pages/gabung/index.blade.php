<x-layouts.public title="Pendaftaran Audisi Anggota Baru — Teater Siklus">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[['label' => 'Audisi & Pendaftaran Anggota Baru', 'url' => null]]" />

        <div class="text-center max-w-3xl mx-auto mb-12 space-y-4">
            <x-badge variant="gold">✦ AUDISI MUSIM PANGGUNG 2026 ✦</x-badge>
            <h1 class="font-serif text-4xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                Pintu Panggung <span class="text-gold-gradient gold-glow">Terbuka Untuk Anda</span>
            </h1>
            <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                Bergabunglah bersama keluarga Teater Siklus. Kembangkan rasa percaya diri, seni ekspresi peran, tata rias karakter, atau arsitektur tata panggung.
            </p>
        </div>

        <livewire:registration-wizard />

    </div>
</x-layouts.public>