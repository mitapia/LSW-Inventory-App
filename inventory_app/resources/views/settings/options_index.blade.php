@extends('master')

@section('title', ucfirst($page) )

@section('content')
    <style>
/*    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }*/
    </style>
<div class="row">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <form onsubmit="return confirm('Are you sure you wish to delete this entry from the table?')">
            {!! csrf_field() !!}
        @foreach($entry as $item)
          <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td><button type="submit" formmethod="post" formaction="{{ action('OptionsController@postDestroy', [ 'option' => $page, 'id' => $item->id ]) }}">Remove</button></td>
          </tr>
        @endforeach
            </form>
            <tr>
                <form action="{{ action('OptionsController@postStore', [ 'option' => $page ]) }}" method="post">
                    {!! csrf_field() !!}
                    <td><input type="number" name="id"></td>
                    <td><input type="text" name="name"></td>
                    <td><input type="submit" value="Add"></td>
                </form>
            </tr>
        </tbody>
    </table>
</div>    
@endsection