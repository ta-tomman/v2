<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // set custom storage directory
        $path = env('PATH_STORAGE', false);
        if ($path) {
            if (!file_exists($path)) {
                // make sure the path have necessary structure
                $origin = realpath(__DIR__ . '/../..').DIRECTORY_SEPARATOR.'storage';
                \File::copyDirectory($origin, $path);
            }

            $this->app->useStoragePath($path);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
