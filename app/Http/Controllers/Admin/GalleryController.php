<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Event;
use App\Models\Gallery;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::with('event');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        $galleries = $query->latest()->paginate(16)->withQueryString();
        $events = Event::orderBy('judul')->get();

        return view('admin.galeri.index', compact('galleries', 'events'));
    }

    public function create()
    {
        $events = Event::orderBy('judul')->get();
        return view('admin.galeri.create', compact('events'));
    }

    public function store(GalleryRequest $request)
    {
        $data = $request->validated();

        if ($request->tipe === 'foto' && $request->hasFile('foto')) {
            $data['file_path'] = ImageUploadService::upload($request->file('foto'), 'galleries', 1200, 800);
        }

        Gallery::create($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Dokumentasi galeri berhasil ditambahkan!');
    }

    public function edit(Gallery $galeri)
    {
        $gallery = $galeri;
        $events = Event::orderBy('judul')->get();
        return view('admin.galeri.edit', compact('gallery', 'events'));
    }

    public function update(GalleryRequest $request, Gallery $galeri)
    {
        $gallery = $galeri;
        $data = $request->validated();

        if ($request->tipe === 'foto') {
            if ($request->hasFile('foto')) {
                ImageUploadService::delete($gallery->file_path);
                $data['file_path'] = ImageUploadService::upload($request->file('foto'), 'galleries', 1200, 800);
            }
            $data['url_video'] = null;
        } else {
            // If changing to video, clean up old photo if any
            if ($gallery->file_path) {
                ImageUploadService::delete($gallery->file_path);
                $data['file_path'] = null;
            }
        }

        $gallery->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Dokumentasi galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $galeri)
    {
        $gallery = $galeri;
        ImageUploadService::delete($gallery->file_path);
        $gallery->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Dokumentasi galeri berhasil dihapus.');
    }
}
