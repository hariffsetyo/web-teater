<?php

namespace App\Livewire;

use App\Models\Registration;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationWizard extends Component
{
    use WithFileUploads;

    public int $step = 1;
    public string $tabMode = 'daftar'; // 'daftar' or 'cek_status'

    // Form fields
    public string $nama = '';
    public string $email = '';
    public string $no_hp = '';
    public string $kelas = '';
    public string $divisi = 'akting';
    public string $alasan_daftar = '';
    public string $motivasi = '';
    public $file_audisi = null;

    // Status check fields
    public string $searchIdentifier = '';
    public ?Registration $checkResult = null;
    public bool $hasSearched = false;

    // Success state
    public ?Registration $registeredRecord = null;

    public function mount()
    {
        // Support query param ?divisi=xxx from kuis
        $queryDivisi = request()->query('divisi');
        if ($queryDivisi && in_array($queryDivisi, ['akting', 'naskah', 'tata_rias', 'tata_panggung', 'musik', 'humas'])) {
            $this->divisi = $queryDivisi;
        }

        if (request()->query('tab') === 'status') {
            $this->tabMode = 'cek_status';
        }
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'nama'  => 'required|min:3|max:100',
                'email' => 'required|email|max:100',
                'no_hp' => 'required|min:9|max:20',
                'kelas' => 'required|max:20',
            ], [
                'nama.required'  => 'Nama lengkap wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email'    => 'Format email tidak valid.',
                'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
                'kelas.required' => 'Kelas / Jurusan wajib diisi.',
            ]);
            $this->step = 2;
        } elseif ($this->step === 2) {
            $this->validate([
                'divisi'        => 'required|in:akting,naskah,tata_rias,tata_panggung,musik,humas',
                'alasan_daftar' => 'required|min:10|max:1000',
                'motivasi'      => 'nullable|max:1000',
            ], [
                'alasan_daftar.required' => 'Alasan mendaftar wajib diisi.',
                'alasan_daftar.min'      => 'Alasan mendaftar minimal 10 karakter.',
            ]);
            $this->step = 3;
        }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submitRegistration()
    {
        $this->validate([
            'nama'          => 'required|min:3|max:100',
            'email'         => 'required|email|max:100',
            'no_hp'         => 'required|min:9|max:20',
            'kelas'         => 'required|max:20',
            'divisi'        => 'required|in:akting,naskah,tata_rias,tata_panggung,musik,humas',
            'alasan_daftar' => 'required|min:10',
            'file_audisi'   => 'nullable|file|max:20480', // 20MB
        ]);

        $filePath = null;
        if ($this->file_audisi) {
            $filePath = $this->file_audisi->store('audisi', 'public');
        }

        $reg = Registration::create([
            'nama'          => strip_tags(trim($this->nama)),
            'email'         => strtolower(trim($this->email)),
            'no_hp'         => trim($this->no_hp),
            'kelas'         => trim($this->kelas),
            'divisi'        => $this->divisi,
            'alasan_daftar' => strip_tags(trim($this->alasan_daftar)),
            'motivasi'      => strip_tags(trim($this->motivasi)),
            'file_audisi'   => $filePath,
            'status'        => 'pending',
        ]);

        $this->registeredRecord = $reg;
    }

    public function checkStatus()
    {
        $this->validate([
            'searchIdentifier' => 'required|min:3',
        ], [
            'searchIdentifier.required' => 'Masukkan nomor pendaftaran atau email Anda.',
        ]);

        $query = trim($this->searchIdentifier);
        $this->checkResult = Registration::where('nomor_pendaftaran', $query)
            ->orWhere('email', $query)
            ->latest()
            ->first();

        $this->hasSearched = true;
    }

    public function render()
    {
        $divisions = [
            'akting'        => ['label' => 'Divisi Akting & Peran', 'desc' => 'Olah vokal, gestur, penjiwaan karakter lakon'],
            'naskah'        => ['label' => 'Divisi Penulisan Naskah', 'desc' => 'Dramaturgi, dialog panggung, adaptasi lakon sastra'],
            'tata_rias'     => ['label' => 'Divisi Tata Rias & Busana', 'desc' => 'Karakterisasi wajah, SFX make-up, kostum panggung'],
            'tata_panggung' => ['label' => 'Divisi Tata Panggung & Cahaya', 'desc' => 'Set artistik, pencahayaan (lighting cue), rigging'],
            'musik'         => ['label' => 'Divisi Musik & Tata Suara', 'desc' => 'Ilustrasi musik latar, scoring emosional, sound effect'],
            'humas'         => ['label' => 'Divisi Humas & Dokumentasi', 'desc' => 'Manajemen pementasan, ticketing, publikasi sinematik'],
        ];

        return view('livewire.registration-wizard', [
            'divisions' => $divisions,
        ]);
    }
}