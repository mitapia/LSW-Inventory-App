@extends('master')

@section('title', 'Reorder')

@section('content')
<div><h1>Reorder List for {{$date}}</h1></div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Item Number</th>
            <th>Style</th>
            <th>Color</th>
            <th>Size</th>
            <th>Vendor</th>
            <th>UPC</th>
        </tr>
    </thead>
    <tbody>l
    @foreach ($reorders as $reorder)
  <tr>
    <td>{{$reorder->inventory_prep->}}</td>
    <td>{{$reorder->inventory_prep->}}</td>
    <td>{{$reorder->inventory_prep->}}</td>
    <td>{{$reorder->inventory_prep->}}</td>
    <td>{{$reorder->inventory_prep->}}</td>
    <td>{{$reorder->inventory_prep->}}</td>
  </tr>
    @endforeach
    </tbody>
</table>


@endsection
