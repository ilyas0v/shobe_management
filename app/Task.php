<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function assignments(){
        return $this->hasMany(TaskAssignment::class , 'task_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function users(){
        return $this->belongsToMany(Employee::class,'task_assignments' , 'task_id','user_id');
    }

    public function assignedUsers(){
        $a = [];
        foreach ($this->users as $user){
            $a[] = $user->name;
        }

        return implode(', ' , $a);
    }
}
