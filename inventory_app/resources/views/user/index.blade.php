@extends('master')

@section('head')
@endsection


@section('title', 'User List')


@section('content')
    <div><h1>All Users</h1></div>

    <div class="pagination">
        <a class="btn btn-success" href="{{ url('auth/register') }}">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Register new user
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
        	<tr>
        		<th>User ID</th>
        		<th>Name</th>
        		<th>Username</th>
                <th>Permission</th>
                <th>Action</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->permission->name}}</td>
            <td class="col-center-block">
                {!! Form::open(array('route' => array('user.destroy', $user->id), 'method' => 'delete')) !!}
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                <a class="btn btn-warning btn-sm" href="{{ url('password/reset', $user->username) }}">Reset Password</a>
                {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
        </tbody>        
    </table>
    
    <a class="btn btn-primary" href="{{ url('dashboard') }}">
        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Go back to dashboard
    </a>
@endsection