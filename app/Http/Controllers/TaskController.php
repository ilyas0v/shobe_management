<?php

namespace App\Http\Controllers;

use App\Employee;
use App\TaskAssignment;
use Illuminate\Support\Facades\Session;
use Validator;
use Mail;
use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('admin.task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('deleted',0)->where('department_id',1)->get();
        $clients = Employee::where('deleted',0)->get();
        return view('admin.task.create' , compact('employees','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());


        $this->validate($request , [
            'title' => 'required|max:100',
            'description' => 'max:10000',
            'employee_id' => 'integer|exists:employees,id',
            //'user_ids' => 'required|numericarray',
            'start_date' => 'required|date',
            'deadline' => 'date'
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->employee_id = $request->employee_id;
        $task->start_date = $request->start_date;
        $task->deadline = $request->deadline;

        $task->save();


        foreach($request->user_ids as $user_id){
            $ta = new TaskAssignment();
            $ta->task_id = $task->id;
            $ta->user_id = $user_id;
            $ta->save();
        }

        $assignments = $task->assignments;
        foreach($assignments as $assignment){

            $user = $assignment->user;
            $data = ['task' => $task,  'user' => $user];
            Mail::send('admin.task.mail', $data, function($message) use( &$task,&$user) {
                $message->to($user->email, 'Test')->subject
                ($task->title);
                $message->from('xyz@gmail.com','Shobe management system');
            });
        }

        Session::flash('success' , 'Task has been created and assigned to users');

        return redirect()->route('task.index');
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
