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


@section('title', 'Change Password')


@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('password/reset') }}">
    {!! csrf_field() !!}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



                <div class="form-group">
                    <label class="col-md-4 control-label">Username</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="username" value="{{ $username }}" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success">
                            Reset
                        </button>
                    </div>
                </div>
</form>
@endsection