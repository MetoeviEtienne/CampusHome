<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Les événements à écouter et leurs écouteurs.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Exemple :
        // \App\Events\ReservationApprouvee::class => [
        //     \App\Listeners\EnvoyerNotificationEtudiant::class,
        // ],
    ];

    /**
     * Enregistrement des événements.
     */
    public function boot(): void
    {
        //
    }
}
