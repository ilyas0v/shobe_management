<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentCategory extends Model
{
    public function equiptments(){
        return $this->hasMany('App\Equipment','category');
    }
}
