@extends("admin.layout")
@section('title', $department->name)
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Add new department</h1>
            @include('admin.partials.messages')
            <form action="{{route('department.update',$department->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <input placeholder="Name" type="text" value="{{$department->name}}" name="name" class="form-control">
                        @if ($errors->has('name'))
                            <p class="error">{{ $errors->first('name') }}</p>
                        @endif
                        <textarea placeholder="Description" name="description" class="form-control" id="" cols="30" rows="10">{{$department->description}}</textarea>
                        @if ($errors->has('description'))
                            <p class="error">{{ $errors->first('description') }}</p>
                        @endif
                        <select class="form-control" name="parent_id" id="">
                            <option value="0">Select parent department</option>
                            @foreach($departments as $dep)
                                <option {{$department->parent_id == $dep->id ? 'selected' : ''}} value="{{$department->id}}">{{$dep->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-control" id="">
                            <option value="">Status</option>
                            <option {{$department->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$department->status == 0 ? 'selected' : ''}} value="0">Passive</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>
@endsection