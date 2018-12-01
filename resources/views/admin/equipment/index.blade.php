@extends("admin.layout")
@section('title','Equipments')
@section("content")
<div class="main-content" style="min-height: 282px;">
    <section class="section">
        <h1 class="section-header">Equipments</h1>
        @include('admin.partials.messages')
        <a href="{{route('equipment.create')}}" class="btn btn-success">Add new equipment</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                @foreach($equipments as $equipment)
                <tr>
                    <td>{{$equipment->id}}</td>
                    <td>{{$equipment->name}}</td>
                    <td>{{$equipment->model}}</td>
                    <td>
                        @if($equipment->status == 1)
                        <div class="badge badge-success">Active</div>
                        @elseif($equipment->status == 2)
                            <div class="badge badge-warning">Malfunctioning</div>
                        @else
                            <div class="badge badge-danger">Passive</div>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('equipment.show', $equipment->id)}}" class="btn btn-action btn-secondary get-detail" data-id="{{$equipment->id}}">Detail</a>
                        <a href="{{route('equipment.edit',$equipment->id)}}" class="btn btn-action btn-warning">Edit</a>
                        <a  class="btn btn-danger btn-action" onclick="if(confirm('are u sure?')){$('#deleteform').submit()}" href="#">Delete</a>
                        <form id="deleteform" style="display: inline" action="{{route('equipment.destroy',$equipment->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="delete" />
                        </form>
                        <a href="#"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection


