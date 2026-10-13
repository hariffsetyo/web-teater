<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AchievementRequest;
use App\Models\Achievement;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $query = Achievement::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lomba', 'like', "%{$search}%")
                  ->orWhere('peringkat', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $achievements = $query->orderByDesc('tahun')->paginate(15)->withQueryString();

        return view('admin.prestasi.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(AchievementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageUploadService::upload($request->file('foto'), 'achievements', 800, 600);
        }

        Achievement::create($data);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi baru berhasil ditambahkan ke etalase piala!');
    }

    public function edit(Achievement $prestasi)
    {
        $achievement = $prestasi;
        return view('admin.prestasi.edit', compact('achievement'));
    }

    public function update(AchievementRequest $request, Achievement $prestasi)
    {
        $achievement = $prestasi;
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            ImageUploadService::delete($achievement->foto);
            $data['foto'] = ImageUploadService::upload($request->file('foto'), 'achievements', 800, 600);
        }

        $achievement->update($data);

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui!');
    }

    public function destroy(Achievement $prestasi)
    {
        $achievement = $prestasi;
        ImageUploadService::delete($achievement->foto);
        $achievement->delete();

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus.');
    }
}
