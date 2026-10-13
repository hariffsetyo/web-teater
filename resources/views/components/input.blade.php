@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'error' => null,
    'hint' => null,
])

@php
$id = $id ?? 'input_' . Str::random(8);
@endphp

<div class="space-y-1.5 w-full">
    @if($label)
        <label for="{{ $id }}" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300 dark:text-parchment-300 text-stage-dark">
            {{ $label }}
        </label>
    @endif

    <div class="relative rounded-lg shadow-sm">
        <input
            id="{{ $id }}"
            type="{{ $type }}"
            {{ $attributes->merge([
                'class' => "w-full bg-stage-dark/80 dark:bg-stage-dark/80 bg-white border " . 
                    ($error ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-stage-border dark:border-stage-border border-parchment-300 focus:border-gold-500 focus:ring-gold-500/40') . 
                    " rounded-lg px-4 py-2.5 text-sm text-parchment-100 dark:text-parchment-100 text-stage-black placeholder-stage-muted/60 focus:outline-none focus:ring-2 transition-colors duration-200"
            ]) }}
        />
    </div>

    @if($error)
        <p class="text-xs text-rose-400 mt-1">{{ $error }}</p>
    @elseif($hint)
        <p class="text-xs text-stage-muted mt-1">{{ $hint }}</p>
    @endif
</div>