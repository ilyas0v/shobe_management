@extends("admin.layout")
@section('title','Departments')
@section("content")
@include('admin.partials.department-detail-modal')
<div class="main-content" style="min-height: 282px;">
    <section class="section">
        <h1 class="section-header">Employees</h1>
        @include('admin.partials.messages')
        <a href="{{route('employee.create')}}" class="btn btn-success">Add new employee</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->surname}}</td>
                    <td>{{$employee->department->name ?? ''}}</td>
                    <td>
                        @if($employee->status == 1)
                        <div class="badge badge-success">Active</div>
                        @else
                            <div class="badge badge-danger">Passive</div>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('employee.show' , $employee->id)}}" class="btn btn-action btn-secondary get-detail" data-id="{{$employee->id}}">Detail</a>
                        <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-action btn-warning">Edit</a>
                        <a class="btn btn-action btn-danger" href="#" onclick="if(confirm('Are you sure to delete {{$employee->name}} ?')){$('#deleteform').submit()}">Delete</a>
                        <form id="deleteform" style="display: inline" action="{{route('employee.destroy',$employee->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="delete" />
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
    $('.get-detail').on('click' , function(){
        var id = $(this).data('id');
        $.ajax({
            url : "department/"+id,
            method : 'GET',
            success : function(data){
                console.log(data);
                //data  =  JSON.parse(data);
                $("#exampleModalLongTitle").text(data.name);
                $("#department-description").text(data.description);
                $('#exampleModalLong').modal('show');
            },
            error : function(e){
                console.log(e);
            }
        })
    });
</script>
@endsection


