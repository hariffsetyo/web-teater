@props([
    'name' => 'foto',
    'label' => 'Unggah Foto / Berkas Gambar',
    'current' => null,
])

<div
    x-data="{
        preview: '{{ $current ? asset($current) : '' }}',
        updatePreview(e) {
            const file = e.target.files[0];
            if (file) {
                this.preview = URL.createObjectURL(file);
            }
        }
    }"
    class="space-y-3"
>
    @if($label)
        <label class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
            {{ $label }}
        </label>
    @endif

    <div class="flex items-center gap-4">
        <!-- Preview Box -->
        <div class="w-24 h-24 rounded-2xl bg-stage-dark border border-stage-border overflow-hidden flex-shrink-0 flex items-center justify-center relative">
            <template x-if="preview">
                <img :src="preview" class="w-full h-full object-cover" />
            </template>
            <template x-if="!preview">
                <span class="text-2xl text-stage-muted">🖼️</span>
            </template>
        </div>

        <!-- Input File -->
        <div class="flex-1 space-y-1">
            <input
                type="file"
                name="{{ $name }}"
                @change="updatePreview($event)"
                accept="image/*"
                class="text-xs text-parchment-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gold-500 file:text-stage-black hover:file:bg-gold-400"
            />
            <p class="text-[11px] text-stage-muted">Format JPG, PNG, WEBP maks 5MB. Otomatis dipotong dan dioptimasi.</p>
        </div>
    </div>
</div>