@extends("admin.layout")
@section('title','Departments')
@section("content")
<div class="main-content" style="min-height: 282px;">
    <section class="section">
        <h1 class="section-header">Rooms</h1>
        @include('admin.partials.messages')
        <a href="{{route('room.create')}}" class="btn btn-success">Add new room</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Number of seats</th>
                    <th>Department</th>
                    <th>Campus</th>
                    <th></th>
                </tr>
                @foreach($rooms as $room)
                <tr>
                    <td>{{$room->id}}</td>
                    <td>{{$room->name}}</td>
                    <td>{{$room->type}}</td>
                    <td>{{$room->number_of_seats}}</td>
                    <td>{{$room->department->name}}</td>
                    <td>{{$room->campus->name}}</td>
                    <td>
                        @if($room->status == 1)
                        <div class="badge badge-success">Active</div>
                        @else
                            <div class="badge badge-danger">Passive</div>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('department.show', $room->id)}}" class="btn btn-action btn-secondary get-detail" data-id="{{$room->id}}">Detail</a>
                        <a href="{{route('department.edit',$room->id)}}" class="btn btn-action btn-warning">Edit</a>
                        <form style="display: inline" action="{{route('department.destroy',$room->id)}}" method="POST">
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


