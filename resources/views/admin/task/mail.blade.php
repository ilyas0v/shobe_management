<h1>Salam , {{$user->name}}</h1>
<h2>Bu task sene assign olunub : <a href="{{route('task.show',$task->id)}}">{{$task->title}}</a></h2>

<p>{{$task->description}}</p>