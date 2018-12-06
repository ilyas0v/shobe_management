@extends("admin.layout")
@section('title','Equipments')
@section("content")
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">All acts</h1>
            @include('admin.partials.messages')
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>#</th>
                        <th>Act no</th>
                        <th>Employee</th>
                        <th>Equipment</th>
                        <th>Date</th>
                        <th>File</th>
                    </tr>
                    @foreach($acts as $act)
                        <tr>
                            <td>{{$act->id}}</td>
                            <td>{{$act->act_no}}</td>
                            <td>{{$act->employee->name . " " . $act->employee->surname}}</td>
                            <td><a href="{{route('equipment.show',$act->equipment->id)}}" target="_blank">{{$act->equipment->name}}</a></td>
                            <td>{{$act->date}}</td>
                            <td>
                                @if($act->file !== "")
                                    <a class="badge badge-success" href="{{asset($act->file)}}" target="_blank">File</a></td>
                            @else
                                <p class="badge badge-danger">No file</p>
                                @endif
                                </td>

                                <td>
                                    <a href="{{route('act.edit',$act->id)}}" class="btn btn-warning btn-action">Edit</a>
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection