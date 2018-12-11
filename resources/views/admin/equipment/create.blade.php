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

                        <select name="category" class="form-control">
                            <option>Select category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
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

                        {{--<select id="select_type">--}}
                            {{--<option value="0">Select equipment type</option>--}}
                            {{--<option value="1">Computer</option>--}}
                            {{--<option value="2">Printer</option>--}}
                            {{--<option value="3">Monitor</option>--}}
                        {{--</select>--}}
                        <div id="type_fields"></div>
                        <button class="btn btn-primary" id="add_feature_btn">+ extra feature</button>
                        <div class="mt-2" id="features"></div>
                        
                    </div>
                </div>
                <input type="hidden" name="equipment_type" value="0">
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>

    <script>
        var k=0;

        var computer = `
            <div>
                <input type="text" name="cpu" placeholder="CPU">
                <input type="text" name="ram" placeholder="RAM">
            </div>
        `;

        var printer = `
            <div>
                <input type="text" name="kartric" placeholder="Kartric">
                <input type="number" name="capacity" placeholder="Capacity">
            </div>
        `;

        var monitor = `
            <div>
                <input type="number" name="diognal" placeholder="Diognal">
                <input type="text" name="ports" placeholder="Ports">
            </div>
        `;


        // $("#select_type").on('change' , function(){
        //    var type = $(this).val();
        //    $('input[name="equipment_type"]').val(type);
        //    console.log(type);
        //    switch(type){
        //        case '1':
        //        $("#type_fields").html(computer);
        //        break;
        //
        //        case '2':
        //        $("#type_fields").html(printer);
        //        break;
        //
        //        case '3':
        //        $("#type_fields").html(monitor);
        //        break;
        //
        //        default:
        //        $("#type_fields").html("<h1>:/</h1>");
        //    }
        //
        // });

        $("#add_feature_btn").on('click' , function(e){
            e.preventDefault();
            $("#features").append(`
            <div class="form-group" style="box-shadow:1px 1px 10px grey;padding:5px;">
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