<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberDirectory extends Component
{
    public string $search = '';
    public string $selectedDivisi = '';
    public string $selectedStatus = 'aktif'; // default aktif
    public ?int $selectedMemberId = null;

    public function selectMember(int $id)
    {
        $this->selectedMemberId = $id;
    }

    public function closeModal()
    {
        $this->selectedMemberId = null;
    }

    public function render()
    {
        $query = Member::query();

        if (!empty($this->search)) {
            $query->where('nama', 'like', '%' . trim($this->search) . '%');
        }

        if (!empty($this->selectedDivisi)) {
            $query->where('divisi', $this->selectedDivisi);
        }

        if (!empty($this->selectedStatus)) {
            $query->where('status', $this->selectedStatus);
        }

        $members = $query->orderBy('angkatan', 'desc')->orderBy('nama', 'asc')->get();

        $selectedMember = $this->selectedMemberId ? Member::find($this->selectedMemberId) : null;

        $divisions = [
            ''              => 'Semua Divisi',
            'akting'        => 'Akting & Peran',
            'naskah'        => 'Penulisan Naskah',
            'tata_rias'     => 'Tata Rias & Busana',
            'tata_panggung' => 'Tata Panggung & Cahaya',
            'musik'         => 'Musik & Tata Suara',
            'humas'         => 'Humas & Dokumentasi',
        ];

        return view('livewire.member-directory', [
            'members'        => $members,
            'selectedMember' => $selectedMember,
            'divisions'      => $divisions,
        ]);
    }
}