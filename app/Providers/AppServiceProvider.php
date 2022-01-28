<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('password_hash_check', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });

        //iCloudリンクの形式かどうか確認
        Validator::extend('link_check', function ($attribute, $value, $parameters, $validator) {
            return (0 === strpos($value, "https://www.icloud.com/shortcuts/",));
        });
    }
}
