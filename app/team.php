<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
 protected $table="team";
    public function sport(){
       return $this->hasOne('App\sport','id','sport_id');
    }
}
