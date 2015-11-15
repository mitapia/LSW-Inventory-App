@extends('master')

@section('head')
    <style>
    /*table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }*/
    </style>
@endsection


@section('title', 'User List')


@section('content')
    <div><h1>All Users</h1></div>

    </br></br>
    <table style="width:100%">
    	<tr>
    		<th>User ID</th>
    		<th>Name</th>
    		<th>Username</th>
            <th>Permission</th>
    	</tr>
        @foreach($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->permission->name}}</td>
          </tr>
        @endforeach
    </table>


    </br>
    <br>
    <br>
    <a href="{{ url('dashboard') }}">Go back to dashboard</a>
@endsection