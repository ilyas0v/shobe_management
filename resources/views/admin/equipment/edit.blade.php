@extends("admin.layout")
@section('title','edit equipment')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Edit equipment</h1>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <form action="{{route('equipment.update',$equipment->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input  placeholder="Name" type="text" value="{{$equipment->name}}" name="name" class="form-control">
                        <input  placeholder="Model" type="text" value="{{$equipment->model}}" name="model" class="form-control">
                        <input  placeholder="Serial" type="text" value="{{$equipment->serial}}" name="serial" class="form-control">
                        <input  placeholder="Inventory number" type="text" value="{{$equipment->inventory_no}}" name="inventory_no" class="form-control">
                        <input  placeholder="Purchase date" type="date" value="{{$equipment->purchase_date}}" name="purchase_date" class="form-control">
                        <input  placeholder="Price" type="text" value="{{$equipment->price}}" name="price" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="">
                            <option value="">Status</option>
                            <option {{$equipment->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$equipment->status == 2 ? 'selected' : ''}} value="2">Malfunc..</option>
                            <option {{$equipment->status == 0 ? 'selected' : ''}} value="0">Passive</option>
                        </select>
                        <label>
                            <p class="btn btn-outline-success mb-1 mt-2">Select images</p>
                            <input style="display: none;" type="file" class="form-control" name="images[]" multiple placeholder="Choose images">
                        </label>

                        {{--<div class="row">--}}
                        {{--@foreach($equipment->images as $image)--}}
                            {{--<div class="col-md-3">--}}
                                {{--<img src="{{assets($image->)}}" alt="" class="img-responsive">--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                        {{--</div>--}}
                            
                        <div id="type_fields"></div>
                        <button class="btn btn-primary" id="add_feature_btn">+ extra feature</button>
                        <div class="mt-2" id="features">
                            @foreach($equipment->features as $feature)
                                <div class="form-group" style="box-shadow:1px 1px 10px grey;padding:5px;position:relative !important">
                                    <p style="position:absolute;top:0;right:0;background: red;color:white;padding:5px;"  onclick="$(this).parent().remove()">×</p>
                                    <label>Feature name</label>
                                    <input type="text" name="feature_name_old[]" value="{{$feature->key}}" class="form-control">
                                    <label>Feature value</label>
                                    <input type="text" name="feature_value_old[]" value="{{$feature->value}}" class="form-control">
                                    <input type="hidden" name="feature_id_old[]" value="{{$feature->id}}">
                                </div>
                            @endforeach
                        </div>
                        <div class="features_of_type"></div>

                    </div>
                </div>
                <input type="hidden" name="equipment_type" value="0">
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>

    <script>
        var k=0;


        $("#add_feature_btn").on('click' , function(e){
            e.preventDefault();
            $("#features").append(`
            <div class="form-group" style="box-shadow:1px 1px 10px grey;padding:5px;position:relative !important">
                <p style="position:absolute;top:0;right:0;background: red;color:white;padding:5px;"  onclick="$(this).parent().remove()">×</p>
                <label>Feature name(${++k})</label>
                <input type="text" name="feature_name_new[]" class="form-control">
                <label>Feature values(${k})</label>
                <input type="text" name="feature_value_new[]" class="form-control">
            </div>
            <hr>
            `);
        });




    </script>
@endsection