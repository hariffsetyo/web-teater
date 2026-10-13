@props([
    'variant' => 'gold', // gold, maroon, neutral, success, danger
    'size' => 'md', // sm, md
])

@php
$sizeClasses = [
    'sm' => 'px-2.5 py-0.5 text-xs',
    'md' => 'px-3 py-1 text-xs tracking-wider uppercase font-semibold',
][$size] ?? 'px-3 py-1 text-xs';

$variantClasses = [
    'gold' => 'bg-gold-500/15 text-gold-400 border border-gold-500/30',
    'maroon' => 'bg-maroon-800/40 text-maroon-300 border border-maroon-700/50',
    'neutral' => 'bg-stage-surface text-parchment-300 border border-stage-border',
    'success' => 'bg-emerald-950/60 text-emerald-400 border border-emerald-700/50',
    'danger' => 'bg-rose-950/60 text-rose-400 border border-rose-700/50',
][$variant] ?? 'bg-gold-500/15 text-gold-400 border border-gold-500/30';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full font-medium $sizeClasses $variantClasses"]) }}>
    {{ $slot }}
</span>