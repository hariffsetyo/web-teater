<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $articles = $query->latest()->paginate(15)->withQueryString();

        return view('admin.artikel.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = ImageUploadService::upload($request->file('thumbnail'), 'articles', 1000, 600);
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Article::create($data);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil disimpan!');
    }

    public function edit(Article $artikel)
    {
        $article = $artikel;
        return view('admin.artikel.edit', compact('article'));
    }

    public function update(ArticleRequest $request, Article $artikel)
    {
        $article = $artikel;
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            ImageUploadService::delete($article->thumbnail);
            $data['thumbnail'] = ImageUploadService::upload($request->file('thumbnail'), 'articles', 1000, 600);
        }

        if ($data['status'] === 'published' && empty($article->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $artikel)
    {
        $article = $artikel;
        ImageUploadService::delete($article->thumbnail);
        $article->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
