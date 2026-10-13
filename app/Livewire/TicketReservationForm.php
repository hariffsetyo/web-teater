<?php

namespace App\Livewire;

use App\Models\Performance;
use App\Models\TicketReservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class TicketReservationForm extends Component
{
    public int $performanceId;
    public string $nama = '';
    public string $email = '';
    public string $no_hp = '';
    public int $jumlah_tiket = 1;

    public ?TicketReservation $confirmedTicket = null;
    public string $errorMessage = '';

    protected $rules = [
        'nama'         => 'required|min:3|max:100',
        'email'        => 'required|email|max:100',
        'no_hp'        => 'required|min:9|max:20',
        'jumlah_tiket' => 'required|integer|min:1|max:4',
    ];

    protected $messages = [
        'nama.required'         => 'Nama lengkap pemesan wajib diisi.',
        'email.required'        => 'Email aktif wajib diisi untuk pengiriman e-tiket.',
        'no_hp.required'        => 'Nomor WhatsApp wajib diisi.',
        'jumlah_tiket.required' => 'Pilih jumlah tiket yang ingin dipesan.',
        'jumlah_tiket.max'      => 'Maksimal 4 tiket per satu kali reservasi.',
    ];

    public function mount(int $performanceId)
    {
        $this->performanceId = $performanceId;
    }

    public function reserveTicket()
    {
        $this->reset('errorMessage');
        $this->validate();

        try {
            $ticket = DB::transaction(function () {
                // Lock row performance for update to prevent race conditions
                $perf = Performance::where('id', $this->performanceId)->lockForUpdate()->firstOrFail();

                if ($perf->status !== 'buka') {
                    throw new \Exception('Maaf, pemesanan tiket untuk pementasan ini telah ditutup.');
                }

                $terjual = $perf->ticketReservations()
                    ->whereIn('status', ['confirmed', 'hadir', 'pending'])
                    ->sum('jumlah_tiket');

                $sisa = $perf->kuota_kursi - $terjual;

                if ($this->jumlah_tiket > $sisa) {
                    throw new \Exception("Maaf, kuota kursi tersisa hanya {$sisa} tiket.");
                }

                $kode = 'TKT-' . date('ym') . '-' . strtoupper(Str::random(6));

                return TicketReservation::create([
                    'performance_id' => $perf->id,
                    'nama'           => strip_tags(trim($this->nama)),
                    'email'          => strtolower(trim($this->email)),
                    'no_hp'          => trim($this->no_hp),
                    'jumlah_tiket'   => $this->jumlah_tiket,
                    'kode_tiket'     => $kode,
                    'status'         => 'confirmed',
                ]);
            });

            $this->confirmedTicket = $ticket->load('performance.event');
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
    }

    public function render()
    {
        $performance = Performance::with('event')->findOrFail($this->performanceId);

        $terjual = $performance->ticketReservations()
            ->whereIn('status', ['confirmed', 'hadir', 'pending'])
            ->sum('jumlah_tiket');

        $sisaKursi = max(0, $performance->kuota_kursi - $terjual);

        $qrSvg = $this->confirmedTicket 
            ? (string) \SimpleSoftwareIO\QrCode\Facades\QrCode::size(130)->margin(1)->generate($this->confirmedTicket->kode_tiket) 
            : null;

        return view('livewire.ticket-reservation-form', [
            'performance' => $performance,
            'sisaKursi'   => $sisaKursi,
            'qrSvg'       => $qrSvg,
        ]);
    }
}