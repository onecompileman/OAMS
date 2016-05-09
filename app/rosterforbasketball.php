<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rosterforbasketball extends Model
{
    protected $table='rosterforbasketball';
    public $timestamps=false;
    public function athlete(){
        return $this->hasOne('App\athlete','id','player_id');
    }
}
