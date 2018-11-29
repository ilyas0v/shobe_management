<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public function rooms(){
        return $this->hasMany('App\Room','campus_id');
    }
}
