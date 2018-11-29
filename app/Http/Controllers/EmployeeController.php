<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::where('deleted',0)->get();
        return view('admin.employee.index')->withEmployees($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('deleted',0)->get();
        return view('admin.employee.create')->withDepartments($departments);
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
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'email|max:100',
            'address' => 'string',
            'date_of_birth' => 'date',
            'department_id' => 'integer',
            'status' => 'integer'
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->department_id = $request->department_id;
        $employee->status = $request->status;
        $employee->phone = $request->phone;
        $employee->save();

        Session::flash('success' , 'Employee has been added.');

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('admin.employee.details')->withEmployee($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $departments = Department::where('deleted',0)->get();
        return view('admin.employee.edit')->withEmployee($employee)->withDepartments($departments);
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
        $this->validate($request,[
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'email|max:100',
            'address' => 'string',
            'date_of_birth' => 'date',
            'department_id' => 'integer',
            'status' => 'integer'
        ]);

        $employee = Employee::find($id);
        $employee->name = $request->input('name');
        $employee->surname = $request->input('surname');
        $employee->email = $request->input('email');
        $employee->address = $request->input('address');
        $employee->date_of_birth = $request->input('date_of_birth');
        $employee->department_id = $request->input('department_id');
        $employee->status = $request->input('status');
        $employee->phone = $request->input('phone');
        $employee->save();

        Session::flash('success' , 'Employee has been updated.');

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::find($id);
        $emp->deleted = 1;
        $emp->save();

        Session::flash('success' , 'Employee has been deleted');

        return redirect()->route('employee.index');
    }
}
