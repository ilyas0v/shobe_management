@extends("admin.layout")
@section('title','Add new task')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Add new task</h1>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <form action="{{route('task.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <label for="">Title</label>
                        <input  placeholder="Title" type="text" value="{{old("title")}}" name="title" class="form-control">
                        <label for="">Description</label>
                        <textarea id="" cols="30" rows="10" class="form-control description" name="description"></textarea>


                        <label for="">Assigned from:</label>
                        <select name="employee_id" class="multi_select_box form-control">
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name . " " . $client->surname}}</option>
                            @endforeach
                        </select>

                        <label for="">Assign to:</label>
                        <select name="user_ids[]" multiple  class="multi_select_box form-control">
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name . " " . $employee->surname}}</option>
                            @endforeach
                        </select>

                        <label for="">Start date:</label>
                        <input type="date" name="start_date">

                        <label for="">Deadline:</label>
                        <input type="date" name="deadline">

                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>
@endsection