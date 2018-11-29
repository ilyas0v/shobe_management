@extends('admin.layout')

@section('content')

    <div class="main-content" style="min-height: 282px;">
        <section class="section">
            <h1 class="section-header">{{$employee->name . " " . $employee->surname}}</h1>
            <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-action btn-warning mb-2">Edit</a>
            <table class="table" border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th>Date of birth</th>
                </tr>
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->surname}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>{{$employee->address}}</td>
                    <td>{{$employee->department->name}}</td>
                    <td>{{$employee->date_of_birth}}</td>
                </tr>
            </table>
            <h2>List of requests</h2>
            <table class="table" border="1">
                <tr>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </table>

            <h2>List of equipments</h2>
            <table class="table" border="1">
                <tr>
                    <th>#</th>
                    <th>#</th>
                </tr>
            </table>
        </section>
    </div>

@endsection