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
                    <th>Holder</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                @foreach($equipments as $equipment)
                <tr>
                    <td>{{$equipment->id}}</td>
                    <td>{{$equipment->name}}</td>
                    <td>{{$equipment->model}}</td>
                    <td>{{ count($equipment->acts) > 0 ? $equipment->acts->last()->employee->name : ''}}</td>
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
                        <a href="{{route('equipment.assign',$equipment->id)}}" class="btn btn-primary btn-action">Assign</a>
                        <a href="{{route('equipment.show', $equipment->id)}}" class="btn btn-action btn-secondary get-detail" data-id="{{$equipment->id}}">Detail</a>
                        <a href="{{route('equipment.edit',$equipment->id)}}" class="btn btn-action btn-warning">Edit</a>
                        <a  class="btn btn-danger btn-action" onclick="if(confirm('are u sure?')){$('#deleteform_{{$equipment->id}}').submit()}" href="#">Delete</a>
                        <form id="deleteform_{{$equipment->id}}" style="display: inline" action="{{route('equipment.destroy',$equipment->id)}}" method="POST">
                            @csrf
                            @method('delete')
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


