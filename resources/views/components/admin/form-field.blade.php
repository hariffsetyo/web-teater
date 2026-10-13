@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'placeholder' => '',
])

<div class="space-y-1.5">
    @if($label)
        <label for="{{ $name }}" class="block text-xs font-semibold uppercase tracking-wider text-parchment-300">
            {{ $label }} {!! $required ? '<span class="text-rose-400">*</span>' : '' !!}
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="4"
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
            class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500"
        >{{ old($name, $value) }}</textarea>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            placeholder="{{ $placeholder }}"
            class="w-full bg-stage-dark border border-stage-border rounded-xl px-4 py-2.5 text-sm text-parchment-100 placeholder-stage-muted focus:border-gold-500"
        />
    @endif

    @error($name)
        <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
    @enderror
</div>