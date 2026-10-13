@props([
    'hover' => true,
    'padding' => 'p-6',
    'class' => '',
])

<div {{ $attributes->merge([
    'class' => "bg-stage-card/90 dark:bg-stage-card/90 bg-white dark:border-stage-border border-parchment-200 border rounded-2xl " 
        . ($hover ? 'transition-all duration-300 hover:border-gold-500/40 hover:shadow-gold-glow/50 hover:-translate-y-1 ' : '') 
        . $padding . ' ' . $class
]) }}>
    {{ $slot }}
</div>