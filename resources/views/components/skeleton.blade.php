@props([
    'width' => 'w-full',
    'height' => 'h-4',
    'rounded' => 'rounded-md',
])

<div {{ $attributes->merge(['class' => "animate-pulse bg-stage-surface/70 dark:bg-stage-surface/70 bg-parchment-200 $width $height $rounded"]) }}></div>