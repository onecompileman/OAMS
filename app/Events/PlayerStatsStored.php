<?php

namespace App\Events;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PlayerStatsStored extends Event
{
    use SerializesModels;
    public $playerStats;
    public $athlete_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($playerStats,$athlete_id)
    {
        $this->playerStats=$playerStats;
        $this->athlete_id=$athlete_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
