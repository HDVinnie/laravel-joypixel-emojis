<?php

namespace hdvinnie\LaravelJoyPixels;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class LaravelJoyPixelsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/joypixels.php' => config_path('joypixels.php')], 'config');

        $this->publishes([
            base_path('vendor/joypixels/assets/png') => public_path('vendor/joypixels/png'),
        ], 'public');

        $this->publishes([
            base_path('vendor/joypixels/assets/sprites') => public_path('vendor/joypixels/sprites'),
        ], 'sprites');

        \Blade::directive('joypixels', function ($expression) {
            return "<?php echo \App::make('".LaravelJoyPixels::class."')->toImage($expression); ?>";
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/joypixels.php', 'emojione');
        $this->app->singleton(LaravelJoyPixels::class, function (Container $app) {
            return new LaravelJoyPixels();
        });
    }
}
