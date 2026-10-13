<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventList extends Component
{
    public string $viewMode = 'list'; // 'list' or 'calendar'
    public string $selectedType = '';
    public string $selectedStatus = '';
    public string $search = '';
    
    // Calendar state
    public int $currentMonth;
    public int $currentYear;

    public function mount()
    {
        $this->currentMonth = (int) date('m');
        $this->currentYear = (int) date('Y');
    }

    public function nextMonth()
    {
        if ($this->currentMonth === 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        } else {
            $this->currentMonth++;
        }
    }

    public function prevMonth()
    {
        if ($this->currentMonth === 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        } else {
            $this->currentMonth--;
        }
    }

    public function render()
    {
        $query = Event::query()->with('performances');

        if (!empty($this->search)) {
            $query->where('judul', 'like', '%' . trim($this->search) . '%');
        }

        if (!empty($this->selectedType)) {
            $query->where('tipe', $this->selectedType);
        }

        if (!empty($this->selectedStatus)) {
            $query->where('status', $this->selectedStatus);
        }

        $events = $query->orderBy('tanggal_mulai', 'asc')->get();

        // Data untuk Kalender
        $calendarDays = [];
        $firstDayOfMonth = \Carbon\Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $daysInMonth = $firstDayOfMonth->daysInMonth;
        $startDayOfWeek = ($firstDayOfMonth->dayOfWeekIso) % 7; // 0 for Sunday or adjusted for Senin-Minggu

        // Events in current calendar month
        $monthEvents = Event::whereYear('tanggal_mulai', $this->currentYear)
            ->whereMonth('tanggal_mulai', $this->currentMonth)
            ->get()
            ->groupBy(function ($event) {
                return $event->tanggal_mulai->format('j');
            });

        return view('livewire.event-list', [
            'events'          => $events,
            'monthEvents'     => $monthEvents,
            'daysInMonth'     => $daysInMonth,
            'startDayOfWeek'  => $startDayOfWeek,
            'monthName'       => $firstDayOfMonth->translatedFormat('F Y'),
        ]);
    }
}