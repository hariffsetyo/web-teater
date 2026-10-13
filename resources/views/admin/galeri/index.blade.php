@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <x-admin.data-table
        title="🖼️ Manajemen Galeri Teater"
        subtitle="Arsip dokumentasi visual foto dan rekaman video pementasan"
        :searchAction="route('admin.galeri.index')"
        :pagination="$galleries"
    >
        <x-slot:filters>
            <form method="GET" action="{{ route('admin.galeri.index') }}" class="flex items-center gap-2">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <select name="tipe" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Tipe</option>
                    <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                    <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                </select>

                <select name="event_id" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500 max-w-[180px]">
                    <option value="">Semua Event</option>
                    @foreach($events as $ev)
                        <option value="{{ $ev->id }}" {{ request('event_id') == $ev->id ? 'selected' : '' }}>
                            {{ \Illuminate\Support\Str::limit($ev->judul, 22) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </x-slot:filters>

        <x-slot:actions>
            <a href="{{ route('admin.galeri.create') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-md shadow-gold-500/20 transition flex items-center gap-1.5 flex-shrink-0">
                <span>➕ Tambah Media</span>
            </a>
        </x-slot:actions>

        <x-slot:thead>
            <th class="p-4">Media</th>
            <th class="p-4">Tipe</th>
            <th class="p-4">Agenda Event Terkait</th>
            <th class="p-4">Kategori</th>
            <th class="p-4 text-right">Aksi</th>
        </x-slot:thead>

        @forelse($galleries as $g)
            <tr class="hover:bg-stage-surface/50 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-16 h-12 rounded-xl bg-stage-surface border border-stage-border overflow-hidden flex-shrink-0 flex items-center justify-center relative">
                            @if($g->tipe === 'foto' && $g->file_path)
                                <img src="{{ asset($g->file_path) }}" alt="{{ $g->judul }}" class="w-full h-full object-cover">
                            @elseif($g->tipe === 'video' && $g->url_video)
                                <div class="w-full h-full bg-rose-950/40 flex items-center justify-center text-rose-400">
                                    ▶️
                                </div>
                            @else
                                <span class="text-sm">🖼️</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="font-semibold text-parchment-100 truncate">{{ $g->judul }}</div>
                            <div class="text-[11px] text-parchment-400 line-clamp-1">{{ $g->deskripsi ?? 'Dokumentasi Teater Siklus' }}</div>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-semibold 
                        {{ $g->tipe === 'foto' ? 'bg-amber-950/60 text-amber-300 border border-amber-500/30' : 'bg-rose-950/60 text-rose-300 border border-rose-500/30' }}">
                        {{ $g->tipe === 'foto' ? '📷 Foto' : '🎬 Video' }}
                    </span>
                </td>
                <td class="p-4">
                    <div class="text-parchment-200 text-xs">{{ $g->event->judul ?? '-' }}</div>
                </td>
                <td class="p-4">
                    <span class="px-2 py-0.5 rounded text-[10px] bg-stage-surface border border-stage-border text-parchment-300">
                        {{ $g->kategori ?? 'Umum' }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ route('admin.galeri.edit', $g) }}" class="p-1.5 rounded-lg bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 hover:text-gold-400 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button 
                            type="button"
                            @click="$dispatch('open-delete-modal', { url: '{{ route('admin.galeri.destroy', $g) }}', name: '{{ addslashes($g->judul) }}' })"
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
                    Belum ada data galeri dokumentasi teater.
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

</div>
@endsection
