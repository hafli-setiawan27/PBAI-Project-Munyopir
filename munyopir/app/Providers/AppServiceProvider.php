<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewInstance;

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
        RateLimiter::for('login', function (Request $request): Limit {
            $email = $request->input('email');
            $normalizedEmail = is_string($email) ? Str::lower($email) : '';

            return Limit::perMinute(5)->by(
                Str::transliterate($normalizedEmail.'|'.($request->ip() ?? '')),
            );
        });

        View::composer('layouts.app', function (ViewInstance $view): void {
            $unreadNotificationCount = auth()->user()?->notifications()->whereNull('read_at')->count() ?? 0;

            $view->with('unreadNotificationCount', $unreadNotificationCount);
        });
    }
}
