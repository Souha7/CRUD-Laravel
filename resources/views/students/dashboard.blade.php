@extends('layouts.app')


@section('content')

@if($message = Session::get('success'))

    <div class="alert alerrt-success">
        <p>{{$message}}</p>
    </div>

@endif

<div class="row">

    <div class="col-md-12">

        <div class="pull-left">
        
            <marquee behavior="" direction="">Laravel 5.8 Simple CRUD</marquee>
            <div class="pull-right">
            <a href="{{ route('students.create')}}" class="btn btn-lg btn-success">Register New Student</a>
            </div>

        </div>

        

    </div>

</div>

<table class="table table-bordered table-dark">
    <tr>

        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Country</th>
        <th>City</th>
        <th>Adress</th>
        <th>Action</th>

    </tr>

    @foreach($students as $key => $student)

        <tr>
        
            <td>{{++$key}}</td>
            <td>{{$student->firstname}}</td>
            <td>{{$student->lastname}}</td>
            <td>{{$student->gender}}</td>
            <td>{{$student->country}}</td>
            <td>{{$student->city}}</td>
            <td>{{$student->adress}}</td>

            <td>
            
                <form action="{{ route('students.destroy', $student->id) }}" method="post">

                    <button type="submit" class="btn btn-danger">Delete</button>
                    @method('DELETE')
                    @csrf

                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning">Show</a>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info">Edit</a>

                
                </form>

            </td>

        </tr>

        @endforeach

</table>


    


@endsection