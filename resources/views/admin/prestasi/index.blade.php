@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <x-admin.data-table
        title="🏆 Manajemen Prestasi & Kejuaraan"
        subtitle="Etalase piala, penghargaan festival teater, dan piagam kehormatan ekskul"
        :searchAction="route('admin.prestasi.index')"
        :pagination="$achievements"
    >
        <x-slot:filters>
            <form method="GET" action="{{ route('admin.prestasi.index') }}" class="flex items-center gap-2">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <select name="tingkat" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Tingkat</option>
                    @foreach(['sekolah' => 'Sekolah', 'kabupaten' => 'Kabupaten / Kota', 'provinsi' => 'Provinsi', 'nasional' => 'Nasional', 'internasional' => 'Internasional'] as $k => $v)
                        <option value="{{ $k }}" {{ request('tingkat') == $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </form>
        </x-slot:filters>

        <x-slot:actions>
            <a href="{{ route('admin.prestasi.create') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-md shadow-gold-500/20 transition flex items-center gap-1.5 flex-shrink-0">
                <span>➕ Tambah Prestasi</span>
            </a>
        </x-slot:actions>

        <x-slot:thead>
            <th class="p-4">Perlombaan / Festival</th>
            <th class="p-4">Tingkat</th>
            <th class="p-4">Peringkat / Gelar</th>
            <th class="p-4">Tahun</th>
            <th class="p-4 text-right">Aksi</th>
        </x-slot:thead>

        @forelse($achievements as $ach)
            <tr class="hover:bg-stage-surface/50 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-stage-surface border border-stage-border overflow-hidden flex-shrink-0 flex items-center justify-center">
                            @if($ach->foto)
                                <img src="{{ asset($ach->foto) }}" alt="{{ $ach->nama_lomba }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl">🏆</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="font-semibold text-parchment-100 truncate">{{ $ach->nama_lomba }}</div>
                            <div class="text-[11px] text-parchment-400 line-clamp-1">{{ $ach->deskripsi ?? 'Pencapaian Seni Teater' }}</div>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-semibold bg-stage-surface border border-gold-500/20 text-gold-300">
                        {{ ucfirst($ach->tingkat) }}
                    </span>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                        {{ $ach->peringkat }}
                    </span>
                </td>
                <td class="p-4">
                    <div class="text-sm font-semibold text-parchment-200">{{ $ach->tahun }}</div>
                </td>
                <td class="p-4 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ route('admin.prestasi.edit', $ach) }}" class="p-1.5 rounded-lg bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 hover:text-gold-400 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button 
                            type="button"
                            @click="$dispatch('open-delete-modal', { url: '{{ route('admin.prestasi.destroy', $ach) }}', name: '{{ addslashes($ach->nama_lomba) }}' })"
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
                    Belum ada data prestasi festival teater yang dicatat.
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

</div>
@endsection
