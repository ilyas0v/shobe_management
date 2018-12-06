@extends("admin.layout")
@section('title','Assign equipment')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Edit {{$act->act_no}} act</h1>
            @include('admin.partials.messages')
            @foreach($errors->all() as $e)
                <p class="alert alert-danger">{{$e}}</p>
            @endforeach

                <form action="{{route('act.update',$act->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col col-md-9">
                            <input name="employee" id="employee" value="{{$act->employee->id."@".$act->employee->name." ".$act->employee->surname}}" type="text" list="employees" class="form-control" placeholder="Assign to:">
                            <datalist id="employees">
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id . "@" .$employee->name. " " . $employee->surname}}">
                                @endforeach
                            </datalist>
                            <input type="text" placeholder="Act no" class="form-control" value="{{$act->act_no}}" name="act_no">
                            <input type="date" placeholder="Date" class="form-control" value="{{$act->date}}" name="date">
                            <input type="file" name="file[]" class="form-control">
                        </div>
                        <div class="col col-md-3">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <a onclick="$('#employee').val('');$('#employee').focus()" class="btn btn-danger" href="#" >Clear</a>
                            <button type="reset" class="">Reset</button>
                        </div>
                    </div>
                </form>
        </section>
    </div>
@endsection


