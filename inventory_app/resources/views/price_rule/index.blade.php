@extends('master')

@section('title', 'Price Rules')

@section('content')
	<form>
		<table style="width:100%">
			<tr>
				<th>Priority</th>
				<th>Min Price</th>
				<th>Max Price</th>
				<th>Department</th>
				<th>Category</th>
				<th>Vendor</th>
				<th>Item Description</th>
				<th>Regular Price</th>
				<th>Employee Price</th>
				<th>Wholesale Price</th>
			</tr>
		    @foreach($price_rules as $rule)
		    	
		      <tr>
		        <td>{{$rule->priority}}</td>
		        <td>{{$rule->minimum_cost}}</td>
		        <td>{{$rule->maximum_cost}}</td>
		        <td>{{$rule->}}</td>
		        <td>{{$rule->priority}}</td>
		      </tr>

		    @endforeach
		</table>
	</form>
@endsection