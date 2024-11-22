<?php


namespace App\Providers;

use App\Models\Agendamentos;
use App\Observers\AgendamentosObserver;
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
        Agendamentos::observe(AgendamentosObserver::class);
    }
}