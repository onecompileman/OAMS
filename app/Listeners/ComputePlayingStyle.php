<?php

namespace App\Listeners;

use App\Events\PlayerStatsStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\player_style;
class ComputePlayingStyle
{
    public $player_style;

    public function __construct()
    {
        $player_style= new player_style();
    }


    public function handle(PlayerStatsStored $event)
    {

        $playerStyleData="";
    }
}
