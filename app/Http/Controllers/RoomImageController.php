<?php

namespace App\Http\Controllers;

use App\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RoomImageController extends Controller
{
    public function destroy($id){
        $image = RoomImage::find($id);
        $oi  = $image->url;
        $ti  = $image->thumb_url;
        File::delete($oi);
        File::delete($ti);
        $image->delete();
        return 'ok';
    }
}
