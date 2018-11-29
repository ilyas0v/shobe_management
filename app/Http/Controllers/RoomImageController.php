<?php

namespace App\Http\Controllers;

use App\RoomImage;
use Illuminate\Http\Request;

class RoomImageController extends Controller
{
    public function destroy($id){
        $image = RoomImage::find($id);
        $oi  = $image->url;
        $ti  = $image->thumb_url;
//        unlink(asset($oi));
//        unlink(asset($ti));
        $image->delete();
        return 'ok';
    }
}
