@extends('master')

@section('head')
  <style type="text/css">
/*  .checkbox-grid li {
      display: block;
      float: left;
      width: 33%;
  }*/
  </style>
@endsection


@section('title', 'Price Rules')


@section('content')


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
  <form action="{{ route('price_rule.store') }}"  method="post">
    <ul class="checkbox-grid">
    	<fieldset>
    	<legend>Choose Department(s):</legend>
    		<li><input type="checkbox" name="select-all-departments" id="dep"/><label for="dep">Select All</label></li>
	      @foreach($departments as $department)
	        <li><input type="checkbox" name="department[]" value="{{$department->id}}" id="dep-{{$department->id}}"/><label for="dep-{{$department->id}}">{{$department->name}}</label></li>
	      @endforeach
		</fieldset>
    </ul>
    <ul class="checkbox-grid">
    	<fieldset>
    	<legend>Choose Category(ies):</legend>
    		<li><input type="checkbox" name="select-all-categories" id="cat"/><label for="cat">Select All</label></li>
      @foreach($categories as $category)
        <li><input type="checkbox" name="category[]" value="{{$category->id}}" id="cat-{{$category->id}}"/><label for="cat-{{$category->id}}">{{$category->name}}</label></li>
      @endforeach
      </fieldset>
    </ul>
    <ul class="checkbox-grid">
    	<fieldset>
    	<legend>Choose Vendor(s):</legend>
    		<li><input type="checkbox" name="select-all-vendors" id="ven"/><label for="ven">Select All</label></li>
      @foreach($vendors as $vendor)
        <li><input type="checkbox" name="vendor[]" value="{{$vendor->id}}" id="ven-{{$vendor->id}}"/><label for="ven-{{$vendor->id}}">{{$vendor->name}}</label></li>
      @endforeach
      </fieldset>  
    </ul>

	Min: <input type="number" name="min" min="0.01" step="any" value="{{ old('min') }}"><br>
	Max: <input type="number" name="max" min="0.01" step="any" value="{{ old('max') }}">    

	Item Description: <input type="text" name="item_description" value="{{ old('item_description') }}"><br>
	Regular Price: <input type="number" name="regular_price" min="0.01" step="any" value="{{ old('regular_price') }}">
	Employee Price: <input type="number" name="employee_price" min="0.01" step="any" value="{{ old('employee_price') }}">
	Wholesale Price: <input type="number" name="wholesale_price" min="0.01" step="any" value="{{ old('wholesale_price') }}">

	Priority: <input type="number" name="priority" min="1" step="1" value="{{ old('priority') }}">
	<input type="checkbox" name="rewards" id="rewards" checked /><label for="rewards">Available for Rewards</label>
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<input type="submit" value="Submit">
  </form>

  <script type="text/javascript">
  	// functionality of 'Select all' checkboxes
  	$('input[type="checkbox"]').click(function () {
		switch ($(this).attr("name")) {
  		 	case 'select-all-departments':
     			$('input[name="department[]"]').prop('checked', this.checked);
     			break;
  		 	case 'select-all-categories':
  		 		$('input[name="category[]"]').prop('checked', this.checked);
     			break;
  			case 'select-all-vendors':
     			$('input[name="vendor[]"]').prop('checked', this.checked);  
     			break;			
  			case 'department[]':
  				$('input[name="select-all-departments"]').prop('checked', false);
  				break;
  			case 'category[]':
  				$('input[name="select-all-categories"]').prop('checked', false);
  				break;
  			case 'vendor[]':
  				$('input[name="select-all-vendors"]').prop('checked', false);
  				break;
  		}
	});
  </script>
</div>
@endsection