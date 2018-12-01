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
                        
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </section>
    </div>
@endsection