<html>
    <head>
        <style>
            table td {
                border:1px solid black;
            }
            td{
                padding:10px;
            }
            table {

                border-collapse: collapse;
            }
        </style>
    </head>

    <body>
        @foreach($array as $category => $equipments)
            <h2>{{$category}}</h2>
            @if(count($equipments) > 0)
                <div>
                    <table>
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
    </body>
</html>