@extends('layouts.admin')

@section('content')
<div x-data="{
    selected: [],
    selectAll: false,
    toggleAll() {
        this.selectAll = !this.selectAll;
        if (this.selectAll) {
            this.selected = {{ json_encode($members->pluck('id')->toArray()) }};
        } else {
            this.selected = [];
        }
    }
}" class="space-y-6">

    <!-- Data Table Header & Toolbar -->
    <x-admin.data-table
        title="👥 Manajemen Anggota"
        subtitle="Daftar seluruh aktor, kreator, dan staf divisi Teater Siklus"
        :searchAction="route('admin.anggota.index')"
        :pagination="$members"
    >
        <x-slot:filters>
            <form method="GET" action="{{ route('admin.anggota.index') }}" class="flex items-center gap-2">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                <select name="divisi" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Divisi</option>
                    @foreach(['akting' => 'Akting', 'naskah' => 'Naskah', 'tata_rias' => 'Tata Rias', 'tata_panggung' => 'Tata Panggung', 'musik' => 'Musik', 'humas' => 'Humas'] as $k => $v)
                        <option value="{{ $k }}" {{ request('divisi') == $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>

                <select name="status" onchange="this.form.submit()" class="bg-stage-dark border border-stage-border rounded-xl px-3 py-2 text-xs text-parchment-200 focus:border-gold-500">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="alumni" {{ request('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
            </form>
        </x-slot:filters>

        <x-slot:actions>
            <a href="{{ route('admin.anggota.create') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-md shadow-gold-500/20 transition flex items-center gap-1.5 flex-shrink-0">
                <span>➕ Tambah Anggota</span>
            </a>
        </x-slot:actions>

        <!-- Bulk Action Bar -->
        <x-slot:bulkActions>
            <div x-show="selected.length > 0" x-cloak class="p-3 rounded-2xl bg-amber-950/60 border border-gold-500/30 flex items-center justify-between gap-3 text-xs">
                <span class="text-gold-300 font-medium">
                    <strong x-text="selected.length"></strong> anggota dipilih
                </span>

                <form method="POST" action="{{ route('admin.anggota.bulk-alumni') }}" class="flex items-center gap-2">
                    @csrf
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="member_ids[]" :value="id">
                    </template>
                    <button type="submit" onclick="return confirm('Ubah status anggota terpilih menjadi Alumni?')" class="px-3 py-1.5 rounded-xl bg-stage-card border border-gold-500/40 text-gold-300 hover:bg-gold-500 hover:text-stage-black transition text-xs font-semibold">
                        🎓 Ubah ke Alumni
                    </button>
                </form>
            </div>
        </x-slot:bulkActions>

        <x-slot:thead>
            <th class="p-4 w-10 text-center">
                <input type="checkbox" @click="toggleAll()" :checked="selectAll" class="rounded border-stage-border bg-stage-dark text-gold-500 focus:ring-gold-500/40">
            </th>
            <th class="p-4">Anggota</th>
            <th class="p-4">Divisi</th>
            <th class="p-4">Angkatan / Kelas</th>
            <th class="p-4">Kontak</th>
            <th class="p-4">Status</th>
            <th class="p-4 text-right">Aksi</th>
        </x-slot:thead>

        @forelse($members as $m)
            <tr class="hover:bg-stage-surface/50 transition">
                <td class="p-4 text-center">
                    <input type="checkbox" :value="{{ $m->id }}" x-model="selected" class="rounded border-stage-border bg-stage-dark text-gold-500 focus:ring-gold-500/40">
                </td>
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-stage-surface border border-stage-border overflow-hidden flex-shrink-0 flex items-center justify-center">
                            @if($m->foto)
                                <img src="{{ asset($m->foto) }}" alt="{{ $m->nama }}" class="w-full h-full object-cover">
                            @else
                                <span class="font-serif font-bold text-xs text-gold-400">{{ substr($m->nama, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="font-semibold text-parchment-100 truncate">{{ $m->nama }}</div>
                            <div class="text-[11px] text-parchment-400 line-clamp-1">{{ $m->bio ?? 'Anggota Teater Siklus' }}</div>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-semibold bg-stage-surface border border-gold-500/20 text-gold-300">
                        {{ $m->divisi_label }}
                    </span>
                </td>
                <td class="p-4">
                    <div class="text-parchment-200">{{ $m->kelas }}</div>
                    <div class="text-[10px] text-parchment-500">Angkatan {{ $m->angkatan }}</div>
                </td>
                <td class="p-4">
                    <div class="text-parchment-300 text-xs">{{ $m->no_hp ?? '-' }}</div>
                </td>
                <td class="p-4">
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $m->status === 'aktif' ? 'bg-emerald-950/60 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400 border border-slate-700' }}">
                        {{ ucfirst($m->status) }}
                    </span>
                </td>
                <td class="p-4 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ route('admin.anggota.edit', $m) }}" class="p-1.5 rounded-lg bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 hover:text-gold-400 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button 
                            type="button"
                            @click="$dispatch('open-delete-modal', { url: '{{ route('admin.anggota.destroy', $m) }}', name: '{{ addslashes($m->nama) }}' })"
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
                <td colspan="7" class="p-8 text-center text-parchment-500 italic">
                    Belum ada data anggota yang cocok dengan filter atau pencarian.
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

</div>
@endsection
