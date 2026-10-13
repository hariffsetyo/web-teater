@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <x-admin.data-table
        title="📝 Manajemen Artikel & Wawasan"
        subtitle="Publikasi esai teater, tips seni peran, dan liputan pertunjukan"
        :searchAction="route('admin.artikel.index')"
        :pagination="$articles"
    >
        <x-slot:filters>
            <form method="GET" action="{{ route('admin.artikel.index') }}" class="flex items-center gap-2">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <select name="status" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Terbit (Published)</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Konsep (Draft)</option>
                </select>
            </form>
        </x-slot:filters>

        <x-slot:actions>
            <a href="{{ route('admin.artikel.create') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-md shadow-gold-500/20 transition flex items-center gap-1.5 flex-shrink-0">
                <span>➕ Tulis Artikel</span>
            </a>
        </x-slot:actions>

        <x-slot:thead>
            <th class="p-4">Artikel</th>
            <th class="p-4">Kategori</th>
            <th class="p-4">Pembaca (Views)</th>
            <th class="p-4">Status & Tanggal</th>
            <th class="p-4 text-right">Aksi</th>
        </x-slot:thead>

        @forelse($articles as $art)
            <tr class="hover:bg-stage-surface/50 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-10 rounded-xl bg-stage-surface border border-stage-border overflow-hidden flex-shrink-0 flex items-center justify-center">
                            @if($art->thumbnail)
                                <img src="{{ asset($art->thumbnail) }}" alt="{{ $art->judul }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm">📖</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <a href="{{ route('artikel.show', $art->slug) }}" target="_blank" class="font-semibold text-parchment-100 hover:text-gold-400 transition truncate block">
                                {{ $art->judul }} ↗
                            </a>
                            <div class="text-[11px] text-parchment-400 line-clamp-1">
                                {{ strip_tags($art->konten) }}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-semibold bg-stage-surface border border-stage-border text-gold-300">
                        {{ $art->kategori ?? 'Umum' }}
                    </span>
                </td>
                <td class="p-4">
                    <div class="text-xs text-parchment-200 font-semibold">{{ number_format($art->views) }} views</div>
                    <div class="text-[10px] text-parchment-400">{{ $art->comments()->count() }} komentar</div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold 
                        {{ $art->status === 'published' ? 'bg-emerald-950/60 text-emerald-400 border border-emerald-500/30' : 'bg-amber-950/60 text-amber-300 border border-amber-500/30' }}">
                        {{ ucfirst($art->status) }}
                    </span>
                    <div class="text-[10px] text-parchment-400 mt-1">
                        {{ $art->published_at ? $art->published_at->format('d/m/Y') : 'Belum terbit' }}
                    </div>
                </td>
                <td class="p-4 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ route('admin.artikel.edit', $art) }}" class="p-1.5 rounded-lg bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 hover:text-gold-400 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button 
                            type="button"
                            @click="$dispatch('open-delete-modal', { url: '{{ route('admin.artikel.destroy', $art) }}', name: '{{ addslashes($art->judul) }}' })"
                            class="p-1.5 rounded-lg bg-rose-950/40 hover:bg-rose-900/60 border border-rose-500/30 text-rose-400 hover:text-rose-200 transition"
                            title="Hapus"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-parchment-500 italic">
                    Belum ada artikel wawasan teater yang dibuat.
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

</div>
@endsection
