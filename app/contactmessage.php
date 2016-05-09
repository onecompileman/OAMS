<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactmessage extends Model
{
    protected $table = 'contactmessage';
   // protected $dates= ['created_at','deleted_at'];
    protected $dateFormat = 'U';
    public $timestamps = true;
}
