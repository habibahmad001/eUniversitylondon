<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavigation();
    }

    /**
     * Register the application services.
     *
     * @return void
     */

    public function composeNavigation(){

        view()->composer('partials.navigation','App\Http\Composers\NavigationComposer@compose');

    }

    public function register()
    {
        //
    }
}
