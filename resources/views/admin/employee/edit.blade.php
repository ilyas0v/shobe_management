@extends("admin.layout")
@section('title','Add new employee')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Edit employee</h1>
            @if($errors->has('name'))
                {{$errors->first('name')}}
            @endif

            @if($errors->has('surname'))
                {{$errors->first('surname')}}
            @endif

            @if($errors->has('email'))
                {{$errors->first('email')}}
            @endif

            @if($errors->has('date'))
                {{$errors->first('date')}}
            @endif

            @if($errors->has('address'))
                {{$errors->first('address')}}
            @endif

            @if($errors->has('phone'))
                {{$errors->first('phone')}}
            @endif

            @if($errors->has('department_id'))
                {{$errors->first('department_id')}}
            @endif

            @if($errors->has('status'))
                {{$errors->first('status')}}
            @endif
            <form action="{{route('employee.update',$employee->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input placeholder="Name" type="text" value="{{$employee->name}}" name="name" class="form-control">
                        <input placeholder="Surname" type="text" value="{{$employee->surname}}" name="surname" class="form-control">
                        <input placeholder="Email" type="email" value="{{$employee->email}}" name="email" class="form-control">
                        <input placeholder="Phone" type="text" value="{{$employee->phone}}" name="phone" class="form-control">
                        <input placeholder="Address" type="text" value="{{$employee->address}}" name="address" class="form-control">
                        <input placeholder="Date of birth" type="date" value="{{$employee->date_of_birth}}" name="date_of_birth" class="form-control">
                        <select class="form-control" name="department_id" id="">
                            <option value="0">Select department</option>
                            @foreach($departments as $department)
                                <option {{$department->id == $employee->department_id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="">
                            <option value="">Status</option>
                            <option {{$employee->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$employee->status == 0 ? 'selected' : ''}} value="0">Passive</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>
@endsection