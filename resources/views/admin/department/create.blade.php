@extends("admin.layout")

@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Add new department</h1>
            <form action="{{route('department.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input placeholder="Name" type="text" name="name" class="form-control">
                        <textarea placeholder="Description" name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                        <select class="form-control" name="parent_id" id="">
                            <option value="0">Select parent department</option>
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