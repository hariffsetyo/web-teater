<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Models\Event;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $events = $query->latest('tanggal_mulai')->paginate(15)->withQueryString();

        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            $data['poster'] = ImageUploadService::upload($request->file('poster'), 'events', 1200, 675);
        }

        Event::create($data);

        return redirect()->route('admin.event.index')
            ->with('success', 'Agenda event berhasil dijadwalkan!');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            ImageUploadService::delete($event->poster);
            $data['poster'] = ImageUploadService::upload($request->file('poster'), 'events', 1200, 675);
        }

        $event->update($data);

        return redirect()->route('admin.event.index')
            ->with('success', 'Agenda event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        ImageUploadService::delete($event->poster);
        $event->delete();

        return redirect()->route('admin.event.index')
            ->with('success', 'Agenda event berhasil dihapus.');
    }
}
