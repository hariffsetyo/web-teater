<div>
    <!-- Navigation Mode Tabs -->
    <div class="flex items-center justify-center gap-3 mb-10">
        <button
            type="button"
            wire:click="$set('tabMode', 'daftar')"
            class="px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider transition-all {{ $tabMode === 'daftar' ? 'bg-gold-500 text-stage-black shadow-gold-glow' : 'bg-stage-card border border-stage-border text-parchment-300 hover:text-gold-400' }}"
        >
            🎭 Formulir Audisi Anggota
        </button>
        <button
            type="button"
            wire:click="$set('tabMode', 'cek_status')"
            class="px-6 py-2.5 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider transition-all {{ $tabMode === 'cek_status' ? 'bg-gold-500 text-stage-black shadow-gold-glow' : 'bg-stage-card border border-stage-border text-parchment-300 hover:text-gold-400' }}"
        >
            🔍 Cek Status Pendaftaran
        </button>
    </div>

    {{-- TAB 1: FORMULIR MULTI-STEP PENDAFTARAN --}}
    @if($tabMode === 'daftar')
        
        @if($registeredRecord)
            <!-- TAMPILAN SUKSES PENDAFTARAN -->
            <div class="max-w-2xl mx-auto card-theater p-8 sm:p-12 text-center border-gold-500/50 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-gold-500 via-maroon-600 to-gold-500"></div>

                <div class="w-20 h-20 mx-auto rounded-full bg-emerald-950/80 border border-emerald-500/50 flex items-center justify-center text-4xl mb-6 shadow-lg shadow-black/40">
                    🎉
                </div>

                <x-badge variant="gold" class="mb-3">PENDAFTARAN BERHASIL DISIMPAN</x-badge>
                <h3 class="font-serif text-3xl sm:text-4xl font-extrabold text-parchment-100 mb-2">
                    Selamat Datang di Balik Layar!
                </h3>
                <p class="text-xs sm:text-sm text-parchment-300 max-w-md mx-auto mb-8">
                    Data pendaftaran audisi Anda telah berhasil masuk ke antrean kurasi pengurus Teater Siklus.
                </p>

                <!-- Box Nomor Pendaftaran -->
                <div class="p-6 rounded-2xl bg-stage-dark border-2 border-gold-500/60 max-w-md mx-auto mb-8 shadow-inner">
                    <span class="text-xs uppercase tracking-widest text-parchment-300 block mb-1">Nomor Registrasi Anda</span>
                    <span class="font-serif font-black text-2xl sm:text-3xl text-gold-400 tracking-wider">
                        {{ $registeredRecord->nomor_pendaftaran }}
                    </span>
                    <p class="text-[11px] text-stage-muted mt-2">
                        Simpan nomor ini untuk mengecek status penerimaan audisi Anda.
                    </p>
                </div>

                <div class="text-left text-xs text-parchment-300 bg-stage-surface/60 p-5 rounded-xl border border-stage-border max-w-md mx-auto space-y-2 mb-8">
                    <div class="flex justify-between"><span>Nama:</span> <strong class="text-parchment-100">{{ $registeredRecord->nama }}</strong></div>
                    <div class="flex justify-between"><span>Pilihan Divisi:</span> <strong class="text-gold-400">{{ $registeredRecord->divisi_label }}</strong></div>
                    <div class="flex justify-between"><span>Status Saat Ini:</span> <span class="px-2 py-0.5 rounded bg-amber-950/80 text-amber-300 font-bold">Pending Kurasi</span></div>
                </div>

                <div class="flex flex-wrap justify-center gap-3">
                    <x-button type="button" wire:click="$set('tabMode', 'cek_status'); $set('searchIdentifier', '{{ $registeredRecord->nomor_pendaftaran }}'); checkStatus();" variant="primary" size="md">
                        Cek Status Sekarang 🔍
                    </x-button>
                    <x-button href="{{ route('home') }}" variant="outline" size="md">
                        Kembali ke Beranda
                    </x-button>
                </div>
            </div>

        @else
            <!-- WIZARD STEP CARD -->
            <div class="max-w-3xl mx-auto card-theater p-6 sm:p-10 border-gold-500/30 shadow-2xl relative">
                
                <!-- Step Indicator Header -->
                <div class="mb-10">
                    <div class="flex items-center justify-between relative">
                        <!-- Connecting Line -->
                        <div class="absolute left-6 right-6 top-1/2 -translate-y-1/2 h-0.5 bg-stage-border -z-0"></div>
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 h-0.5 bg-gold-500 -z-0 transition-all duration-500" style="width: {{ (($step - 1) / 2) * 90 }}%"></div>

                        <!-- Step 1 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold transition-all {{ $step >= 1 ? 'bg-gold-500 text-stage-black shadow-gold-glow' : 'bg-stage-dark border border-stage-border text-stage-muted' }}">
                                1
                            </div>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider mt-2 {{ $step >= 1 ? 'text-gold-400' : 'text-stage-muted' }}">Data Diri</span>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold transition-all {{ $step >= 2 ? 'bg-gold-500 text-stage-black shadow-gold-glow' : 'bg-stage-dark border border-stage-border text-stage-muted' }}">
                                2
                            </div>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider mt-2 {{ $step >= 2 ? 'text-gold-400' : 'text-stage-muted' }}">Divisi & Motivasi</span>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-xs font-bold transition-all {{ $step >= 3 ? 'bg-gold-500 text-stage-black shadow-gold-glow' : 'bg-stage-dark border border-stage-border text-stage-muted' }}">
                                3
                            </div>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider mt-2 {{ $step >= 3 ? 'text-gold-400' : 'text-stage-muted' }}">Upload & Review</span>
                        </div>
                    </div>
                </div>

                <!-- STEP 1: DATA DIRI -->
                @if($step === 1)
                    <div class="space-y-6">
                        <div class="border-b border-stage-border pb-4">
                            <h3 class="font-serif text-2xl font-bold text-parchment-100 flex items-center gap-2">
                                <span class="text-gold-400">✦</span> Langkah 1: Data Diri Calon Anggota
                            </h3>
                            <p class="text-xs text-parchment-300 mt-1">Masukkan informasi kontak aktif yang dapat dihubungi pengurus.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Nama Lengkap *</label>
                                <input type="text" wire:model.defer="nama" placeholder="Contoh: Arya Bimasakti" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500" />
                                @error('nama')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Nomor WhatsApp Aktif *</label>
                                <input type="tel" wire:model.defer="no_hp" placeholder="08xxxxxxxxxx" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500" />
                                @error('no_hp')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Alamat Email *</label>
                                <input type="email" wire:model.defer="email" placeholder="nama@email.com" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500" />
                                @error('email')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Kelas & Jurusan *</label>
                                <input type="text" wire:model.defer="kelas" placeholder="Contoh: X IPA 1 / XI IPS 2" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500" />
                                @error('kelas')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-stage-border">
                            <x-button type="button" wire:click="nextStep" variant="primary" size="md">
                                Lanjut: Divisi & Motivasi →
                            </x-button>
                        </div>
                    </div>
                @endif

                <!-- STEP 2: DIVISI & MOTIVASI -->
                @if($step === 2)
                    <div class="space-y-6">
                        <div class="border-b border-stage-border pb-4">
                            <h3 class="font-serif text-2xl font-bold text-parchment-100 flex items-center gap-2">
                                <span class="text-gold-400">✦</span> Langkah 2: Pilihan Divisi & Minat Teater
                            </h3>
                            <p class="text-xs text-parchment-300 mt-1">Pilih bidang panggung yang paling ingin Anda geluti dan kembangkan.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-3">Pilih Divisi Minat *</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($divisions as $key => $d)
                                    <label class="cursor-pointer p-4 rounded-xl border transition-all flex items-start gap-3 {{ $divisi === $key ? 'bg-maroon-900/60 border-gold-500 shadow-gold-glow/20' : 'bg-stage-dark border-stage-border hover:border-gold-500/40' }}">
                                        <input type="radio" wire:model="divisi" value="{{ $key }}" class="mt-1 text-gold-500 focus:ring-gold-500 bg-stage-dark border-stage-border">
                                        <div>
                                            <span class="font-serif font-bold text-sm block {{ $divisi === $key ? 'text-gold-400' : 'text-parchment-100' }}">{{ $d['label'] }}</span>
                                            <span class="text-[11px] text-parchment-300 leading-tight block mt-0.5">{{ $d['desc'] }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Alasan Mendaftar ke Teater *</label>
                            <textarea rows="3" wire:model.defer="alasan_daftar" placeholder="Apa yang mendorong Anda ingin menjadi bagian dari sanggar teater?" class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500"></textarea>
                            @error('alasan_daftar')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 mb-1.5">Harapan & Motivasi Berkarya</label>
                            <textarea rows="2" wire:model.defer="motivasi" placeholder="Ceritakan target atau pengalaman seni yang ingin Anda raih..." class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 focus:border-gold-500"></textarea>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-stage-border">
                            <x-button type="button" wire:click="prevStep" variant="outline" size="md">
                                ← Kembali
                            </x-button>
                            <x-button type="button" wire:click="nextStep" variant="primary" size="md">
                                Lanjut: Upload & Review →
                            </x-button>
                        </div>
                    </div>
                @endif

                <!-- STEP 3: UPLOAD AUDISI & REVIEW -->
                @if($step === 3)
                    <div class="space-y-6">
                        <div class="border-b border-stage-border pb-4">
                            <h3 class="font-serif text-2xl font-bold text-parchment-100 flex items-center gap-2">
                                <span class="text-gold-400">✦</span> Langkah 3: Upload Berkas & Review Pendaftaran
                            </h3>
                            <p class="text-xs text-parchment-300 mt-1">Periksa kembali data Anda dan lampirkan berkas karya jika ada (opsional).</p>
                        </div>

                        <!-- Upload File Audisi -->
                        <div class="p-5 rounded-2xl bg-stage-dark border border-dashed border-gold-500/40 space-y-3 text-center">
                            <span class="text-3xl block mb-1">🎬</span>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gold-400">
                                Upload File Audisi / Portofolio Karya (Opsional)
                            </label>
                            <p class="text-[11px] text-parchment-300 max-w-sm mx-auto">
                                Anda dapat mengunggah video monolog pendek, rekaman vokal, berkas naskah naskah drama (PDF), atau foto portofolio tata rias (Maks 20MB).
                            </p>
                            <input type="file" wire:model="file_audisi" class="text-xs text-parchment-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gold-500 file:text-stage-black hover:file:bg-gold-400" />
                            @error('file_audisi')<p class="text-xs text-rose-400 mt-1">{{ $message }}</p>@enderror
                            <div wire:loading wire:target="file_audisi" class="text-xs text-gold-400 italic">Mengunggah berkas audisi...</div>
                        </div>

                        <!-- Review Data Summary Box -->
                        <div class="p-6 rounded-2xl bg-stage-surface/70 border border-stage-border space-y-3">
                            <h4 class="font-serif font-bold text-base text-parchment-100 pb-2 border-b border-stage-border flex items-center justify-between">
                                <span>📋 Ringkasan Data Pendaftaran</span>
                                <span class="text-xs text-gold-400 font-sans cursor-pointer hover:underline" wire:click="$set('step', 1)">Edit Data</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-parchment-300">
                                <div><span class="text-stage-muted block">Nama Calon:</span> <strong class="text-parchment-100">{{ $nama }}</strong></div>
                                <div><span class="text-stage-muted block">WhatsApp:</span> <strong class="text-parchment-100">{{ $no_hp }}</strong></div>
                                <div><span class="text-stage-muted block">Email:</span> <strong class="text-parchment-100">{{ $email }}</strong></div>
                                <div><span class="text-stage-muted block">Kelas:</span> <strong class="text-parchment-100">{{ $kelas }}</strong></div>
                                <div class="sm:col-span-2 pt-2 border-t border-stage-border/60">
                                    <span class="text-stage-muted block">Pilihan Divisi:</span>
                                    <strong class="text-gold-400 text-sm">{{ $divisions[$divisi]['label'] ?? $divisi }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-stage-border">
                            <x-button type="button" wire:click="prevStep" variant="outline" size="md">
                                ← Kembali
                            </x-button>
                            <button
                                type="button"
                                wire:click="submitRegistration"
                                wire:loading.attr="disabled"
                                class="px-8 py-3.5 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 hover:from-gold-400 hover:to-gold-300 text-stage-black font-extrabold text-sm uppercase tracking-wider rounded-xl shadow-xl shadow-gold-500/20 hover:-translate-y-0.5 transition-all flex items-center gap-2"
                            >
                                <span wire:loading.remove wire:target="submitRegistration">Kirim Pendaftaran Audisi ✦</span>
                                <span wire:loading wire:target="submitRegistration">Menyimpan data...</span>
                            </button>
                        </div>
                    </div>
                @endif

            </div>
        @endif

    @endif

    {{-- TAB 2: CEK STATUS PENDAFTARAN --}}
    @if($tabMode === 'cek_status')
        <div class="max-w-2xl mx-auto card-theater p-8 sm:p-10 border-gold-500/30 shadow-2xl space-y-8">
            <div class="text-center space-y-2">
                <span class="text-3xl">🔍</span>
                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-parchment-100">
                    Cek Status Pendaftaran Audisi
                </h3>
                <p class="text-xs sm:text-sm text-parchment-300">
                    Masukkan nomor pendaftaran (contoh: <code>REG-2026-XXXX</code>) atau alamat email yang Anda gunakan saat mendaftar.
                </p>
            </div>

            <form wire:submit.prevent="checkStatus" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <input
                        type="text"
                        wire:model.defer="searchIdentifier"
                        placeholder="Contoh: REG-2026-ABCDE atau email@anda.com"
                        class="flex-1 bg-stage-dark border border-stage-border rounded-xl px-4 py-3 text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500"
                        required
                    />
                    <x-button type="submit" variant="primary" size="md">
                        Cek Status
                    </x-button>
                </div>
                @error('searchIdentifier')<p class="text-xs text-rose-400">{{ $message }}</p>@enderror
            </form>

            <!-- HASIL CEK STATUS -->
            @if($hasSearched)
                <div class="pt-6 border-t border-stage-border">
                    @if($checkResult)
                        @php
                            $statusStyle = [
                                'pending'  => ['bg' => 'bg-amber-950/80 border-amber-500/50 text-amber-300', 'icon' => '⏳', 'title' => 'Menunggu Kurasi Berkas'],
                                'diterima' => ['bg' => 'bg-emerald-950/80 border-emerald-500/50 text-emerald-300', 'icon' => '🎉', 'title' => 'Selamat, Anda Diterima!'],
                                'ditolak'  => ['bg' => 'bg-rose-950/80 border-rose-500/50 text-rose-300', 'icon' => '🎭', 'title' => 'Belum Lolos Musim Ini'],
                            ][$checkResult->status] ?? ['bg' => 'bg-stage-dark border-stage-border text-parchment-300', 'icon' => 'ℹ️', 'title' => 'Status'];
                        @endphp

                        <div class="p-6 rounded-2xl border {{ $statusStyle['bg'] }} space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">{{ $statusStyle['icon'] }}</span>
                                <div>
                                    <h4 class="font-serif text-lg font-bold">{{ $statusStyle['title'] }}</h4>
                                    <p class="text-xs opacity-80">Nomor Registrasi: <strong>{{ $checkResult->nomor_pendaftaran }}</strong></p>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-stage-black/50 text-xs space-y-1.5 text-parchment-200">
                                <div class="flex justify-between"><span>Nama:</span> <strong>{{ $checkResult->nama }}</strong></div>
                                <div class="flex justify-between"><span>Kelas:</span> <strong>{{ $checkResult->kelas }}</strong></div>
                                <div class="flex justify-between"><span>Divisi Peminatan:</span> <strong class="text-gold-400">{{ $checkResult->divisi_label }}</strong></div>
                                <div class="flex justify-between"><span>Waktu Mendaftar:</span> <span>{{ $checkResult->created_at->format('d M Y H:i') }}</span></div>
                            </div>

                            @if($checkResult->catatan_admin)
                                <div class="pt-2">
                                    <span class="text-[11px] font-bold uppercase tracking-wider block mb-1">Catatan dari Pengurus/Sutradara:</span>
                                    <p class="text-xs p-3 rounded-lg bg-black/40 italic leading-relaxed">
                                        "{{ $checkResult->catatan_admin }}"
                                    </p>
                                </div>
                            @endif
                        </div>
                    @else
                        <x-empty-state
                            title="Nomor / Email Tidak Ditemukan"
                            message="Tidak ditemukan data pendaftaran dengan nomor atau email tersebut. Pastikan Anda memasukkannya dengan benar."
                            icon="🔍"
                        />
                    @endif
                </div>
            @endif
        </div>
    @endif
</div>