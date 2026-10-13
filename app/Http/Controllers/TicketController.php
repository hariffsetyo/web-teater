<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\TicketReservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    public function index()
    {
        $performances = Performance::with('event')
            ->where('status', 'buka')
            ->get();

        return view('pages.tiket.index', compact('performances'));
    }

    public function show($id)
    {
        $performance = Performance::with('event')->findOrFail($id);

        return view('pages.tiket.show', compact('performance'));
    }

    public function cek(Request $request)
    {
        $ticket = null;
        $search = $request->query('q');

        if (!empty($search)) {
            $ticket = TicketReservation::with('performance.event')
                ->where('kode_tiket', strtoupper(trim($search)))
                ->orWhere('email', strtolower(trim($search)))
                ->latest()
                ->first();
        }

        $qrSvg = $ticket ? (string) QrCode::size(120)->margin(1)->generate($ticket->kode_tiket) : null;

        return view('pages.tiket.cek', compact('ticket', 'search', 'qrSvg'));
    }

    public function downloadPdf($kode_tiket)
    {
        $ticket = TicketReservation::with('performance.event')
            ->where('kode_tiket', $kode_tiket)
            ->firstOrFail();

        $qrCodeSvg = (string) QrCode::size(120)->margin(1)->generate($ticket->kode_tiket);

        $pdf = Pdf::loadView('pdf.tiket', compact('ticket', 'qrCodeSvg'))
            ->setPaper('a5', 'landscape');

        return $pdf->download('E-Tiket-' . $ticket->kode_tiket . '.pdf');
    }
}