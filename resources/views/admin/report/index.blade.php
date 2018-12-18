@extends("admin.layout")
@section('title','Departments')
@section("content")
<div class="main-content" style="min-height: 282px;">
    <section class="section">
        <h1 class="section-header">Reports <a class="btn btn-primary" href="{{route('reports.download')}}">Download report</a></h1>

        @foreach($array as $category => $equipments)
            <h2 class="badge badge-success">{{$category}}</h2>
            @if(count($equipments) > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($equipments as $equipment)
                                <tr>
                                    <td>{{$equipment->id}}</td>
                                    <td>{{$equipment->name}}</td>
                                    <td>{{$equipment->model}}</td>
                                    <td>{{$equipment->serial}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No equipment found for <b>{{$category}}</b></p>
            @endif
        @endforeach

    </section>
</div>
@endsection


