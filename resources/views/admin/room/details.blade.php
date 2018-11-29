@extends("admin.layout")
@section('title','Departments')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">{{$department->name}}</h1>
            <h2>Employees of this department:</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th></th>
                    </tr>
                    @foreach($department->employees as $employee)
                        <tr>
                            <td>{{$employee->id}}</td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->surname}}</td>
                            <td>
                                <a href="#" class="btn btn-action btn-secondary get-detail" data-id="{{$employee->id}}">Detail</a>
                                <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-action btn-warning">Edit</a>
                                <form style="display: inline" action="{{route('employee.destroy',$employee->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button type="submit" class="btn btn-action btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection


