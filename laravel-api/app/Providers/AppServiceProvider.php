<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // ... register method ...

    public function boot()
    {
        // Add this entire block to the boot method:
        Route::middleware('api') // Applies the 'api' middleware group
            ->prefix('api')      // Applies the /api/ prefix to all routes
            ->group(base_path('routes/api.php'));
        
        // Optional: Load web routes if you have them
        // Route::middleware('web')
        //     ->group(base_path('routes/web.php'));

        // If your Laravel version is 11 or newer, it might have a file 
        // like routes.php in the root, where you can also add this logic.
    }
}
