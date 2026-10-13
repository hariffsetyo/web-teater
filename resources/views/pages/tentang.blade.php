<x-layouts.public title="Tentang Kami — Sejarah, Visi & Keluarga Sanggar">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Breadcrumb -->
        <x-breadcrumb :items="[['label' => 'Tentang Kami', 'url' => null]]" />

        <!-- Header Hero Halaman Tentang -->
        <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
            <x-badge variant="gold">
                ✦ PROFIL & DOKUMENTASI SANGGAR ✦
            </x-badge>
            <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl font-extrabold text-parchment-100 tracking-tight">
                Menghidupkan Jiwa di <span class="text-gold-gradient gold-glow">Panggung Sandiwara</span>
            </h1>
            <p class="text-base sm:text-lg text-parchment-300 leading-relaxed">
                Sanggar Teater Siklus adalah wadah ekstrakurikuler seni peran, eksplorasi lakon sastra, tata rias artistik, dan panggung musikalitas siswa SMA Negeri 1 yang telah berdiri sejak tahun 2018.
            </p>
        </div>

        <!-- Visi & Misi Sanggar Card Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-24">
            <!-- Visi -->
            <div class="card-theater p-8 relative overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-gold-500/10 border border-gold-500/30 flex items-center justify-center text-2xl mb-4 text-gold-400">
                    👁️
                </div>
                <h3 class="font-serif text-2xl font-bold text-parchment-100 mb-3">Visi Sanggar</h3>
                <p class="text-sm text-parchment-300 leading-relaxed">
                    Menjadi wadah ekspresi seni peran terkemuka yang mencetak insan muda berkarakter tangguh, kritis, berbudaya, serta mampu merefleksikan nilai-nilai kemanusiaan melalui kekuatan panggung sandiwara.
                </p>
            </div>

            <!-- Misi -->
            <div class="card-theater p-8 relative overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-maroon-800/40 border border-maroon-700/50 flex items-center justify-center text-2xl mb-4 text-maroon-300">
                    🎯
                </div>
                <h3 class="font-serif text-2xl font-bold text-parchment-100 mb-3">Misi Sanggar</h3>
                <ul class="text-sm text-parchment-300 space-y-2.5 list-disc list-inside">
                    <li>Mengembangkan teknik keaktoran metodis (Stanislavski & teater Nusantara).</li>
                    <li>Menumbuhkan kreativitas kepenulisan naskah drama yang berakar pada realitas sosial.</li>
                    <li>Mengasah keterampilan teknis tata panggung, tata rias efek, dan pencahayaan panggung.</li>
                    <li>Menghadirkan pementasan bermutu tinggi untuk masyarakat sekolah dan publik.</li>
                </ul>
            </div>
        </div>

        <!-- Sejarah: Timeline Vertikal Interaktif -->
        <div class="mb-28">
            <x-section-title
                subtitle="TAPAK TILAS"
                title="Perjalanan Dari Masa ke Masa"
                description="Rekam jejak dan tonggak penting pementasan yang telah mengukir nama Sanggar Teater Siklus."
            />

            <div class="relative max-w-4xl mx-auto">
                <!-- Vertical Line -->
                <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-gold-500 via-maroon-700 to-gold-500 transform md:-translate-x-1/2"></div>

                <!-- Timeline Items -->
                <div class="space-y-12">
                    
                    <!-- Item 1: 2018 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center">
                        <div class="md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0">
                            <span class="text-xs font-bold uppercase tracking-wider text-gold-400">Tahun 2018</span>
                            <h4 class="font-serif text-xl font-bold text-parchment-100 mt-1">Lahirnya Tirai Pertama</h4>
                            <p class="text-xs sm:text-sm text-parchment-300 mt-2 leading-relaxed">
                                Didirikan oleh 12 siswa perintis peminat sastra dan drama dengan pementasan perdana lakon pendek di panggung aula sekolah.
                            </p>
                        </div>
                        <div class="absolute left-2.5 md:left-1/2 top-1 md:top-auto w-4 h-4 rounded-full bg-gold-400 border-4 border-stage-black transform -translate-x-1/2 shadow-gold-glow"></div>
                        <div class="hidden md:block md:w-1/2 md:pl-12">
                            <span class="text-3xl">🌱</span>
                        </div>
                    </div>

                    <!-- Item 2: 2021 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center">
                        <div class="hidden md:block md:w-1/2 md:pr-12 md:text-right">
                            <span class="text-3xl">🎙️</span>
                        </div>
                        <div class="absolute left-2.5 md:left-1/2 top-1 md:top-auto w-4 h-4 rounded-full bg-maroon-600 border-4 border-stage-black transform -translate-x-1/2 shadow-maroon-glow"></div>
                        <div class="md:w-1/2 md:pl-12 pl-12">
                            <span class="text-xs font-bold uppercase tracking-wider text-gold-400">Tahun 2021</span>
                            <h4 class="font-serif text-xl font-bold text-parchment-100 mt-1">Era Drama Audio & Eksplorasi Digital</h4>
                            <p class="text-xs sm:text-sm text-parchment-300 mt-2 leading-relaxed">
                                Menghadapi keterbatasan panggung fisik, sanggar meluncurkan serial siniar drama audio yang berhasil didengarkan lebih dari 10.000 kali.
                            </p>
                        </div>
                    </div>

                    <!-- Item 3: 2023 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center">
                        <div class="md:w-1/2 md:pr-12 md:text-right pl-12 md:pl-0">
                            <span class="text-xs font-bold uppercase tracking-wider text-gold-400">Tahun 2023</span>
                            <h4 class="font-serif text-xl font-bold text-parchment-100 mt-1">Juara 1 Festival Seni Teater Pelajar</h4>
                            <p class="text-xs sm:text-sm text-parchment-300 mt-2 leading-relaxed">
                                Meraih penghargaan Sutradara Terbaik dan Pemeran Utama Pria Terbaik pada Festival Seni Drama Remaja tingkat Provinsi.
                            </p>
                        </div>
                        <div class="absolute left-2.5 md:left-1/2 top-1 md:top-auto w-4 h-4 rounded-full bg-gold-400 border-4 border-stage-black transform -translate-x-1/2 shadow-gold-glow"></div>
                        <div class="hidden md:block md:w-1/2 md:pl-12">
                            <span class="text-3xl">🏆</span>
                        </div>
                    </div>

                    <!-- Item 4: 2025 - Sekarang -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center">
                        <div class="hidden md:block md:w-1/2 md:pr-12 md:text-right">
                            <span class="text-3xl">✨</span>
                        </div>
                        <div class="absolute left-2.5 md:left-1/2 top-1 md:top-auto w-4 h-4 rounded-full bg-maroon-600 border-4 border-stage-black transform -translate-x-1/2 shadow-maroon-glow"></div>
                        <div class="md:w-1/2 md:pl-12 pl-12">
                            <span class="text-xs font-bold uppercase tracking-wider text-gold-400">2025 - Sekarang</span>
                            <h4 class="font-serif text-xl font-bold text-parchment-100 mt-1">Panggung Siklus Modern & Kolaborasi Lintas Seni</h4>
                            <p class="text-xs sm:text-sm text-parchment-300 mt-2 leading-relaxed">
                                Membina lebih dari 30 anggota aktif, mengoperasikan sistem ticketing digital mandiri, dan rutin mengadakan workshop bersama seniman teater nasional.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Dewan Pembina & Pengurus Inti -->
        <div class="mb-28">
            <x-section-title
                subtitle="STRUKTUR PENGURUS"
                title="Dewan Pembina & Pengarah Seni"
                description="Sosok-sosok berdedikasi di balik layar yang senantiasa membimbing proses kreatif sanggar."
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="card-theater p-6 text-center space-y-4">
                    <div class="w-24 h-24 mx-auto rounded-full bg-stage-surface border border-gold-500/40 p-1 flex items-center justify-center text-4xl shadow-md">
                        👨‍🏫
                    </div>
                    <div>
                        <h4 class="font-serif text-lg font-bold text-parchment-100">Drs. H. Bambang Suwito, M.Pd</h4>
                        <p class="text-xs text-gold-400 uppercase tracking-widest mt-0.5">Pembina Utama Ekstrakurikuler</p>
                    </div>
                    <p class="text-xs text-parchment-300 leading-relaxed">
                        Guru Bahasa & Sastra Indonesia dengan pengalaman lebih dari 20 tahun membina apresiasi sastra dan drama pelajar.
                    </p>
                </div>

                <div class="card-theater p-6 text-center space-y-4">
                    <div class="w-24 h-24 mx-auto rounded-full bg-stage-surface border border-gold-500/40 p-1 flex items-center justify-center text-4xl shadow-md">
                        🎭
                    </div>
                    <div>
                        <h4 class="font-serif text-lg font-bold text-parchment-100">Kinarya Anindita, S.Sn</h4>
                        <p class="text-xs text-gold-400 uppercase tracking-widest mt-0.5">Pelatih & Sutradara Tamu</p>
                    </div>
                    <p class="text-xs text-parchment-300 leading-relaxed">
                        Alumni Institut Seni Indonesia (ISI), aktif mengarahkan pertunjukan monolog dan workshop olah tubuh aktor muda.
                    </p>
                </div>

                <div class="card-theater p-6 text-center space-y-4">
                    <div class="w-24 h-24 mx-auto rounded-full bg-stage-surface border border-gold-500/40 p-1 flex items-center justify-center text-4xl shadow-md">
                        👑
                    </div>
                    <div>
                        <h4 class="font-serif text-lg font-bold text-parchment-100">Raden Danendra (XII IPA 1)</h4>
                        <p class="text-xs text-gold-400 uppercase tracking-widest mt-0.5">Ketua Umum Sanggar 2025/2026</p>
                    </div>
                    <p class="text-xs text-parchment-300 leading-relaxed">
                        Pemeran utama pementasan Sangkuriang 2024, mengoordinasikan seluruh divisi panggung dan persiapan gladi lakon.
                    </p>
                </div>
            </div>
        </div>

        <!-- Section: Kenali Pengurus & Anggota (Livewire) -->
        <div id="anggota" class="pt-8">
            <x-section-title
                subtitle="KELUARGA SANGGAR"
                title="Kenali Pemeran & Kru Teater"
                description="Temukan profil seluruh aktor, perias, penata cahaya, dan kru kreatif yang menghidupkan setiap detik di panggung kami."
            />

            <livewire:member-directory />
        </div>

    </div>

</x-layouts.public>