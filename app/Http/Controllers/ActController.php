<?php

namespace App\Http\Controllers;

use App\Act;
use App\Employee;
use Illuminate\Support\Facades\File;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acts = Act::orderBy('id','DESC')->get();
        return view('admin.act.index',compact('acts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $act = Act::find($id);
        $employees = Employee::all();
        return view('admin.act.edit',compact('act'),compact('employees'));
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
        $employee = $request->employee;
        $emp_id = explode('@',$employee)[0];
        $data = ['emp_id' => $emp_id , 'act_no' => $request->act_no , 'file' => $request->file,'date'=>$request->date];
        $validator = Validator::make($data, [
            'emp_id' => 'integer|exists:employees,id',
            //'file' => 'max:10000|mimes:jpg,pdf,doc,docx',
            'date' => 'date',
            'act_no' => 'max:100'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $act = Act::find($id);
        $act->employee_id = $emp_id;
        $act->equipment_id = $id;
        $act->date = $data['date'];
        $act->act_no = $data['act_no'];

        if($request->hasFile('file')){
            $file = $request->file('file')[0];
            $destination = 'act_files';
            $file_name = time().".".$file->getClientOriginalExtension();
            $file->move($destination,$file_name);
            File::delete($act->file);
            $act->file = $destination."/".$file_name;
        }

        $act->save();

        Session::flash('success' , 'Act has been changed');

        return redirect()->route('equipment.show',$act->equipment->id);
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
