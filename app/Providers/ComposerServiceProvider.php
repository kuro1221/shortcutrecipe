<?php

namespace App\Providers;

use App\Application;
use App\Http\ViewComposers\UserComposer;
use App\Http\ViewComposers\ApplicationComposer;
use App\Http\ViewComposers\ProductComposer;
use App\Http\ViewComposers\SituationComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composers([
            UserComposer::class => '*',
            ApplicationComposer::class => '*',
            ProductComposer::class => '*',
            SituationComposer::class => '*',
        ]);
    }
}
