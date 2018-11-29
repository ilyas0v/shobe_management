<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    public function room(){
        $this->belongsTo('App\Room','room_id');
    }
}
