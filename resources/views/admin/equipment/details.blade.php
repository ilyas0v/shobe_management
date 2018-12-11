@extends("admin.layout")
@section('title','Departments')
@section("content")
    @include('admin.partials.image')
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">{{$equipment->name}}</h1>
            <h2>Acts for {{$equipment->name}}</h2>
            <div class="table-respnsive">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Act no</th>
                        <th>Employee name</th>
                        <th>Date</th>
                        <th>File</th>
                    </tr>
                    @foreach($equipment->acts as $act)
                        <tr>
                            <td>{{$act->id}}</td>
                            <td>{{$act->act_no}}</td>
                            <td>{{$act->employee->name . " " . $act->employee->surname}}</td>
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

                </table>
            </div>

            <h3>Features</h3>
            <ul>
                @foreach($equipment->features as $feature)
                    <li>{{$feature->key}} : {{$feature->value}}</li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection


