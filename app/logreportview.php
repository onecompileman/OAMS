<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logreportview extends Model
{
    //
    protected $table='logreportview';
    public $timestamps=false;
    public function staff_id(){
        return $this->hasMany('App\staff','id','staff_id');
    }
    public function logreport(){
        return $this->hasMany('App\logreport','id','log_id');
    }
}
