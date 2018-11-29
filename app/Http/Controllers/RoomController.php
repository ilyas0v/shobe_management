<?php

namespace App\Http\Controllers;

use App\Campus;
use App\Department;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'phone' => $request->phone,
            'number_of_seats' => $request->number_of_seats,
            'campus_id' => $request->campus_id,
            'department_id' => $request->department_id,
            'status' => $request->status
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
