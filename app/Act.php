<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    public function employee(){
        return $this->belongsTo('App\Employee','employee_id');
    }

    public function equipment(){
        return $this->belongsTo('App\Equipment','equipment_id');
    }
}
