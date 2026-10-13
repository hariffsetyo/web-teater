@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <x-admin.data-table
        title="💬 Manajemen Testimonial"
        subtitle="Ulasan, kesan pesan penonton, dan testimoni apresiasi tokoh"
        :searchAction="route('admin.testimonial.index')"
        :pagination="$testimonials"
    >
        <x-slot:actions>
            <a href="{{ route('admin.testimonial.create') }}" class="px-4 py-2 rounded-xl bg-gold-500 hover:bg-gold-400 text-stage-black text-xs font-bold shadow-md shadow-gold-500/20 transition flex items-center gap-1.5 flex-shrink-0">
                <span>➕ Tambah Testimoni</span>
            </a>
        </x-slot:actions>

        <x-slot:thead>
            <th class="p-4">Tokoh / Penonton</th>
            <th class="p-4">Peran / Status</th>
            <th class="p-4">Isi Testimoni</th>
            <th class="p-4 text-center">Featured (Beranda)</th>
            <th class="p-4 text-right">Aksi</th>
        </x-slot:thead>

        @forelse($testimonials as $testi)
            <tr class="hover:bg-stage-surface/50 transition">
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-stage-surface border border-stage-border overflow-hidden flex-shrink-0 flex items-center justify-center">
                            @if($testi->foto)
                                <img src="{{ asset($testi->foto) }}" alt="{{ $testi->nama }}" class="w-full h-full object-cover">
                            @else
                                <span class="font-bold text-xs text-gold-400">{{ substr($testi->nama, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="font-semibold text-parchment-100 truncate">{{ $testi->nama }}</div>
                    </div>
                </td>
                <td class="p-4">
                    <span class="text-xs text-parchment-300">{{ $testi->peran ?? 'Penonton' }}</span>
                </td>
                <td class="p-4 max-w-md">
                    <p class="text-xs text-parchment-300 italic line-clamp-2">"{{ $testi->isi }}"</p>
                </td>
                <td class="p-4 text-center">
                    <form method="POST" action="{{ route('admin.testimonial.toggle-featured', $testi) }}">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-[10px] font-bold transition {{ $testi->featured ? 'bg-gold-500 text-stage-black shadow-md shadow-gold-500/20' : 'bg-stage-surface text-parchment-400 border border-stage-border hover:border-gold-500/40' }}">
                            {{ $testi->featured ? '⭐ Tampil di Beranda' : '☆ Biasa' }}
                        </button>
                    </form>
                </td>
                <td class="p-4 text-right">
                    <div class="inline-flex items-center gap-2">
                        <a href="{{ route('admin.testimonial.edit', $testi) }}" class="p-1.5 rounded-lg bg-stage-surface hover:bg-stage-dark border border-stage-border text-parchment-300 hover:text-gold-400 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button 
                            type="button"
                            @click="$dispatch('open-delete-modal', { url: '{{ route('admin.testimonial.destroy', $testi) }}', name: '{{ addslashes($testi->nama) }}' })"
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
                    Belum ada testimonial yang ditambahkan.
                </td>
            </tr>
        @endforelse
    </x-admin.data-table>

</div>
@endsection
