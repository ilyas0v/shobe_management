@extends("admin.layout")

@section("content")
<div class="main-content" style="min-height: 282px;">
    <section class="section">
        <h1 class="section-header">Deparments</h1>
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
                    <td><a href="#" class="btn btn-action btn-secondary">Detail</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
