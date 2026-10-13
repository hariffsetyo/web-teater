@props([
    'title' => '',
    'subtitle' => '',
    'searchAction' => '',
    'searchValue' => '',
    'searchPlaceholder' => 'Cari data...',
    'pagination' => null,
])

<div class="space-y-4">
    <!-- Header / Toolbar -->
    <div class="bg-stage-card/70 backdrop-blur-md border border-stage-border rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            @if($title)
                <h2 class="font-serif text-xl sm:text-2xl font-bold text-parchment-100 flex items-center gap-2">
                    {{ $title }}
                </h2>
            @endif
            @if($subtitle)
                <p class="text-xs text-parchment-400 mt-0.5">{{ $subtitle }}</p>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-3">
            @if($searchAction)
                <form method="GET" action="{{ $searchAction }}" class="relative min-w-[220px]">
                    @foreach(request()->except(['q', 'page']) as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}" />
                    @endforeach
                    <input
                        type="text"
                        name="q"
                        value="{{ $searchValue ?? request('q') }}"
                        placeholder="{{ $searchPlaceholder }}"
                        class="w-full pl-9 pr-4 py-2 bg-stage-dark border border-stage-border rounded-xl text-xs text-parchment-100 placeholder-stage-muted focus:border-gold-500 focus:outline-none focus:ring-1 focus:ring-gold-500/30"
                    />
                    <svg class="w-4 h-4 text-stage-muted absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            @endif

            {{ $filters ?? '' }}

            {{ $actions ?? '' }}
        </div>
    </div>

    <!-- Bulk Actions or custom notice -->
    {{ $bulkActions ?? '' }}

    <!-- Table Container -->
    <div class="bg-stage-card/70 backdrop-blur-md border border-stage-border rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-parchment-200">
                <thead class="bg-stage-dark/80 text-[11px] font-semibold uppercase tracking-wider text-gold-400/90 border-b border-stage-border">
                    <tr>
                        {{ $thead }}
                    </tr>
                </thead>
                <tbody class="divide-y divide-stage-border/60">
                    {{ $slot }}
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pagination && method_exists($pagination, 'hasPages') && $pagination->hasPages())
            <div class="p-4 border-t border-stage-border bg-stage-dark/50">
                {{ $pagination->links() }}
            </div>
        @endif
    </div>
</div>
