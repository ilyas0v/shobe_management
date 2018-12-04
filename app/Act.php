<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    public function employee(){
        $this->belongsTo('App\Employee','employee_id');
    }

    public function equipment(){
        $this->belongsTo('App\Equipment','equipment_id');
    }
}
