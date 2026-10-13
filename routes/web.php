<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\PerformanceController as AdminPerformanceController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIK ROUTES (KONTEN TEATER SEKOLAH)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', fn() => view('pages.tentang'))->name('tentang');
Route::get('/anggota', fn() => redirect()->route('tentang'))->name('anggota.index');

Route::get('/event', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/pentas', fn() => redirect()->route('events.index'))->name('pentas.index');

Route::get('/galeri', fn() => view('pages.galeri.index'))->name('galeri.index');

Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');

Route::get('/prestasi', fn() => view('pages.prestasi.index'))->name('prestasi.index');

// FITUR INTERAKTIF PUBLIK (TAHAP 6)
Route::get('/gabung', fn() => view('pages.gabung.index'))->name('gabung');

Route::get('/tiket', [TicketController::class, 'index'])->name('tiket.index');
Route::get('/tiket/cek', [TicketController::class, 'cek'])->name('tiket.cek');
Route::get('/tiket/{id}', [TicketController::class, 'show'])->name('tiket.show');
Route::get('/tiket/{kode_tiket}/download', [TicketController::class, 'downloadPdf'])->name('tiket.download');

Route::get('/podcast', [PodcastController::class, 'index'])->name('podcast.index');
Route::get('/podcast/{id}', [PodcastController::class, 'show'])->name('podcast.show');
Route::post('/podcast/{id}/play', [PodcastController::class, 'recordPlay'])->name('podcast.play');

Route::get('/kuis', fn() => view('pages.kuis.index'))->name('kuis.index');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES (guard: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest-only: halaman login (redirect ke dashboard jika sudah login)
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Logout (auth required)
    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth:admin')
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | ADMIN PANEL ROUTES (dilindungi auth:admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Konten Inti
        Route::post('/anggota/bulk-alumni', [AdminMemberController::class, 'bulkAlumni'])->name('anggota.bulk-alumni');
        Route::resource('anggota', AdminMemberController::class)->parameters(['anggota' => 'member']);

        Route::resource('event', AdminEventController::class);

        Route::resource('galeri', AdminGalleryController::class);

        Route::resource('artikel', AdminArticleController::class);

        Route::resource('prestasi', AdminAchievementController::class);

        Route::post('/testimonial/{testimonial}/toggle-featured', [AdminTestimonialController::class, 'toggleFeatured'])->name('testimonial.toggle-featured');
        Route::resource('testimonial', AdminTestimonialController::class);

        Route::post('/pentas/{performance}/toggle-status', [AdminPerformanceController::class, 'toggleStatus'])->name('pentas.toggle-status');
        Route::resource('pentas', AdminPerformanceController::class);

        // Tahap Berikutnya (Keanggotaan & Operasional)
        Route::get('/absensi', fn() => view('admin.dashboard'))->name('absensi.index');
        Route::get('/inventaris', fn() => view('admin.dashboard'))->name('inventaris.index');
        Route::get('/podcast', fn() => view('admin.dashboard'))->name('podcast.index');
        Route::get('/pendaftaran', fn() => view('admin.dashboard'))->name('pendaftaran.index');
    });
});

// Redirect /dashboard lama ke /admin/dashboard
Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'))
    ->middleware('auth:admin')->name('dashboard');

/*
|--------------------------------------------------------------------------
| BREEZE AUTH ROUTES (untuk /login lama — tetap ada tapi tidak digunakan)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';