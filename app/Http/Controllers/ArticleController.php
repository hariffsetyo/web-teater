<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('pages.artikel.index');
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Prevent double view counts per session
        $sessionKey = 'viewed_article_' . $article->id;
        if (!session()->has($sessionKey)) {
            $article->increment('views');
            session()->put($sessionKey, true);
        }

        // Estimasi waktu baca (rata-rata 180 kata per menit)
        $readingTime = max(1, (int) ceil(str_word_count(strip_tags($article->konten)) / 180));

        // Artikel terkait
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->where('kategori', $article->kategori)
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedArticles->count() < 3) {
            $relatedArticles = Article::where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('pages.artikel.show', compact('article', 'readingTime', 'relatedArticles'));
    }
}