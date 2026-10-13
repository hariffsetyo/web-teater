@props([
    'title' => 'Panggung Sedang Kosong',
    'message' => 'Belum ada data atau rekaman lakon yang sesuai dengan pencarian Anda.',
    'icon' => '🎭',
    'actionText' => null,
    'actionUrl' => null,
    'actionClick' => null,
])

<div class="py-16 px-6 text-center max-w-md mx-auto">
    <div class="w-20 h-20 mx-auto rounded-full bg-stage-surface/80 border border-gold-500/20 flex items-center justify-center text-4xl mb-4 shadow-lg shadow-black/40">
        {{ $icon }}
    </div>
    <h3 class="font-serif text-xl font-bold text-parchment-100 mb-2">
        {{ $title }}
    </h3>
    <p class="text-xs sm:text-sm text-parchment-300 leading-relaxed mb-6">
        {{ $message }}
    </p>
    @if($actionText && $actionUrl)
        <x-button href="{{ $actionUrl }}" variant="outline" size="sm">
            {{ $actionText }}
        </x-button>
    @elseif($actionText && $actionClick)
        <x-button type="button" @click="{{ $actionClick }}" variant="outline" size="sm">
            {{ $actionText }}
        </x-button>
    @endif
</div>