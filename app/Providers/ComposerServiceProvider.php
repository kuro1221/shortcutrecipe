<?php

namespace App\Providers;

use App\Application;
use App\Http\ViewComposers\userComposer;
use App\Http\ViewComposers\applicationComposer;
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
