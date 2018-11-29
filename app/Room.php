<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function department(){
        return $this->belongsTo('App\Department' , 'department_id');
    }

    public function campus(){
        return $this->belongsTo('App\Campus' , 'campus_id');
    }

    protected $fillable = ['name' , 'department_id' , 'campus_id' , 'phone' , 'type' , 'status' , 'number_of_seats'];
}
