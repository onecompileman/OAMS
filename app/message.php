<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $table="message";
    protected $dateFormat = 'U'
;    protected $dates=['created_at'];
}
