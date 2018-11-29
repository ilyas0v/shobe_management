@extends("admin.layout")
@section('title','Departments')
@section("content")
    @include('admin.partials.image')
    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">{{$room->name}}</h1>
            @foreach($room->images as $image)
                <img class="images" src="{{asset($image->thumb_url)}}" width="300">
            @endforeach
        </section>
    </div>

    <script>
        $('.images').on('click' , function(){
            var url = $(this).attr('src');
            url = url.replace('thumbnails' , 'originals');
            $("#img_of_modal").attr('src' , url);
            $('#imageModal').modal('show');
        });
    </script>
@endsection


