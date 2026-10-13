<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Event;
use App\Models\InventoryLog;
use App\Models\Member;
use App\Models\Performance;
use App\Models\PodcastEpisode;
use App\Models\Registration;
use App\Models\TicketReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Stat Cards
        $stats = [
            'active_members'        => Member::where('status', 'aktif')->count(),
            'events_this_month'     => Event::whereMonth('tanggal_mulai', now()->month)
                                            ->whereYear('tanggal_mulai', now()->year)
                                            ->count(),
            'pending_registrations' => Registration::where('status', 'pending')->count(),
            'tickets_sold'          => TicketReservation::whereIn('status', ['confirmed', 'hadir'])->sum('jumlah_tiket'),
            'total_article_views'   => Article::sum('views'),
            'total_podcast_plays'   => PodcastEpisode::sum('jumlah_play'),
        ];

        // 2. Chart 1: Pendaftar per Bulan (6 Bulan Terakhir)
        $regMonthsLabels = [];
        $regMonthsData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $regMonthsLabels[] = $monthDate->translatedFormat('M Y');
            $regMonthsData[] = Registration::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->count();
        }

        // 3. Chart 2: Tiket per Pementasan (Terjual vs Kuota)
        $performances = Performance::with('event')->latest()->take(5)->get();
        $perfLabels = [];
        $perfSoldData = [];
        $perfQuotaData = [];
        foreach ($performances as $perf) {
            $perfLabels[] = \Illuminate\Support\Str::limit($perf->judul_pementasan, 18);
            $perfSoldData[] = $perf->tiket_terjual;
            $perfQuotaData[] = $perf->kuota_kursi;
        }

        // 4. Chart 3: Anggota per Divisi (Donut)
        $divisiKeys = [
            'akting'        => 'Akting',
            'naskah'        => 'Naskah',
            'tata_rias'     => 'Tata Rias',
            'tata_panggung' => 'Tata Panggung',
            'musik'         => 'Musik',
            'humas'         => 'Humas',
        ];
        $divisiLabels = array_values($divisiKeys);
        $divisiData = [];
        foreach (array_keys($divisiKeys) as $key) {
            $divisiData[] = Member::where('divisi', $key)->where('status', 'aktif')->count();
        }

        // 5. Chart 4: Artikel Terpopuler (Top 5 Views)
        $topArticles = Article::orderByDesc('views')->take(5)->get();
        $articleLabels = [];
        $articleViewsData = [];
        foreach ($topArticles as $art) {
            $articleLabels[] = \Illuminate\Support\Str::limit($art->judul, 16);
            $articleViewsData[] = (int) $art->views;
        }

        // 6. Widgets
        $upcomingEvents = Event::where('tanggal_mulai', '>=', now()->subDay())
            ->orderBy('tanggal_mulai')
            ->take(4)
            ->get();

        $recentRegistrations = Registration::latest()->take(5)->get();

        $unreturnedInventory = InventoryLog::with('inventoryItem')
            ->where('status', 'dipinjam')
            ->orderBy('tanggal_kembali_rencana')
            ->take(4)
            ->get();

        $pendingComments = Comment::with('article')
            ->where('status', 'pending')
            ->latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'regMonthsLabels',
            'regMonthsData',
            'perfLabels',
            'perfSoldData',
            'perfQuotaData',
            'divisiLabels',
            'divisiData',
            'articleLabels',
            'articleViewsData',
            'upcomingEvents',
            'recentRegistrations',
            'unreturnedInventory',
            'pendingComments'
        ));
    }
}
