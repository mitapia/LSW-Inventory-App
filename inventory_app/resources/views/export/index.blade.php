@extends('master')

@section('title', 'Export')

@section('content')
<div><h1>Item for Exporting</h1></div>

@if ($reorder_count > 0)
<p class="bg-warning"><strong>{{$reorder_count}} items are for reorder.</strong>  Yellow lines mean they are reorders</p>
@endif
@if ($missing_price_rule >0)
<p class="bg-danger"><strong>{{$missing_price_rule}} items have serious errors.</strong>  Red cells mean there is an error and that item will be not be exported</p>
@endif

<form action="{{route('export.store')}}" method="POST">
    {{ csrf_field() }}

    <div class="checkbox">
        <label>
            <input type="checkbox" name="close_invoice" value="yes" checked> 
            Close all open Invoices after Export.
        </label>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered table-condensed">
        <thead>
        	<tr>
                <th></th>
        		<th>Style</th>
        		<th>Color</th>
                <th>Department</th>
        		<th>Size</th>
                <th>Invoice Number</th>
                <th>Price Rule</th>
        	</tr>
        </thead>
        <tbody>
        <?php $n=1 ?>
        @foreach($items as $item)
              <tr @if ($item->reorder) class="warning" @endif>
                <td>{{ $n++ }}</td>
                <td>{{ $item->inventory_prep->style }}</td>
                <td>{{ $item->inventory_prep->color }}</td>
                <td>{{ $item->inventory_prep->department->name }}</td>
                <td>{{ $item->size}}</td>
                <td>{{ $item->inventory_prep->invoice->invoice_number }}</td>
                <td{!! isset($item->price_rule->item_description) ? '>'.$item->price_rule->item_description : ' class="danger">No matching Price Rule Found' !!}</td>
              </tr>
        @endforeach
        </tbody>
    </table>
    </div>

    <input type="submit" class="btn btn-success btn-lg" name="submit" value="Export" >
</form>
@endsection
