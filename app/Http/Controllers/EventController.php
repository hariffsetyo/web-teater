<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('pages.events.index');
    }

    public function show($id)
    {
        $event = Event::with(['galleries', 'performances.ticketReservations'])->findOrFail($id);

        // Google Calendar Link Generator
        $start = $event->tanggal_mulai ? $event->tanggal_mulai->format('Ymd\THis\Z') : now()->format('Ymd\THis\Z');
        $end = $event->tanggal_selesai ? $event->tanggal_selesai->format('Ymd\THis\Z') : ($event->tanggal_mulai ? $event->tanggal_mulai->addHours(2)->format('Ymd\THis\Z') : now()->addHours(2)->format('Ymd\THis\Z'));
        $title = urlencode($event->judul);
        $details = urlencode(strip_tags($event->deskripsi ?? 'Pementasan dan agenda Sanggar Teater Siklus'));
        $location = urlencode($event->lokasi ?? 'Aula Utama Sekolah');

        $googleCalendarUrl = "https://calendar.google.com/calendar/render?action=TEMPLATE&text={$title}&dates={$start}/{$end}&details={$details}&location={$location}";

        // Event terkait lainnya
        $otherEvents = Event::where('id', '!=', $event->id)->latest()->take(3)->get();

        return view('pages.events.show', compact('event', 'googleCalendarUrl', 'otherEvents'));
    }
}