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

@section('title', 'Invoice')

@section('content')
    <div><h1>Submited Form</h1></div>

    <h2>Vendor:  </h2>{{$invoice->vendor->name}}
    <h2>Invoice ID:  </h2>{{$invoice->invoice_number}}

    </br></br>
    page# {{$invoice->page_number}} of {{$invoice->total_pages}} pages

    </br>
    Notes:  {{$invoice->notes}}
    </br></br>

    Status: @if ($invoice->open)
        Open
    @else
        Close
    @endif
    </br>
    <table style="width:100%">
    	<tr>
    		<th>Style</th>
    		<th>Cost</th>
    		<th>Size</th>
    		<th>Department</th>
    		<th>Color</th>
    	</tr>
        @foreach($invoice->inventory_prep as $item)
          <tr>
            <td>{{$item->style}}</td>
            <td>{{$item->cost}}</td>
            <td>{{$item->size_matrix->name}}</td>
            <td>{{$item->department->name}}</td>
            <td>{{$item->color}}</td>
          </tr>
        @endforeach
    </table>


    </br>
    <br>
    <br>
    <a href="{{ url('dashboard') }}">Go back to dashboard</a>


    <br>
    <a href="{{ route('detail.create', [ 'id' => $invoice->id ]) }}">Enter Inventory Details</a>
    <a href="{{ route('quantity.create', [ 'id' => $invoice->id ]) }}">Enter Available Quantity</a>
@endsection
