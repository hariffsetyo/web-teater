@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <x-admin.data-table
        title="📅 Manajemen Agenda Event"
        subtitle="Jadwal pementasan akbar, festival lomba, dan agenda latihan rutin"
        :searchAction="route('admin.event.index')"
        :pagination="$events"
    >
        <x-slot:filters>
            <form method="GET" action="{{ route('admin.event.index') }}" class="flex items-center gap-2">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <select name="tipe" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Tipe</option>
                    <option value="latihan" {{ request('tipe') == 'latihan' ? 'selected' : '' }}>Latihan</option>
                    <option value="pementasan" {{ request('tipe') == 'pementasan' ? 'selected' : '' }}>Pementasan</option>
                    <option value="lomba" {{ request('tipe') == 'lomba' ? 'selected' : '' }}>Lomba / Festival</option>
                </select>

                <select name="status" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </form>
        </x-slot:filters>

        <x-slot:actions>
            <a href="{{ route('admin.event.create') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-md shadow-gold-500/20 transition flex items-center gap-1.5 flex-shrink-0">
                <span>➕ Jadwalkan Event</span>
            </a>
        </x-slot:actions>

        <x-slot:thead>
            <th class="p-4">Agenda / Lakon</th>
            <th class="p-4">Tipe</th>
            <th class="p-4">Jadwal & Waktu</th>
            <th class="p-4">Lokasi</th>
            <th class="p-4">Status</th>
            <th class="p-4 text-right">Aksi</th>
        </x-slot:thead>

        @forelse($events as $e)
            <tr class="hover:bg-stage-surface/50 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-10 rounded-xl bg-stage-surface border border-stage-border overflow-hidden flex-shrink-0 flex items-center justify-center">
                            @if($e->poster)
                                <img src="{{ asset($e->poster) }}" alt="{{ $e->judul }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm">🎭</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <a href="{{ route('event.show', $e->slug) }}" target="_blank" class="font-semibold text-parchment-100 hover:text-gold-400 transition truncate block">
                                {{ $e->judul }} ↗
                            </a>
                            <div class="text-[11px] text-parchment-400 line-clamp-1">{{ $e->deskripsi ?? 'Tidak ada deskripsi' }}</div>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-semibold 
                        {{ $e->tipe === 'pementasan' ? 'bg-curtain-800 text-gold-300 border border-gold-500/30' : ($e->tipe === 'lomba' ? 'bg-amber-950/60 text-amber-300 border border-amber-500/30' : 'bg-stage-surface text-parchment-300 border border-stage-border') }}">
                        {{ ucfirst($e->tipe) }}
                    </span>
                </td>
                <td class="p-4">
                    <div class="font-medium text-parchment-200">{{ $e->tanggal_mulai->isoFormat('D MMM Y') }}</div>
                    <div class="text-[10px] text-parchment-400">Pukul {{ $e->tanggal_mulai->format('H:i') }} WIB</div>
                </td>
                <td class="p-4">
                    <div class="text-parchment-300 text-xs">{{ $e->lokasi ?? 'Panggung Sekolah' }}</div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold 
                        {{ $e->status === 'aktif' ? 'bg-emerald-950/60 text-emerald-400 border border-emerald-500/30' : ($e->status === 'selesai' ? 'bg-slate-800 text-slate-300 border border-slate-700' : ($e->status === 'batal' ? 'bg-rose-950/60 text-rose-400 border border-rose-500/30' : 'bg-amber-950/60 text-amber-300 border border-amber-500/30')) }}">
                        {{ ucfirst($e->status) }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ route('admin.event.edit', $e) }}" class="p-1.5 rounded-lg bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 hover:text-gold-400 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button 
                            type="button"
                            @click="$dispatch('open-delete-modal', { url: '{{ route('admin.event.destroy', $e) }}', name: '{{ addslashes($e->judul) }}' })"
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
                <td colspan="6" class="p-8 text-center text-parchment-500 italic">
                    Belum ada agenda event yang tercatat.
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

</div>
@endsection
