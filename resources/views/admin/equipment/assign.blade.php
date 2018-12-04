@extends("admin.layout")
@section('title','Assign equipment')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Assign {{$equipment->name}}</h1>
            @include('admin.partials.messages')
            @foreach($errors->all() as $e)
                <p class="alert alert-danger">{{$e}}</p>
            @endforeach
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Serial</th>
                    </tr>
                    <tr>
                        <td>{{$equipment->id}}</td>
                        <td>{{$equipment->name}}</td>
                        <td>{{$equipment->model}}</td>
                        <td>{{$equipment->serial}}</td>
                    </tr>
                    </tbody>
                </table>

                <form action="{{route('equipment.assign_update',$equipment->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col col-md-9">
                            <input name="employee" id="employee" value="{{$equipment->employee->id."@".$equipment->employee->name." ".$equipment->employee->surname}}" type="text" list="employees" class="form-control" placeholder="Assign to:">
                            <datalist id="employees">
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id . "@" .$employee->name. " " . $employee->surname}}">
                                @endforeach
                            </datalist>
                            <input type="text" placeholder="Act no" class="form-control" name="act_no">
                            <input type="date" placeholder="Date" class="form-control" name="date">
                            <input type="file" name="file[]" class="form-control">
                        </div>
                        <div class="col col-md-3">
                            <input type="submit" class="btn btn-primary" value="Assign">
                            <a onclick="$('#employee').val('');$('#employee').focus()" class="btn btn-danger" href="#" >Clear</a>

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection


