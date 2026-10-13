<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Blade::anonymousComponentPath(resource_path('views/layouts'), 'layouts');

        // View Composer untuk layout admin: badge pendaftaran, komentar, tiket pending
        \Illuminate\Support\Facades\View::composer(['layouts.admin', 'components.layouts.admin'], function ($view) {
            try {
                $pendingRegCount = \App\Models\Registration::where('status', 'pending')->count();
                $pendingCommentCount = \App\Models\Comment::where('status', 'pending')->count();
                $pendingTicketCount = \App\Models\TicketReservation::where('status', 'pending')->count();
            } catch (\Throwable $e) {
                $pendingRegCount = 0;
                $pendingCommentCount = 0;
                $pendingTicketCount = 0;
            }

            $view->with(compact('pendingRegCount', 'pendingCommentCount', 'pendingTicketCount'));
        });
    }
}
