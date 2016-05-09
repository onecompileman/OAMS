<?php

namespace App\Providers;

use App\Http\Controllers\WebScrap;
use Illuminate\Support\ServiceProvider;

class WebScrapProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('WebScrap',function($url){
           return new WebScrap($url);
        });
    }
}
