<?php

namespace App\Providers;

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
        $compiledViews = env('VIEW_COMPILED_PATH') ?: sys_get_temp_dir().DIRECTORY_SEPARATOR.'kasukaali-views';

        if (! is_dir($compiledViews)) {
            mkdir($compiledViews, 0777, true);
        }

        config(['view.compiled' => $compiledViews]);
    }
}
