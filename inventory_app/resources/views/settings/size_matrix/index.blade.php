@extends('master')

@section('title', 'Size Matrix')

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
        <a class="btn btn-primary" href="{{ route('settings.size_matrix.create') }}" role="button">New Size Matrix</a>
    </div>

  <div class="row">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>Vendor Name</th>
                <th>Action</th>
                @for ($i=0; $i <= 13; $i++) 
                    <th>{{$i}}_K</th>
                @endfor
                
                @for ($i=0; $i <= 14; $i += 0.5) 
                    <th>{{$i}}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
        @foreach($matices as $row)
          <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->vendor['name'] }}</td>
            <td><button disabled>Edit</button><button disabled>Remove</button></td>
            @for ($i=0; $i <= 13; $i++) 
                <td @if ($row->{$i.'_K'} > 0) class="success" @endif>{{ $row->{$i.'_K'} }}</td>
            @endfor
            
            @for ($i=0; $i <= 14; $i += 0.5) 
                <td @if ($row->{str_replace('.', '_', strval($i)) . '_A'} > 0) class="success" @endif>{{ $row->{str_replace('.', '_', strval($i)) . '_A'} }}</td>
            @endfor
          </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection