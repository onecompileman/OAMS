<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventExecuted extends Event
{
    use SerializesModels;
    public $user;
    public $model;
    public $action;
    public $receiver;
    /**
     * Create a new event instance.
     * @param user string
     * @param model string
     * @param action string
     * @return void
     */
    public function __construct($user,$receiver,$model,$action)
    {
        $this->action=$action;
        $this->user=$user;
        $this->model=$model;
        $this->receiver = $receiver;
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
