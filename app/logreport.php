<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logreport extends Model
{
    //
    protected $table='logreport';
    public $timestamps=false;
    public function logreportview(){
        return $this->hasMany('App\logreportview','log_id','id');
    }
}
