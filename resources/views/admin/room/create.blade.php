@extends("admin.layout")
@section('title','Add new room')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Add new room</h1>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <form action="{{route('room.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input  placeholder="Name" type="text" value="{{old("name")}}" name="name" class="form-control">
                        <select name="type" class="form-control">
                            <option value="class">Class</option>
                            <option value="office">Office</option>
                            <option value="other">Other</option>
                        </select>
                        <input placeholder="Number of seats" type="number" class="form-control" name="number_of_seats">
                        <input placeholder="Phone"  type="text" class="form-control" name="phone">
                        <select name="campus_id" class="form-control">
                            @foreach($campuses as $campus)
                                <option value="{{$campus->id}}">{{$campus->name}}</option>
                            @endforeach
                        </select>

                        <select name="department_id" class="form-control">
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="">
                            <option value="">Status</option>
                            <option value="1">Active</option>
                            <option value="0">Passive</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>
@endsection