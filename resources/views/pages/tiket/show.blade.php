<x-layouts.public :title="'Pesan Tiket — ' . $performance->judul_pementasan">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <x-breadcrumb :items="[
            ['label' => 'Tiket Pementasan', 'url' => route('tiket.index')],
            ['label' => 'Reservasi: ' . $performance->judul_pementasan, 'url' => null]
        ]" />

        <livewire:ticket-reservation-form :performance-id="$performance->id" />

    </div>
</x-layouts.public>