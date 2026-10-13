<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PerformanceRequest;
use App\Models\Event;
use App\Models\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Performance::with('event');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul_pementasan', 'like', "%{$search}%")
                  ->orWhere('sinopsis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $performances = $query->latest()->paginate(15)->withQueryString();

        return view('admin.pentas.index', compact('performances'));
    }

    public function create()
    {
        $events = Event::where('tipe', 'pementasan')->orderByDesc('tanggal_mulai')->get();
        if ($events->isEmpty()) {
            $events = Event::orderByDesc('tanggal_mulai')->get();
        }
        return view('admin.pentas.create', compact('events'));
    }

    public function store(PerformanceRequest $request)
    {
        Performance::create($request->validated());

        return redirect()->route('admin.pentas.index')
            ->with('success', 'Lakon pementasan & loket tiket berhasil dibuka!');
    }

    public function edit(Performance $penta)
    {
        $performance = $penta;
        $events = Event::orderByDesc('tanggal_mulai')->get();
        return view('admin.pentas.edit', compact('performance', 'events'));
    }

    public function update(PerformanceRequest $request, Performance $penta)
    {
        $performance = $penta;
        $performance->update($request->validated());

        return redirect()->route('admin.pentas.index')
            ->with('success', 'Data pementasan & kuota tiket berhasil diperbarui!');
    }

    public function destroy(Performance $penta)
    {
        $performance = $penta;
        $performance->delete();

        return redirect()->route('admin.pentas.index')
            ->with('success', 'Data pementasan berhasil dihapus.');
    }

    public function toggleStatus(Performance $performance)
    {
        $newStatus = $performance->status === 'buka' ? 'tutup' : 'buka';
        $performance->update(['status' => $newStatus]);

        $label = $newStatus === 'buka' ? 'dibuka kembali' : 'ditutup sementara';

        return redirect()->back()
            ->with('success', "Loket tiket '{$performance->judul_pementasan}' kini {$label}.");
    }
}
