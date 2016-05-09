<?php

namespace App\Listeners;

use App\Events\PlayerStatsStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreComputedPlayingStyle
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PlayerStatsStored  $event
     * @return void
     */
    public function handle(PlayerStatsStored $event)
    {
        //
    }
}
