<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Gallery;
use Livewire\Component;

class GalleryList extends Component
{
    public string $tab = 'semua'; // 'semua', 'foto', 'video'
    public string $selectedCategory = '';
    public string $selectedEventId = '';
    public int $perPage = 9;

    public ?int $lightboxIndex = null;

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function openLightbox(int $index)
    {
        $this->lightboxIndex = $index;
    }

    public function closeLightbox()
    {
        $this->lightboxIndex = null;
    }

    public function nextLightbox(int $total)
    {
        if ($this->lightboxIndex !== null) {
            $this->lightboxIndex = ($this->lightboxIndex + 1) % $total;
        }
    }

    public function prevLightbox(int $total)
    {
        if ($this->lightboxIndex !== null) {
            $this->lightboxIndex = ($this->lightboxIndex - 1 + $total) % $total;
        }
    }

    public function render()
    {
        $query = Gallery::query()->with('event');

        if ($this->tab === 'foto') {
            $query->where('tipe', 'foto');
        } elseif ($this->tab === 'video') {
            $query->where('tipe', 'video');
        }

        if (!empty($this->selectedCategory)) {
            $query->where('kategori', $this->selectedCategory);
        }

        if (!empty($this->selectedEventId)) {
            $query->where('event_id', $this->selectedEventId);
        }

        $totalItems = (clone $query)->count();
        $items = $query->latest()->take($this->perPage)->get();

        $events = Event::has('galleries')->get();
        $categories = Gallery::whereNotNull('kategori')->distinct()->pluck('kategori');

        return view('livewire.gallery-list', [
            'items'       => $items,
            'totalItems'  => $totalItems,
            'events'      => $events,
            'categories'  => $categories,
        ]);
    }
}