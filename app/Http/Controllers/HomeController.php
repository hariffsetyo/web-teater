<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Member;
use App\Models\Performance;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Counter Statistik
        $stats = [
            'members'      => Member::where('status', 'aktif')->count(),
            'performances' => Event::where('tipe', 'pementasan')->count() ?: Event::count(),
            'achievements' => Achievement::count(),
            'alumni'       => Member::where('status', 'alumni')->count(),
        ];

        // 2. Pementasan Mendatang (Countdown Real-time)
        $upcomingPerformance = Performance::with('event')
            ->where('status', 'buka')
            ->whereHas('event', function ($query) {
                $query->where('tanggal_mulai', '>=', now());
            })
            ->first();

        // Fallback jika belum ada pementasan masa depan yang buka
        if (!$upcomingPerformance) {
            $upcomingPerformance = Performance::with('event')->latest()->first();
        }

        // 3. Divisi Ekskul & Statistik Anggotanya
        $divisionCounts = Member::where('status', 'aktif')
            ->selectRaw('divisi, count(*) as count')
            ->groupBy('divisi')
            ->pluck('count', 'divisi')
            ->toArray();

        $divisions = [
            [
                'key'         => 'akting',
                'name'        => 'Divisi Akting & Peran',
                'icon'        => '🎭',
                'description' => 'Mendalami penghayatan karakter, gestur tubuh, vokal, dan metode Stanislavski di atas panggung sandiwara.',
                'count'       => $divisionCounts['akting'] ?? 0,
                'skills'      => ['Olah Vokal', 'Ekspresi Emosi', 'Blocking Panggung', 'Karakterisasi'],
            ],
            [
                'key'         => 'naskah',
                'name'        => 'Divisi Penulisan Naskah',
                'icon'        => '📜',
                'description' => 'Menciptakan lakon dramatik, dialog tajam, dramatergi, dan adaptasi sastra ke dalam format skenario teater.',
                'count'       => $divisionCounts['naskah'] ?? 0,
                'skills'      => ['Struktur Tiga Babak', 'Pembangunan Konflik', 'Bedah Lakon', 'Sinopsis'],
            ],
            [
                'key'         => 'tata_rias',
                'name'        => 'Divisi Tata Rias & Busana',
                'icon'        => '💄',
                'description' => 'Merancang karakterisasi wajah, efek luka/tua (SFX make-up), serta kostum tematik yang memperkuat suasana pentas.',
                'count'       => $divisionCounts['tata_rias'] ?? 0,
                'skills'      => ['Special Effects', 'Karakter Usia', 'Desain Kostum', 'Aksesoris'],
            ],
            [
                'key'         => 'tata_panggung',
                'name'        => 'Divisi Tata Panggung & Cahaya',
                'icon'        => '🎪',
                'description' => 'Membangun set artistik panggung, properti teatrikal, serta tata cahaya (lighting cue) yang memukau penonton.',
                'count'       => $divisionCounts['tata_panggung'] ?? 0,
                'skills'      => ['Lighting Cue', 'Setting Panggung', 'Properti Artistik', 'Rigging'],
            ],
            [
                'key'         => 'musik',
                'name'        => 'Divisi Musik & Efek Suara',
                'icon'        => '🎻',
                'description' => 'Menyusun ilustrasi musik latar, lagu tema teatrikal, dan efek bunyi dramatik pengiring setiap adegan emosional.',
                'count'       => $divisionCounts['musik'] ?? 0,
                'skills'      => ['Ilustrasi Musik', 'Foley Sound', 'Komposisi Lagu', 'Live Scoring'],
            ],
            [
                'key'         => 'humas',
                'name'        => 'Divisi Humas & Dokumentasi',
                'icon'        => '📸',
                'description' => 'Menjembatani teater dengan audiens luar, promosi tiket, liputan pementasan, serta pengelolaan media sosial resmi.',
                'count'       => $divisionCounts['humas'] ?? 0,
                'skills'      => ['Manajemen Tiket', 'Desain Poster', 'Dokumentasi Sinematik', 'Press Release'],
            ],
        ];

        // 4. Galeri Sorotan (6 Foto Terbaru)
        $featuredGalleries = Gallery::with('event')
            ->latest()
            ->take(6)
            ->get();

        // 5. Artikel & Wawasan Terbaru (3 Card)
        $latestArticles = Article::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        // 6. Testimoni Featured
        $testimonials = Testimonial::where('featured', true)->latest()->take(6)->get();
        if ($testimonials->count() < 3) {
            $testimonials = Testimonial::latest()->take(6)->get();
        }

        // 7. Prestasi Terbaru (Preview)
        $recentAchievements = Achievement::orderByDesc('tahun')->take(4)->get();

        return view('home', compact(
            'stats',
            'upcomingPerformance',
            'divisions',
            'featuredGalleries',
            'latestArticles',
            'testimonials',
            'recentAchievements'
        ));
    }
}