<?php

namespace App\Providers;
use App\Http\Controllers\playerStatsScrap;
use App\Http\Controllers\WebScrap;
use Illuminate\Support\ServiceProvider;

class PlayerStatsScrapProvider extends ServiceProvider
{


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('playerStatsScrap',function(){
            return new playerStatsScrap(WebScrap::class);
        });
    }
}
