<x-layouts.public title="Kuis: Kamu Cocok di Divisi Teater Mana? — Teater Siklus">
    
    <div
        x-data="{
            step: 0, // 0 = start screen, 1..7 = questions, 8 = result
            scores: {
                akting: 0,
                naskah: 0,
                tata_rias: 0,
                tata_panggung: 0,
                musik: 0,
                humas: 0
            },
            questions: [
                {
                    q: 'Saat menyaksikan sebuah pementasan drama atau film, apa yang pertama kali paling menarik perhatianmu?',
                    options: [
                        { text: 'Sorot mata, intonasi suara, dan ledakan emosi para pemeran di atas panggung.', div: 'akting' },
                        { text: 'Alur cerita yang tak terduga, dialog cerdas, dan pesan filosofis di baliknya.', div: 'naskah' },
                        { text: 'Detail riasan wajah, gaya rambut, dan kemegahan busana para karakter.', div: 'tata_rias' },
                        { text: 'Tata letak panggung, efek pencahayaan spektakuler, dan pergantian set dekorasi.', div: 'tata_panggung' },
                        { text: 'Dentuman musik latar dan efek suara yang membangun ketegangan adegan.', div: 'musik' },
                        { text: 'Keriuhan penonton, desain poster promosi, dan antusiasme orang-orang di lobi.', div: 'humas' }
                    ]
                },
                {
                    q: 'Jika kamu diberikan waktu luang di ruang sanggar seni, apa aktivitas yang paling kamu sukai?',
                    options: [
                        { text: 'Berlatih monolog di depan cermin besar dan mengeksplorasi ragam ekspresi wajah.', div: 'akting' },
                        { text: 'Menulis coretan cerita pendek, puisi, atau skenario drama di buku catatan.', div: 'naskah' },
                        { text: 'Mencoba teknik riasan wajah baru, face painting, atau mencocokkan kain kostum.', div: 'tata_rias' },
                        { text: 'Membuat miniatur panggung, mengecat properti, atau mengatur sakelar lampu.', div: 'tata_panggung' },
                        { text: 'Mendengarkan rekaman instrumen musik akustik atau merancang efek bunyi buatan.', div: 'musik' },
                        { text: 'Membuat konten video kreatif untuk media sosial atau berbincang dengan teman baru.', div: 'humas' }
                    ]
                },
                {
                    q: 'Apa kekuatan kepribadian terbesarmu saat bekerja dalam satu tim produksi?',
                    options: [
                        { text: 'Percaya diri tinggi, ekspresif, dan tidak canggung menjadi pusat perhatian.', div: 'akting' },
                        { text: 'Pengamat yang peka, imajinatif, dan mampu menuangkan ide ke dalam kata-kata.', div: 'naskah' },
                        { text: 'Teliti pada detail estetika visual, sabar, dan memiliki cita rasa keindahan yang tinggi.', div: 'tata_rias' },
                        { text: 'Praktikal, solutif saat menghadapi masalah teknis lapangan, dan cekatan.', div: 'tata_panggung' },
                        { text: 'Peka terhadap ritme suasana, memiliki telinga musikal, dan mampu memicu emosi lewat audio.', div: 'musik' },
                        { text: 'Pandai berkomunikasi, supel, dan piawai meyakinkan orang lain.', div: 'humas' }
                    ]
                },
                {
                    q: 'Ketika ada gladi resik menjelang hari pementasan akbar, peran apa yang paling kamu sukai?',
                    options: [
                        { text: 'Meresapi karakter lakon sampai benar-benar menyatu dengan jiwa sang tokoh.', div: 'akting' },
                        { text: 'Duduk di samping sutradara memeriksa ketepatan cue dialog dan ritme cerita.', div: 'naskah' },
                        { text: 'Menyiapkan palet rias, kuas, dan memeriksa kerapian busana pemeran utama.', div: 'tata_rias' },
                        { text: 'Memastikan lampu spotlight tepat sasaran dan posisi properti aman di panggung.', div: 'tata_panggung' },
                        { text: 'Menjaga timing instrumen pengiring agar masuk tepat pada detik puncak klimaks.', div: 'musik' },
                        { text: 'Menyambut tamu undangan, mengarahkan penonton, dan mengelola media peliputan.', div: 'humas' }
                    ]
                },
                {
                    q: 'Buku atau tontonan apa yang paling sering membuatmu betah berjam-jam?',
                    options: [
                        { text: 'Biografi aktor legendaris atau video bedah akting metode teater dunia.', div: 'akting' },
                        { text: 'Novel sastra klasik, naskah drama sandiwara, atau antologi cerpen.', div: 'naskah' },
                        { text: 'Tutorial seni tata rias efek khusus (SFX), sejarah mode, dan fesyen teater.', div: 'tata_rias' },
                        { text: 'Dokumenter arsitektur tata panggung Broadway atau desain pencahayaan panggung konser.', div: 'tata_panggung' },
                        { text: 'Original Soundtrack film sinematik dan komposisi orkestra simfoni.', div: 'musik' },
                        { text: 'Strategi kampanye kreatif, public speaking, dan tren media digital terkini.', div: 'humas' }
                    ]
                },
                {
                    q: 'Apa impian terbesarmu saat pementasan selesai dan tirai panggung ditutup?',
                    options: [
                        { text: 'Mendengar tepuk tangan meriah sambil membungkuk memberi hormat di hadapan penonton.', div: 'akting' },
                        { text: 'Melihat penonton pulang dengan pikiran terbuka dan terharu oleh makna cerita yang kutulis.', div: 'naskah' },
                        { text: 'Melihat karakter yang kurias tampak begitu hidup dan meyakinkan di bawah sorot lampu.', div: 'tata_rias' },
                        { text: 'Merasa bangga karena panggung megah yang kurancang berdiri kokoh tanpa cela teknis.', div: 'tata_panggung' },
                        { text: 'Melihat penonton menitikkan air mata karena hanyut oleh lantunan musik yang kubawakan.', div: 'musik' },
                        { text: 'Melihat gedung pementasan penuh sesak dan semua tiket habis terjual (sold out).', div: 'humas' }
                    ]
                }
            ],
            divisionDetails: {
                akting: {
                    name: 'Divisi Akting & Karakterisasi',
                    icon: '🎭',
                    title: 'Sang Jiwa di Balik Tirai (Aktor Panggung)',
                    desc: 'Kamu memiliki bakat alami dalam mengekspresikan emosi, empati mendalam pada karakter orang lain, dan keberanian berdiri di depan sorot lampu spotlight. Panggung adalah kanvasmu untuk menghidupkan jiwa tokoh-tokoh dramatik.',
                    skills: ['Penghayatan Karakter', 'Olah Vokal & Artikulasi', 'Bahasa Tubuh & Gestur', 'Improvisasi Lakon']
                },
                naskah: {
                    name: 'Divisi Penulisan Naskah',
                    icon: '📜',
                    title: 'Sang Arsitek Kata & Dramaturgi',
                    desc: 'Kamu adalah pemikir konseptual yang mampu melihat makna di balik setiap peristiwa. Kamu memiliki kepekaan rasa dan ketajaman dialog yang menjadi fondasi utama seluruh karya pementasan di sanggar teater.',
                    skills: ['Struktur Tiga Babak', 'Pembangunan Konflik', 'Dramaturgi Lakon', 'Adaptasi Sastra']
                },
                tata_rias: {
                    name: 'Divisi Tata Rias & Busana',
                    icon: '💄',
                    title: 'Sang Maestro Visual & Wajah Karakter',
                    desc: 'Kamu memiliki kepekaan visual yang magis. Di tanganmu, pemeran biasa bisa bertransformasi menjadi sosok monster kuno, kakek renta bijaksana, hingga bangsawan megah dengan kostum yang memikat.',
                    skills: ['Special Effects (SFX) Makeup', 'Karakterisasi Usia', 'Desain Kostum', 'Aksesoris Artistik']
                },
                tata_panggung: {
                    name: 'Divisi Tata Panggung & Cahaya',
                    icon: '🎪',
                    title: 'Sang Pembangun Dunia & Tata Cahaya',
                    desc: 'Kamu adalah kreator tangguh yang merancang atmosfer fisik sebuah karya. Dari sudut gelap hingga kilau cahaya lampu dramatik, kamulah yang mewujudkan dunia imajinasi naskah menjadi kenyataan nyata di atas lantai kayu panggung.',
                    skills: ['Lighting Cue & Desain Cahaya', 'Konstruksi Set Panggung', 'Properti Simbolik', 'Manajemen Panggung']
                },
                musik: {
                    name: 'Divisi Musik & Tata Suara',
                    icon: '🎻',
                    title: 'Sang Penyentuh Rasa & Ilustrasi Audio',
                    desc: 'Kamu memahami kekuatan frekuensi bunyi yang mampu menggetarkan nurani. Tanpa musik dan efek suaramu, pementasan akan kehilangan denyut nadinya. Kamu adalah dirigen emosi para penonton.',
                    skills: ['Scoring Latar Emosional', 'Efek Bunyi (Foley Sound)', 'Komposisi Lagu Tema', 'Live Audio Scoring']
                },
                humas: {
                    name: 'Divisi Humas & Dokumentasi',
                    icon: '📸',
                    title: 'Sang Duta Panggung & Jembatan Publik',
                    desc: 'Kamu adalah nyawa komunikasi sanggar dengan dunia luar. Enerjik, komunikatif, dan kreatif dalam menyebarkan warta karya. Berkat sentuhanmu, kursi gedung teater selalu dipenuhi penonton yang terpukau.',
                    skills: ['Manajemen Tiket & Audiens', 'Publikasi Sinematik', 'Desain Poster Promosi', 'Hubungan Media']
                }
            },
            resultKey: null,
            chooseOption(div) {
                this.scores[div]++;
                if (this.step < this.questions.length) {
                    this.step++;
                } else {
                    this.calculateResult();
                }
            },
            calculateResult() {
                let max = -1;
                let best = 'akting';
                for (let k in this.scores) {
                    if (this.scores[k] > max) {
                        max = this.scores[k];
                        best = k;
                    }
                }
                this.resultKey = best;
                this.step = this.questions.length + 1;
            },
            restart() {
                for (let k in this.scores) this.scores[k] = 0;
                this.step = 0;
                this.resultKey = null;
            }
        }"
        class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10"
    >
        <x-breadcrumb :items="[['label' => 'Kuis Minat Teater', 'url' => null]]" />

        <!-- SCREEN 0: INTRO SCREEN -->
        <div x-show="step === 0" class="text-center max-w-2xl mx-auto space-y-6 card-theater p-8 sm:p-12 border-gold-500/40 shadow-2xl">
            <span class="text-5xl block animate-bounce">🎭</span>
            <x-badge variant="gold">✦ KUIS INTERAKTIF MINAT SENI ✦</x-badge>
            <h1 class="font-serif text-3xl sm:text-5xl font-extrabold text-parchment-100 tracking-tight">
                Kamu Cocok di Divisi Teater Mana?
            </h1>
            <p class="text-sm sm:text-base text-parchment-300 leading-relaxed">
                Jawab 6 pertanyaan reflektif berikut untuk menemukan potensi panggung terpendammu. Apakah kamu terlahir menjadi Aktor Utama, Penulis Lakon Filosofis, atau Perancang Tata Panggung Megah?
            </p>

            <div class="pt-4">
                <button
                    type="button"
                    @click="step = 1"
                    class="px-8 py-4 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 text-stage-black font-extrabold text-sm uppercase tracking-wider rounded-xl shadow-xl hover:shadow-gold-500/30 hover:scale-105 active:scale-95 transition-all"
                >
                    Mulai Kuis Sekarang ✦
                </button>
            </div>
        </div>

        <!-- SCREEN 1..6: QUESTIONS -->
        <template x-for="(qItem, qIdx) in questions" :key="qIdx">
            <div x-show="step === (qIdx + 1)" class="card-theater p-6 sm:p-10 border-gold-500/30 shadow-2xl space-y-6">
                <!-- Progress Header -->
                <div class="flex items-center justify-between text-xs text-parchment-300 pb-4 border-b border-stage-border">
                    <span class="font-semibold uppercase tracking-wider text-gold-400">
                        Pertanyaan <span x-text="qIdx + 1"></span> dari <span x-text="questions.length"></span>
                    </span>
                    <div class="w-32 h-2 rounded-full bg-stage-dark overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-maroon-600 to-gold-400 transition-all duration-300" :style="`width: ${((qIdx + 1) / questions.length) * 100}%`"></div>
                    </div>
                </div>

                <!-- Question Text -->
                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-parchment-100 leading-snug" x-text="qItem.q"></h3>

                <!-- Options Grid -->
                <div class="space-y-3 pt-2">
                    <template x-for="(opt, optIdx) in qItem.options" :key="optIdx">
                        <button
                            type="button"
                            @click="chooseOption(opt.div)"
                            class="w-full text-left p-4 rounded-xl bg-stage-dark hover:bg-gold-500/10 border border-stage-border hover:border-gold-500/60 text-parchment-200 hover:text-gold-300 text-xs sm:text-sm font-medium transition-all duration-200 flex items-start gap-3 group"
                        >
                            <span class="w-6 h-6 rounded-full bg-stage-surface border border-stage-border group-hover:border-gold-400 group-hover:bg-gold-500 group-hover:text-stage-black flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5" x-text="String.fromCharCode(65 + optIdx)"></span>
                            <span class="leading-relaxed" x-text="opt.text"></span>
                        </button>
                    </template>
                </div>
            </div>
        </template>

        <!-- SCREEN RESULT: HASIL DIVISI -->
        <div x-show="step === (questions.length + 1) && resultKey !== null" x-cloak class="card-theater p-8 sm:p-12 border-2 border-gold-500/60 rounded-3xl shadow-2xl relative overflow-hidden text-center space-y-6">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-maroon-800 via-gold-500 to-maroon-800"></div>

            <span class="text-6xl block mb-2" x-text="divisionDetails[resultKey] ? divisionDetails[resultKey].icon : '🎭'"></span>
            
            <x-badge variant="gold">HASIL ANALISIS BAKAT PANGGUNG</x-badge>

            <h2 class="font-serif text-3xl sm:text-5xl font-black text-parchment-100" x-text="divisionDetails[resultKey] ? divisionDetails[resultKey].title : ''"></h2>

            <div class="inline-block px-4 py-1.5 rounded-full bg-maroon-900/80 border border-gold-500/40 text-gold-300 text-xs font-bold uppercase tracking-widest" x-text="divisionDetails[resultKey] ? divisionDetails[resultKey].name : ''"></div>

            <p class="text-sm sm:text-base text-parchment-200 max-w-2xl mx-auto leading-relaxed" x-text="divisionDetails[resultKey] ? divisionDetails[resultKey].desc : ''"></p>

            <!-- Keahlian yang Cocok -->
            <div class="p-5 rounded-2xl bg-stage-dark border border-stage-border max-w-xl mx-auto text-left space-y-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-gold-400 block">Keahlian yang akan kamu asah:</span>
                <div class="flex flex-wrap gap-2">
                    <template x-for="(sk, sIdx) in (divisionDetails[resultKey] ? divisionDetails[resultKey].skills : [])" :key="sIdx">
                        <span class="text-xs px-3 py-1 rounded-lg bg-stage-surface border border-gold-500/20 text-parchment-100" x-text="sk"></span>
                    </template>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                <a
                    :href="'{{ route('gabung') }}?divisi=' + resultKey"
                    class="px-8 py-4 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 hover:from-gold-400 text-stage-black font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-xl shadow-gold-500/30 hover:scale-105 active:scale-95 transition-all flex items-center gap-2"
                >
                    <span>Daftar Audisi dengan Divisi Ini 🎭</span>
                    <span>→</span>
                </a>

                <button
                    type="button"
                    @click="
                        if (navigator.share) {
                            navigator.share({
                                title: 'Hasil Kuis Teater Siklus',
                                text: 'Saya cocok di ' + divisionDetails[resultKey].name + '! Coba kuis minat panggung teater ini!',
                                url: window.location.href
                            });
                        } else {
                            navigator.clipboard.writeText(window.location.href);
                            alert('Tautan kuis berhasil disalin ke clipboard!');
                        }
                    "
                    class="px-6 py-4 rounded-xl bg-stage-dark border border-gold-500/30 hover:border-gold-400 text-gold-400 text-xs font-semibold uppercase tracking-wider transition-colors flex items-center gap-2"
                >
                    <span>📢 Bagikan Hasil</span>
                </button>

                <button
                    type="button"
                    @click="restart()"
                    class="px-5 py-4 rounded-xl text-xs text-parchment-300 hover:text-gold-400 transition-colors"
                >
                    Ulangi Kuis ↺
                </button>
            </div>
        </div>

    </div>

</x-layouts.public>