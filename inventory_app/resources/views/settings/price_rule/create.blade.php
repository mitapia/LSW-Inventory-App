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
    <div class="row">
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    </div>
  @endif
  <form action="{{ route('settings.price_rule.store') }}"  method="post"  class="form-horizontal">
    {!! csrf_field() !!}
    <div class="form-group">
    	<fieldset>
        <legend>Choose Department(s):</legend>
        <div class="checkbox">
    		  <label>
            <input type="checkbox" name="select-all-departments"/>Select All
          </label>
        </div>
        <div class="checkbox">
	      @foreach($departments as $department)
	        <label class="col-xs-4 col-sm-3 col-md-2 col-lg-1">
            <input type="checkbox" name="department[]" value="{{$department->id}}"/>{{$department->name}}
          </label>
        @endforeach
        </div>
		  </fieldset>
    </div>
    <div class="form-group">
    	<fieldset>
      	<legend>Choose Category(ies):</legend>
        <div class="checkbox">
          <label>
      		  <input type="checkbox" name="select-all-categories"/>Select All
          </label>
        </div>
        <div class="checkbox">
        @foreach($categories as $category)
          <label class="col-xs-5 col-sm-4 col-md-3 col-lg-2">
            <input type="checkbox" name="category[]" value="{{$category->id}}"/>{{$category->name}}
          </label>
        @endforeach
        </div>
      </fieldset>
    </div>
    <div class="form-group">
    	<fieldset>
      	<legend>Choose Vendor(s):</legend>
        <div class="checkbox">
      		<label>
            <input type="checkbox" name="select-all-vendors"/>Select All
          </label>
        </div>
        <div class="checkbox">
          @foreach($vendors as $vendor)
          <label class="col-xs-5 col-sm-4 col-md-3 col-lg-2">
            <input type="checkbox" name="vendor[]" value="{{$vendor->id}}"/>{{$vendor->name}}
          </label>
          @endforeach
        </div>
      </fieldset>  
    </div>
    <div class="form-inline well">
      <fieldset>
        <legend>Set Price Range:</legend>
        <div class="form-group col-xs-5">
          <label for="min" class="control-label">Min:</label>
          <div class="input-group">
            <div class="input-group-addon">$</div>
      	    <input type="number" name="min" id="min" min="0.01" step="any" value="{{ old('min') }}" class="form-control">
          </div>
        </div>
        <div class="form-group col-xs-5">
          <label for="max" class="control-label">Max:</label>
          <div class="input-group">
            <div class="input-group-addon">$</div>
            <input type="number" name="max" id="max" min="0.01" step="any" value="{{ old('max') }}" class="form-control">  
          </div>
        </div>
      </fieldset>
    </div>
    <div class="well">
      <fieldset>
        <legend>Define desired values:</legend>

        <div class="form-group">
          <label for="priority" class="control-label col-md-3">Priority:</label>
          <div class="col-md-2">
            <input type="number" name="priority" id="priority" min="1" step="1" value="{{ null !== old('priority') ? old('priority') : $next_priority }}" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label for="item_description" class="control-label col-md-3">Item Description:</label>
          <div class="col-md-6">
            <input type="text" name="item_description" id="item_description" value="{{ old('item_description') }}" class="form-control">
          </div>
        </div>
        <div class="form-group">
      	  <label for="regular_price" class="control-label col-md-3">Regular Price:</label>
          <div class="input-group col-md-2">
          <div class="input-group-addon">$</div>
            <input type="number" name="regular_price" id="regular_price" min="0.01" step="any" value="{{ old('regular_price') }}" class="form-control">
          </div>
        </div>
        <div class="form-group">
      	  <label for="employee_price" class="control-label col-md-3">Employee Price:</label>
          <div class="input-group col-md-2">
          <div class="input-group-addon">$</div>
            <input type="number" name="employee_price" id="employee_price" min="0.01" step="any" value="{{ old('employee_price') }}" class="form-control">
          </div>
        </div>
        <div class="form-group">
      	  <label for="wholesale_price" class="control-label col-md-3">Wholesale Price:</label>
          <div class="input-group col-md-2">
          <div class="input-group-addon">$</div>
            <input type="number" name="wholesale_price" id="wholesale_price" min="0.01" step="any" value="{{ old('wholesale_price') }}" class="form-control">
          </div>
        </div>

      <div class="checkbox">
        <label>
          <input type="checkbox" name="rewards" checked />Available for Rewards
        </label>
      </div>

      </fieldset>
    </div>
  	<button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection

@section('js')
  <script>
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
@endsection