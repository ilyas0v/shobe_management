@extends("admin.layout")
@section('title','Add new room')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Edit room : {{$room->name}}</h1>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <form action="{{route('room.update',$room->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT" >
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input  placeholder="Name" type="text" value="{{$room->name}}" name="name" class="form-control">
                        <select name="type" class="form-control">
                            <option {{$room->type == 'class' ? 'selected' : ''}} value="class">Class</option>
                            <option {{$room->type == 'office' ? 'selected' : ''}} value="office">Office</option>
                            <option {{$room->type == 'other' ? 'selected' : ''}} value="other">Other</option>
                        </select>
                        <input placeholder="Number of seats" value="{{$room->number_of_seats}}" type="number" class="form-control" name="number_of_seats">
                        <input placeholder="Phone"  type="text" value="{{$room->phone}}" class="form-control" name="phone">
                        <select name="campus_id" class="form-control">
                            @foreach($campuses as $campus)
                                <option {{$room->campus_id == $campus->id ? 'selected' : ''}} value="{{$campus->id}}">{{$campus->name}}</option>
                            @endforeach
                        </select>

                        <select name="department_id" class="form-control">
                            @foreach($departments as $department)
                                <option {{$room->department_id == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="">
                            <option value="">Status</option>
                            <option {{$room->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$room->status == 0 ? 'selected' : ''}} value="0">Passive</option>
                        </select>

                        <div class="row mt-2">
                            @foreach($room->images as $image)
                                <div class="col-md-4" id="image-{{$image->id}}">
                                    <img src="{{asset($image->thumb_url)}}" class="img-thumbnail" alt="">
                                    <a href="#"  onclick="delete_image({{$image->id}},'{{route('image.delete',$image->id)}}')" style="position:absolute;display:block;top:5px;right:5px;padding: 10px;color:white;background:red">X</a>
                                </div>
                            @endforeach
                                <label>
                                    <p class="btn btn-outline-success">Select images</p>
                                    <input style="display: none;" type="file" multiple name="images[]" >
                                </label>

                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>

    <script>
        function delete_image(id,url){
            $.ajax({
                method : 'GET',
                url : url,
                success : function(data){
                    if(data=='ok'){
                        $('#image-'+id).remove();
                    }
                },
                error :  function(e){
                    alert(e);
                }
            });
        }
    </script>
@endsection