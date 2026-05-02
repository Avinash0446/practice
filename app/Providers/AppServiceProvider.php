<?php

namespace App\Providers;

use App\Interfaces\PaymentInterface;
use App\Models\User;
use App\Observers\UserObserver;
use App\Services\StripePaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\postsInterface;
use App\Repositories\PostsRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(postsInterface::class, PostsRepository::class);
        $this->app->bind(PaymentInterface::class, StripePaymentService::class);
        Log::info('AppServiceProvider.');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // User::observe(UserObserver::class);
    }
}
