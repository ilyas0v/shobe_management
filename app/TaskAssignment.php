<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    public function user(){
        return $this->belongsTo(Employee::class,'user_id');
    }
}
