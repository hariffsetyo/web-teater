@props([
    'items' => [], // [['label' => 'Beranda', 'url' => route('home')], ['label' => 'Artikel', 'url' => null]]
])

<nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-xs text-parchment-300 mb-6 overflow-x-auto py-1">
    <a href="{{ route('home') }}" class="hover:text-gold-400 transition-colors flex items-center gap-1">
        <span>🏠</span>
        <span>Beranda</span>
    </a>
    @foreach($items as $item)
        <span class="text-gold-500/40">✦</span>
        @if(!empty($item['url']))
            <a href="{{ $item['url'] }}" class="hover:text-gold-400 transition-colors whitespace-nowrap">
                {{ $item['label'] }}
            </a>
        @else
            <span class="text-gold-400 font-medium whitespace-nowrap" aria-current="page">
                {{ $item['label'] }}
            </span>
        @endif
    @endforeach
</nav>