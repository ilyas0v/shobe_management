<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function employees(){
        return $this->hasMany('App\Employee','department_id');
    }
}
