<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('deleted','=',0)->get();
      return view("admin.department.index")->withDepartments($departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view("admin.department.create")->withDepartments($departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name" => "required|string",
            "description" => "required",
            "status" => "integer|required",
            "parent_id" => "integer"
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->status = $request->status;
        $department->description = $request->description;
        $department->parent_id = $request->parent_id;

        $department->save();

        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        return $department;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        $departments = Department::all();
        if($department){
            return view("admin.department.edit")->withDepartment($department)->withDepartments($departments);
        }
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
        $department = Department::find($id);
        $this->validate($request , [
            "name" => "required",
            "description" => "required|min:5|max:1000",
            "parent_id" => "integer",
            "status" => "integer"
        ]);

        $department->name = $request->input('name');
        $department->description = $request->input('description');
        $department->status = $request->input('status');
        $department->parent_id = $request->input('parent_id');

        $department->save();
        Session::flash('success', 'Department has been successfully updated..');
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->deleted = 1;
        $department->save();

        Session::flash('success' , 'Department has been deleted');

        return redirect()->route('department.index');
    }
}
