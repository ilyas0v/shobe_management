@extends("admin.layout")
@section('title','Add new employee')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Add new employee</h1>
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
            <form action="{{route('employee.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input placeholder="Name" type="text" value="{{old("name")}}" name="name" class="form-control">
                        <input placeholder="Surname" type="text" value="{{old("surname")}}" name="surname" class="form-control">
                        <input placeholder="Email" type="email" value="{{old("email")}}" name="email" class="form-control">
                        <input placeholder="Phone" type="text" value="{{old("phone")}}" name="phone" class="form-control">
                        <input placeholder="Address" type="text" value="{{old("address")}}" name="address" class="form-control">
                        <input placeholder="Date of birth" type="date" value="{{old("date_of_birth")}}" name="date" class="form-control">
                        <select class="form-control" name="department_id" id="">
                            <option value="0">Select department</option>
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