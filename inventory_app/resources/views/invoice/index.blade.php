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
    <div><h1>All Submited Forms</h1></div>

    </br></br>
    <table style="width:100%">
    	<tr>
    		<th>Invoice ID</th>
    		<th>Vendor</th>
    		<th>Notes</th>
            <th>Page</th>
    		<th># of Items</th>
            <th>Created by</th>
    		<th>Created date</th>
    	</tr>
        @foreach($invoices as $invoice)
          <tr>
            <td><a href="{{ route('invoice.show', ['id' => $invoice->id]) }}">
            {{$invoice->invoice_number}} 
            </a></td>
            <td>{{$invoice->vendor->name}}</td>
            <td>{{$invoice->notes}}</td>
            <td>{{$invoice->page_number}} of {{$invoice->total_pages}}</td>
            <td>{{count($invoice->inventory_prep)}}</td>
            <td>{{$invoice->created_by}}</td>
            <td>{{$invoice->created_at}}</td>
          </tr>
        @endforeach
    </table>


    </br>
    <br>
    <br>
    <a href="{{ url('dashboard') }}">Go back to dashboard</a>
@endsection