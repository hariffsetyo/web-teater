<?php

namespace App\Http\Controllers;

use App\Models\PodcastEpisode;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('kategori');
        $search = $request->query('q');

        $query = PodcastEpisode::query()->where('published_at', '<=', now());

        if (!empty($category)) {
            $query->where('kategori', $category);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $episodes = $query->orderBy('published_at', 'desc')->paginate(9)->withQueryString();

        $categories = [
            ''                  => 'Semua Kategori',
            'drama_audio'       => '🎙️ Drama Audio',
            'behind_the_scenes' => '🎭 Di Balik Layar',
            'wawancara'         => '👥 Wawancara Tokoh',
        ];

        return view('pages.podcast.index', compact('episodes', 'categories', 'category', 'search'));
    }

    public function show($id)
    {
        $episode = PodcastEpisode::findOrFail($id);

        $related = PodcastEpisode::where('id', '!=', $episode->id)
            ->where('kategori', $episode->kategori)
            ->take(3)
            ->get();

        if ($related->count() < 3) {
            $related = PodcastEpisode::where('id', '!=', $episode->id)->latest()->take(3)->get();
        }

        return view('pages.podcast.show', compact('episode', 'related'));
    }

    public function recordPlay($id)
    {
        $sessionKey = 'played_podcast_' . $id;
        if (!session()->has($sessionKey)) {
            PodcastEpisode::where('id', $id)->increment('jumlah_play');
            session()->put($sessionKey, true);
        }

        return response()->json(['success' => true]);
    }
}