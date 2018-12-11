<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function category(){
        return $this->belongsTo('App\EquipmentCategory' , 'category');
    }

    public function employee(){
        return $this->belongsTo('App\Employee' , 'given_to');
    }

    public function acts(){
        return $this->hasMany('App\Act','equipment_id');
    }

    public function features(){
        return $this->hasMany('App\Feature','equipment_id');
    }

}
