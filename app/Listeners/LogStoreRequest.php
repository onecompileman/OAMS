<?php

namespace App\Listeners;

use App\Events\EventExecuted;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\logreport;
use App\staff;
use App\logreportview;
class LogStoreRequest
{
    public $staff;
    public $logreport;
    public $logreportview;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->logreportview= new logreportview();
        $this->logreport = new logreport();
        $this->staff = new staff();
    }

    /**
     * Saves any CRUD that transpires in the models
     *
     * @param  EventExecuted  $event
     * @return void
     */
    public function handle(EventExecuted $event)
    {
        $logData=['model'=>$event->model,'action'=>$event->action,'user_id'=>$event->user,'created_at'=>date('Y-m-d h:i:s A'),'user_idTo'=>$event->receiver];
        $this->logreport->insert($logData);
        $staff_id=$this->staff->get(['id']);
        foreach($staff_id as $sid) $this->logreportview->insert(['staff_id'=>$sid->id,'log_id'=>($this->logreport->max('id'))]);
    }
}
