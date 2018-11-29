<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Department;
use App\Room;
use App\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('deleted',0)->get();
        $campuses = Campus::all();
        $rooms = Room::where('deleted',0)->get();
        return view('admin.room.index')->withRooms($rooms)->withDepartments($departments)->withCampuses($campuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('deleted',0)->get();
        $campuses = Campus::all();
        return view('admin.room.create')->withDepartments($departments)->withCampuses($campuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'string|required|max:50',
            'type' => 'string|required|max:50',
            'phone' => 'string',
            'campus_id' => 'required|integer',
            'department_id' => 'required|integer',
            'status' => 'integer',
            'number_of_seats' => 'required'
        ]);

        $room = Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'phone' => $request->phone,
            'number_of_seats' => $request->number_of_seats,
            'campus_id' => $request->campus_id,
            'department_id' => $request->department_id,
            'status' => $request->status
        ]);

        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach($images as $image) {
                $filename = rand(1111, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $location = 'room_images/originals/'.$filename;
                $location_thumb = 'room_images/thumbnails/'.$filename;
                Image::make($image)->save($location);
                Image::make($image)->resize(300,300)->save($location_thumb);
                $img_obj = new RoomImage();
                $img_obj->url = $location;
                $img_obj->room_id = $room->id;
                $img_obj->thumb_url = $location_thumb;
                $img_obj->save();
            }
        }

        Session::flash('success' , 'Room has been added');

        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        return view('admin.room.details')->withRoom($room);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        $departments = Department::where('deleted',0)->get();
        $campuses = Campus::all();
        return view('admin.room.edit')->withRoom($room)->withDepartments($departments)->withCampuses($campuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'name' => 'string|required|max:50',
            'type' => 'string|required|max:50',
            'phone' => 'string',
            'campus_id' => 'required|integer',
            'department_id' => 'required|integer',
            'status' => 'integer',
            'number_of_seats' => 'required'
        ]);

        $room = Room::find($id);
        $room->name = $request->input('name');
        $room->type = $request->input('type');
        $room->phone = $request->input('phone');
        $room->campus_id = $request->input('campus_id');
        $room->department_id = $request->input('department_id');
        $room->status = $request->input('status');
        $room->number_of_seats = $request->input('number_of_seats');

        $room->save();

        Session::flash('success', 'Room has been updated..');

        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        $room->deleted = 1;
        $room->save();

        Session::flash('success' , 'Room has been deleted.');
        
        return redirect()->route('room.index');
    }
}
