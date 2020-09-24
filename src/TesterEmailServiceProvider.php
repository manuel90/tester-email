<?php

namespace Manuel90\TesterEmail;

use Illuminate\Support\ServiceProvider;



use TCG\Voyager\Facades\Voyager;

class TesterEmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'testeremail');
        $this->loadTranslationsFrom(__DIR__.'/../publishable/lang', 'testeremail');
        $this->publishes([__DIR__."/assets" => public_path('manuel90/testeremail')], 'public');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
