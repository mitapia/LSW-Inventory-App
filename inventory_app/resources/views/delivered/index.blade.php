@extends('master')

@section('title', 'Delivered')

@section('content')
<form>
	<table style="width:100%">
		<tr>
			<th>Delivered</th>
			<th>Style</th>
			<th>Size</th>
			<th>Department</th>
			<th>Color</th>
			<th>Vendor</th>
			<th>Invoice ID</th>
		</tr>
	    @foreach($invoices as $invoice)
	    	@foreach($invoice->inventory_prep as $item)
	    		@unless($item->delivered or $item->reorder)
	      <tr>
	        <td><input type="checkbox" name="delivered" value="{{ $item->id }}"></td>
	        <td>{{$item->style}}</td>
	        <td>{{$item->size_matrix->name}}</td>
	        <td>{{$item->department->name}}</td>
	        <td>{{$item->color}}</td>
	        <td>{{$invoice->vendor->name}}</td>
	        <td>{{$invoice->invoice_number}}</td>
	      </tr>
	      	@endunless
	    	@endforeach
	    @endforeach
	</table>


</form>

<input type="submit" name="submit" id="submit" onclick="submit()">

<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('js')
<script type="text/javascript">
	function submit(){
		var selected = [];
		$("input[type='checkbox']:checked").each(
		    function() {
		    	selected.push($(this).val());
		    }
		);
		//console.log(selected)

	    $.ajax({
	        type:"post",
	        url:"{{route('delivered.store')}}",
	        data:{
	            checkbox: selected,
	            },
	        success:function(msg){
	            console.log(msg);
	            location.reload();
	            },
	        beforeSend: function (xhr) {
	          // needed to get pass auth middleware   
	          var token = $('meta[name="csrf_token"]').attr('content');

	          if (token) {
	            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	          }
	    	}
        })
    }
</script>
@endsection