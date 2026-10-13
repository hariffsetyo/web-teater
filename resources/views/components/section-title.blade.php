@props([
    'subtitle' => null,
    'title' => '',
    'description' => null,
    'align' => 'center', // center, left
])

@php
$alignment = $align === 'left' ? 'text-left items-start' : 'text-center items-center';
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col $alignment mb-12 sm:mb-16"]) }}>
    @if($subtitle)
        <div class="inline-flex items-center gap-2 mb-3">
            <span class="w-8 h-px bg-gradient-to-r from-transparent to-gold-500"></span>
            <span class="text-xs sm:text-sm font-semibold tracking-widest uppercase text-gold-400">
                {{ $subtitle }}
            </span>
            <span class="w-8 h-px bg-gradient-to-l from-transparent to-gold-500"></span>
        </div>
    @endif

    <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-parchment-100 dark:text-parchment-100 text-stage-black">
        {!! $title !!}
    </h2>

    {{-- Theatrical ornament flourish --}}
    <div class="flex items-center gap-3 my-4 opacity-80">
        <div class="w-12 sm:w-16 h-px bg-gradient-to-r from-transparent via-gold-500 to-gold-400"></div>
        <div class="flex items-center gap-1 text-gold-400 text-xs">
            <span>✦</span>
            <span class="text-sm">🎭</span>
            <span>✦</span>
        </div>
        <div class="w-12 sm:w-16 h-px bg-gradient-to-l from-transparent via-gold-500 to-gold-400"></div>
    </div>

    @if($description)
        <p class="max-w-2xl text-sm sm:text-base text-parchment-300 dark:text-parchment-300 text-stage-muted leading-relaxed">
            {{ $description }}
        </p>
    @endif
</div>