@extends('master')

@section('title', 'Price Rules')

@section('content')
    <div class="row">
        <a class="btn btn-default" href="{{ route('settings.price_rule.create') }}" role="button">New Price Rule</a>
    </div>
	<form>
		<table class="table table-bordered">
			<thead>
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
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		    @foreach($price_rules as $rule)
		      <tr>
		        <td>{{$rule->priority}}</td>
		        <td>{{$rule->minimum_cost}}</td>
		        <td>{{$rule->maximum_cost}}</td>
		        <td>
		        @if ( count($rule->department) == $total_departments )
		        	<em>All</em>
		        @else
			        @foreach($rule->department as $dep)
			        {{$dep->name}}, 
			        @endforeach
		        @endif
		        </td>
		        <td>
		        @if ( count($rule->category) == $total_categories )
		        	<em>All</em>
		        @else
			        @foreach($rule->category as $cat)
			        {{$cat->name}} |
			        @endforeach
		        @endif
		        </td>
		        <td>
		        @if ( count($rule->vendor) == $total_vendors )
		        	<em>All</em>
		        @else
			        @foreach($rule->vendor as $vendor)
			        {{$vendor->name}}, 
			        @endforeach
		        @endif
		        </td>
		        <td>{{$rule->item_description}}</td>
		        <td>{{$rule->regular_price}}</td>
		        <td>{{$rule->custom_price_2}}</td>
		        <td>{{$rule->custom_price_3}}</td>
		        <td><button disabled>Edit</button><button disabled>Remove</button></td>
		      </tr>
		    @endforeach
		    </tbody>
		</table>
	</form>
@endsection