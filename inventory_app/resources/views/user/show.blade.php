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


@section('title', 'Profile')


@section('content')
    <div><h1>Profile</h1></div>

    </br>
    Username: {{$user->username}}</br>
    Name:   {{$user->name}}</br>
    Privilage level: {{$user->permission->name}}


    
    <br>
    <br>
    <a href="{{ url('dashboard') }}">Go back to dashboard</a>
@endsection