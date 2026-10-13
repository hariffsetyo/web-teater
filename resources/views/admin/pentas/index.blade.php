@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <x-admin.data-table
        title="🎟️ Manajemen Lakon & Tiket Pementasan"
        subtitle="Pengaturan kuota kursi teater, status loket tiket, dan penyesuaian tarif"
        :searchAction="route('admin.pentas.index')"
        :pagination="$performances"
    >
        <x-slot:filters>
            <form method="GET" action="{{ route('admin.pentas.index') }}" class="flex items-center gap-2">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <select name="status" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Status Loket</option>
                    <option value="buka" {{ request('status') == 'buka' ? 'selected' : '' }}>Loket Dibuka</option>
                    <option value="tutup" {{ request('status') == 'tutup' ? 'selected' : '' }}>Loket Ditutup</option>
                </select>
            </form>
        </x-slot:filters>

        <x-slot:actions>
            <a href="{{ route('admin.pentas.create') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-md shadow-gold-500/20 transition flex items-center gap-1.5 flex-shrink-0">
                <span>➕ Buka Lakon / Tiket</span>
            </a>
        </x-slot:actions>

        <x-slot:thead>
            <th class="p-4">Lakon Pementasan</th>
            <th class="p-4">Agenda Terkait</th>
            <th class="p-4">Kapasitas Kursi & Terjual</th>
            <th class="p-4">Tarif Tiket</th>
            <th class="p-4 text-center">Status Loket</th>
            <th class="p-4 text-right">Aksi</th>
        </x-slot:thead>

        @forelse($performances as $perf)
            <tr class="hover:bg-stage-surface/50 transition">
                <td class="p-4">
                    <div class="font-semibold text-parchment-100">{{ $perf->judul_pementasan }}</div>
                    <div class="text-[11px] text-parchment-400 line-clamp-1">{{ $perf->sinopsis ?? 'Pertunjukan Teater Siklus' }}</div>
                </td>
                <td class="p-4">
                    <div class="text-xs text-parchment-200">{{ $perf->event->judul ?? '-' }}</div>
                    @if($perf->event && $perf->event->tanggal_mulai)
                        <div class="text-[10px] text-parchment-400">{{ $perf->event->tanggal_mulai->format('d M Y, H:i') }} WIB</div>
                    @endif
                </td>
                <td class="p-4 min-w-[180px]">
                    @php
                        $sold = $perf->tiket_terjual;
                        $quota = $perf->kuota_kursi;
                        $percent = $quota > 0 ? min(100, round(($sold / $quota) * 100)) : 0;
                    @endphp
                    <div class="flex items-center justify-between text-xs mb-1">
                        <span class="font-bold text-gold-400">{{ $sold }} terjual</span>
                        <span class="text-parchment-400">kuota {{ $quota }}</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-stage-dark border border-stage-border overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-gold-500 to-amber-600 rounded-full" style="width: {{ $percent }}%"></div>
                    </div>
                    <div class="text-[10px] text-parchment-400 mt-1">Sisa kursi: {{ $perf->sisa_kursi }}</div>
                </td>
                <td class="p-4">
                    @if(empty($perf->harga_tiket) || $perf->harga_tiket == 0)
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950/60 text-emerald-400 border border-emerald-500/30">
                            GRATIS
                        </span>
                    @else
                        <span class="text-xs font-semibold text-parchment-100">
                            Rp {{ number_format($perf->harga_tiket, 0, ',', '.') }}
                        </span>
                    @endif
                </td>
                <td class="p-4 text-center">
                    <form method="POST" action="{{ route('admin.pentas.toggle-status', $perf) }}">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-[10px] font-bold transition {{ $perf->status === 'buka' ? 'bg-emerald-950/80 text-emerald-300 border border-emerald-500/40 hover:bg-emerald-900' : 'bg-rose-950/80 text-rose-300 border border-rose-500/40 hover:bg-rose-900' }}">
                            {{ $perf->status === 'buka' ? '🟢 Buka (Tersedia)' : '🔴 Ditutup' }}
                        </button>
                    </form>
                </td>
                <td class="p-4 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ route('admin.pentas.edit', $perf) }}" class="p-1.5 rounded-lg bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 hover:text-gold-400 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button 
                            type="button"
                            @click="$dispatch('open-delete-modal', { url: '{{ route('admin.pentas.destroy', $perf) }}', name: '{{ addslashes($perf->judul_pementasan) }}' })"
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
                    Belum ada lakon pementasan atau tiket yang dibuka.
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

</div>
@endsection
