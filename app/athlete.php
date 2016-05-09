<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class athlete extends Model
{
    public $timestamps=true;
    protected $table='athlete';
    public function playerstatsbasketball(){
        return $this->hasMany('App\playerstatsbasketball','id','athlete_id');
    }
    public function setCreatedAtAttribute(){
        $this->attributes['created_at']=date('Y-m-d');
    }
}
