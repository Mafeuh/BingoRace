<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Active les routes nécessaires pour l'authentification des channels privés
        Broadcast::routes();

        // Charge les définitions de canaux privés
        require base_path('routes/channels.php');
    }
}
