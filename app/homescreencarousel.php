<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class homescreencarousel extends Model
{
    protected $table="homescreencarousel";

    protected $dates=['created_at','deleted_at'];
    protected $dateFormat = 'U';
}
