<?php

namespace Sukohi\LaravelJpPostalCode;

use Illuminate\Support\ServiceProvider;
use Sukohi\LaravelJpPostalCode\App\Console\Commands\ImportJpPostalCodeCommand;

class LaravelJpPostalCodeServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var  bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Config
        $this->mergeConfigFrom(__DIR__.'/config/jp_postal_code.php', 'jp_postal_code');

        // Route
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        // Migration
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Publishing File
        $this->publishes([
            __DIR__.'/config/jp_postal_code.php' => config_path('jp_postal_code.php'),
        ], 'config');

        // Command
        if ($this->app->runningInConsole()) {

            $this->commands([
                 ImportJpPostalCodeCommand::class,
            ]);

        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-jp-postal-code'];
    }

}
