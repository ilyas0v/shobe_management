@extends("admin.layout")
@section('title','All tasks')
@section("content")
<div class="main-content" style="min-height: 282px;">
    <section class="section">
        <h1 class="section-header">Tasks</h1>
        @include('admin.partials.messages')
        <a href="{{route('task.create')}}" class="btn btn-success">Add new task</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Assigned from</th>
                    <th>Assigned to</th>
                    <th>Deadline</th>
                </tr>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->employee->name}}</td>
                        <td>{{$task->assignedUsers()}}</td>
                        <td>{{$task->deadline}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="DISPLAY: flex;
    justify-content: center;">{{ $tasks->links() }}</div>
    </section>
</div>
@endsection


