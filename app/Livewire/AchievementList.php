<?php

namespace App\Livewire;

use App\Models\Achievement;
use Livewire\Component;

class AchievementList extends Component
{
    public string $selectedTingkat = '';
    public string $selectedYear = '';
    public string $search = '';

    public function render()
    {
        $query = Achievement::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nama_lomba', 'like', '%' . trim($this->search) . '%')
                  ->orWhere('peringkat', 'like', '%' . trim($this->search) . '%')
                  ->orWhere('deskripsi', 'like', '%' . trim($this->search) . '%');
            });
        }

        if (!empty($this->selectedTingkat)) {
            $query->where('tingkat', $this->selectedTingkat);
        }

        if (!empty($this->selectedYear)) {
            $query->where('tahun', $this->selectedYear);
        }

        // Kelompokkan per tahun (dari yang terbaru)
        $achievementsByYear = $query->orderBy('tahun', 'desc')
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy('tahun');

        // Pilihan tingkat & tahun unik
        $tingkatList = [
            ''              => 'Semua Tingkat',
            'sekolah'       => 'Tingkat Sekolah',
            'kabupaten'     => 'Kabupaten / Kota',
            'provinsi'      => 'Tingkat Provinsi',
            'nasional'      => 'Tingkat Nasional',
            'internasional' => 'Tingkat Internasional',
        ];

        $years = Achievement::distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('livewire.achievement-list', [
            'achievementsByYear' => $achievementsByYear,
            'tingkatList'        => $tingkatList,
            'years'              => $years,
        ]);
    }
}