<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('peran', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        $testimonials = $query->latest()->paginate(15)->withQueryString();

        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(TestimonialRequest $request)
    {
        $data = $request->validated();
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageUploadService::upload($request->file('foto'), 'testimonials', 400, 400);
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonial.index')
            ->with('success', 'Testimonial apresiasi berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->validated();
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('foto')) {
            ImageUploadService::delete($testimonial->foto);
            $data['foto'] = ImageUploadService::upload($request->file('foto'), 'testimonials', 400, 400);
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonial.index')
            ->with('success', 'Testimonial berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        ImageUploadService::delete($testimonial->foto);
        $testimonial->delete();

        return redirect()->route('admin.testimonial.index')
            ->with('success', 'Testimonial berhasil dihapus.');
    }

    public function toggleFeatured(Testimonial $testimonial)
    {
        $testimonial->update([
            'featured' => !$testimonial->featured,
        ]);

        $statusText = $testimonial->featured ? 'ditampilkan di beranda utama' : 'disembunyikan dari beranda utama';

        return redirect()->back()
            ->with('success', "Testimonial {$testimonial->nama} kini {$statusText}.");
    }
}
