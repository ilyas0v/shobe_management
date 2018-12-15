@extends("admin.layout")
@section('title','Add new equipment')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">Add new equipment</h1>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <form action="{{route('equipment.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input  placeholder="Name" type="text" value="{{old("name")}}" name="name" class="form-control">
                        <input  placeholder="Model" type="text" value="{{old("model")}}" name="model" class="form-control">
                        <input  placeholder="Serial" type="text" value="{{old("serial")}}" name="serial" class="form-control">
                        <input  placeholder="Inventory number" type="text" value="{{old("inventory_no")}}" name="inventory_no" class="form-control">
                        <input  placeholder="Purchase date" type="date" value="{{old("purchase_date")}}" name="purchase_date" class="form-control">
                        <input  placeholder="Price" type="text" value="{{old("price")}}" name="price" class="form-control">

                        <select name="category" id="select_type" class="form-control">
                            <option>Select category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                        <select name="room_id"  class="form-control">
                            <option>Select room</option>
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}">{{$room->name}}-{{$room->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="">
                            <option value="">Status</option>
                            <option value="1">Active</option>
                            <option value="2">Malfunc..</option>
                            <option value="0">Passive</option>
                        </select>
                        <label>
                            <p class="btn btn-outline-success mb-1 mt-2">Select images</p>
                            <input style="display: none;" type="file" class="form-control" name="images[]" multiple placeholder="Choose images">
                        </label>

                        <div id="type_fields"></div>
                        <button class="btn btn-primary" id="add_feature_btn">+ extra feature</button>
                        <div class="mt-2" id="features"></div>
                        <div id="features_of_type"></div>
                        
                    </div>
                </div>
                <input type="hidden" name="equipment_type" value="0">
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>

    <script>
        var k=0;


        $("#select_type").on('change' , function(){
            var cat_id = $(this).val();
            $.ajax({
                url : 'http://localhost:8000/admin/equipment/get-feature-fields/'+cat_id,
                method : 'GET',
                success : function(data){
                    //data = JSON.parse(data);
                    console.log(data);
                    if(data !== null) $("#features_of_type").html('');
                    for(i=0;i<data.length;i++){
                        $("#features_of_type").append(`
                            <div class="form-group" style="box-shadow:1px 1px 10px grey;padding:5px;position:relative !important">
                                <p style="position:absolute;top:0;right:0;background: red;color:white;padding:5px;"  onclick="$(this).parent().remove()">×</p>
                                <label>${data[i].key}</label>
                                <input type="hidden" name="feature_name[]" value="${data[i].key}" class="form-control">
                                <input type="text" name="feature_value[]" class="form-control">
                            </div>
                        `);
                    }
                }
                ,error : function(e){
                    alert(e);
                }
            });
        });

        $("#add_feature_btn").on('click' , function(e){
            e.preventDefault();
            $("#features").append(`
            <div class="form-group" style="box-shadow:1px 1px 10px grey;padding:5px;position:relative !important">
                <p style="position:absolute;top:0;right:0;background: red;color:white;padding:5px;"  onclick="$(this).parent().remove()">×</p>
                <label>Feature name(${++k})</label>
                <input type="text" name="feature_name[]" class="form-control">
                <label>Feature values(${k})</label>
                <input type="text" name="feature_value[]" class="form-control">
            </div>
            <hr>
            `);
        });




    </script>
@endsection