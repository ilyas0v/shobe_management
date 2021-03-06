@extends("admin.layout")
@section('title','Departments')
@section("content")
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
                    <th>Number of rooms</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                @foreach($departments as $department)
                <tr>
                    <td>{{$department->id}}</td>
                    <td>{{$department->name}}</td>
                    <td>{{count($department->rooms)}}</td>
                    <td>
                        @if($department->status == 1)
                        <div class="badge badge-success">Active</div>
                        @else
                            <div class="badge badge-danger">Passive</div>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('department.show', $department->id)}}" class="btn btn-action btn-secondary get-detail" data-id="{{$department->id}}">Detail</a>
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
@endsection


