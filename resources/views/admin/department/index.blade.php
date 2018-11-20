@extends("admin.layout")
@section('title','Departments')
@section("content")
@include('admin.partials.department-detail-modal')
<div class="main-content" style="min-height: 282px;">
    <section class="section">
        <h1 class="section-header">Deparments</h1>
        @include('admin.partials.messages')
        <a href="{{route('department.create')}}" class="btn btn-success">Add new department</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                @foreach($departments as $department)
                <tr>
                    <td>{{$department->id}}</td>
                    <td>{{$department->name}}</td>
                    <td>
                        @if($department->status == 1)
                        <div class="badge badge-success">Active</div>
                        @else
                            <div class="badge badge-danger">Passive</div>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn btn-action btn-secondary get-detail" data-id="{{$department->id}}">Detail</a>
                        <a href="{{route('department.edit',$department->id)}}" class="btn btn-action btn-warning">Edit</a>
                        <form style="display: inline" action="{{route('department.destroy',$department->id)}}" method="POST">
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


