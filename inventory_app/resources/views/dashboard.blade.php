@extends('master')

@section('title', 'Dashboard')

@section('content')
	{{-- Check for vendors without size matrixes attached --}}
	@foreach ($vendors as $vendor)
		@forelse ($vendor->size_matrix as $size)
		    {{-- was left blank on purpose, only need the empty functionality --}}
		@empty
		    <p>Vendor: "{{$vendor->name}}" does not have any Size Matrix assigned</p>
		@endforelse

	@endforeach

	{{-- check for open invoices --}}
	<?php $delivered_count = 0 ?>

	@if (!empty($invoices[0]))
		<h1>Open Invoices</h1> 
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Invoice ID</th>
					<th>Vendor</th>
					<th>Notes</th>
			    <th>Page</th>
		    </tr>
			</thead>
			<tbody>
			@foreach ($invoices as $invoice)
	      <tr>
	        <td><a href="{{ route('invoice.show', ['id' => $invoice->id]) }}">
	        {{$invoice->invoice_number}} 
	        </a></td>
	        <td>{{$invoice->vendor->name}}</td>
	        <td>{{$invoice->notes}}</td>
	        <td>{{$invoice->page_number}} of {{$invoice->total_pages}}</td>
	      </tr>
			@endforeach
			</tbody>
		</table>

		{{-- check for items marked as delivered --}}
		<h1>Delivered Inventory that need attention</h1> 
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Style</th>
					<th>Size</th>
					<th>Department</th>
					<th>Color</th>
					<th>Details</th>
					<th>Quantity</th>
					<th>Vendor ID</th>
				</tr>
			</thead>
			<tbody>
		    @foreach ($invoices as $invoice)
		    	@foreach ($invoice->inventory_prep as $item)
		    		@if ($item->delivered)
		    			{{-- skip those that already have qty and details set --}}
		    			@unless ($item->detail_set && $item->quantity_set or $item->reorder)
					      <tr>
					        <th scope="row">{{$item->style}}</th>
					        <td>{{$item->size_matrix->name}}</td>
					        <td>{{$item->department->name}}</td>
					        <td>{{$item->color}}</td>

									{{-- check for qty and detials has been set --}}
					        <td>
						        @if ($item->detail_set)
						        	Completed
						        @else
						        	<a href="{{ route('detail.create', ['id' => $invoice->id]) }}">Not Completed</a>
						        @endif
					        </td>
					        <td>
						        @if ($item->quantity_set)
						        	Completed
						        @else
						        	<a href="{{ route('quantity.create', ['id' => $invoice->id]) }}">Not Completed</a>
						        @endif
					        </td>

					        <td><a href="{{ route('invoice.show', ['id' => $invoice->id]) }}">{{$invoice->invoice_number}}</a></td>
					      </tr>
			      		<?php $delivered_count++ ?>
		      		@endunless
		      	@endif
					@endforeach
				@endforeach
			</tbody>
		</table>
		@unless ($delivered_count > 0)
			<p>No inventory has been marked for delivery. Select delivered inventory <a href="{{ route('delivered.index')  }}">here</a></p>
		@endunless

	@else
	    <p class="text-center lead jumbotron">No Open Invoice. Create a <a href="{{ route('invoice.create') }}">New Invoice</a> to begin.</p>
	@endif	
@endsection
