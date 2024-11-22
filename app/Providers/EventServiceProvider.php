<?php

namespace App\Providers;

use App\Models\Agendamentos;  // Corrigido: era Agendamento
use App\Observers\AgendamentosObserver;  // Corrigido: era AgendamentoObserver
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Agendamentos::observe(AgendamentosObserver::class);  // Corrigido: eram Agendamento e AgendamentoObserver
    }
}