@props([
    'variant' => 'primary', // primary, outline, ghost, maroon
    'size' => 'md', // sm, md, lg
    'href' => null,
    'icon' => null,
    'iconRight' => null,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-300 rounded-lg tracking-wide focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-500 disabled:opacity-50 disabled:cursor-not-allowed group';

$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-xs gap-1.5',
    'md' => 'px-5 py-2.5 text-sm gap-2',
    'lg' => 'px-7 py-3.5 text-base gap-2.5 font-semibold',
][$size] ?? 'px-5 py-2.5 text-sm gap-2';

$variantClasses = [
    'primary' => 'bg-gradient-to-r from-gold-500 via-gold-400 to-gold-500 hover:from-gold-400 hover:to-gold-300 text-stage-black shadow-lg shadow-gold-500/20 hover:shadow-gold-500/40 hover:-translate-y-0.5 active:translate-y-0 font-semibold',
    'outline' => 'border border-gold-500/60 hover:border-gold-400 text-gold-400 hover:text-gold-300 bg-transparent hover:bg-gold-500/10 shadow-sm hover:shadow-gold-500/20',
    'ghost' => 'text-parchment-200 hover:text-gold-400 bg-transparent hover:bg-gold-500/10',
    'maroon' => 'bg-gradient-to-r from-maroon-800 via-maroon-700 to-maroon-800 hover:from-maroon-700 hover:to-maroon-600 text-parchment-100 border border-maroon-600/50 shadow-lg shadow-maroon-900/40 hover:-translate-y-0.5',
    'danger' => 'bg-red-700 hover:bg-red-600 text-white shadow-md',
][$variant] ?? 'bg-gold-500 text-stage-black';

$classes = "$baseClasses $sizeClasses $variantClasses";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <span class="transition-transform group-hover:scale-110">{!! $icon !!}</span>
        @endif
        <span>{{ $slot }}</span>
        @if($iconRight)
            <span class="transition-transform group-hover:translate-x-1">{!! $iconRight !!}</span>
        @endif
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <span class="transition-transform group-hover:scale-110">{!! $icon !!}</span>
        @endif
        <span>{{ $slot }}</span>
        @if($iconRight)
            <span class="transition-transform group-hover:translate-x-1">{!! $iconRight !!}</span>
        @endif
    </button>
@endif