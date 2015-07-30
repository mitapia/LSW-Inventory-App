@extends('master')

@section('head')
	{{-- This is required by any page that will use the Handsontable --}}
	@include('include.table_heads')
@endsection


@section('title', 'Invoice')


@section('content')
</br>
<div class="row">
  <div class="col-md-8">
	<label for="vendor">Vendor:</label>
	<select name="vendor" id="vendor">
    @foreach($vendors as $vendor)
      <option value="{{$vendor->id}}">{{$vendor->name}}</option>
    @endforeach
  	</select></br>

	<label for="invoice_number:">Invoice ID:</label>
	<input type="text" id="invoice_number" name="invoice_number"/></br>
	Page #:<input type="text" id="page_number" style="width: 20px" value="1"> of <input type="text" id="page_total" style="width: 20px" value="1"> Total Pages.

  </div>
  <div class="col-md-4">

	Notes: </br>
	<textarea name="notes" id="notes" rows="10" cols="30"></textarea>
  </div>
	</br>
	<button name="save" id="save" data="#inventory" data-instance="hotInstance">Save</button>
	

</div>

<hr>
<meta name="csrf_token" content="{{ csrf_token() }}" />

<!-- Table -->
<div id="inventory"</div>

<script>
  // Instead of creating a new Handsontable instance
  // with the container element passed as an argument,
  // you can simply call .handsontable method on a jQuery DOM object.
  var $container = $("#inventory");

  $container.handsontable({
    data: [],    // must be define for dataSchema to work and return data as Objects
    dataSchema: {style: null, cost: null, size: null, department: null, category: null, note: null}, 

    rowHeaders: true,
    colHeaders: true,
    contextMenu: true,
    undo: true,

    startRows: 5,
    minSpareRows: 1,
    
    manualColumnResize: true,
    manualRowResize: true,
    colWidths: [120, 80, 70, 120, 120, 250],
    colHeaders: ['Style', 'Cost', 'Size', 'Department', 'Category', 'Note'],

    columns: [
      {
        data: 'style', 
      },
      { 
      	data: 'cost',
      	type: 'numeric',
        format: '$0,0.00',
        language: 'en'
       },
      {
        data: 'size', 
        type: 'dropdown',
        source: [
		  @foreach($sizes as $size)
            '{{$size->name}}',
          @endforeach
        ]
      },
      {
        data: 'department', 
        type: 'dropdown',
        source: [
		  @foreach($departments as $department)
            '{{$department->name}}',
          @endforeach
        ]
      },
      { 
      	data: 'category',
      	type: 'dropdown',
        source: [
		  @foreach($categories as $category)
            '{{$category->name}}',
          @endforeach
        ]
      },
      {
        data: 'note', 
      }
    ],
    cells: function () {
          
    },
    // Validation on check will occur on the entire table and will aler if fail
    afterDeselect: function (callback) {

    },
    afterChange: function (change, source) {

    },
    // change [[row, prop, oldVal, newVal], ...]
    // string "alter", "empty", "edit", "populateFromArray", "loadData", "autofill", "paste"  
    beforeChange: function (change, source) {
      // this will limit size of ALL cells
      var sizelimit = 120;

      //** Need to limit size of line that can be paste in

      // Makes sure that the string is below size limit designated
      for (var i = 0; i < change.length; i++) {
        var newVal = change[i][3];

        if ( newVal.length >= sizelimit ) {
          change[i][3] = newVal.substr(0, sizelimit);
          //** Alert user that size limit has bee exceeded
        }


      };

    }
  });

  // buttons check for array(null)


  /**
   * A usually small function or regular expression that validates the input.
   * After you determine if the input is valid, execute `callback(true)` or `callback(false)` to proceed with the execution.
   * In function, `this` binds to cellProperties.
   *
   * @type {Function|RegExp}
   * @default undefined
   * @since 0.9.5
   */
  // validator: void 0,





  // This way, you can access Handsontable api methods by passing their names as an argument, e.g.:
  var hotInstance = $("#inventory").handsontable('getInstance');


  (function () {
    function bindButtons() {
      if (typeof Handsontable === "undefined") {
        return;
      }

      Handsontable.Dom.addEvent(document.body, 'click', function(e) {

        // get instace for button clicked
        var element = e.target || e.srcElement;
        var name = element.getAttribute('data');
        var instance = element.getAttribute('data-instance');
        var hot = window[instance];        

        if (element.nodeName == "BUTTON") {
          // Check wich button was pressed
          switch (element.name) {

            case 'dump':
              dump(hot)
              break;

            case 'save':
              console.log('save button');
              save(hot);

              break;
          }

        }
      });
    }
    bindButtons();

    function dump(element) {
      console.log(document.getElementById('port_id').value)
      //console.log('function dump:' + JSON.stringify(element.getData()))
    }

    function save(hot) {
      // Get values form form boxes
      var vendor = document.getElementById('vendor').value;
      var invoice_number = document.getElementById('invoice_number').value;
      var page_number = document.getElementById('page_number').value;
      var page_total = document.getElementById('page_total').value;
      var notes = document.getElementById('notes').value;

      // Make an array out of the form input
      var formdata = { 'vendor' : vendor, 'invoice_number' : invoice_number, 'page_number' : page_number, 'page_total' : page_total, 'notes' : notes};

      $.ajax({
        url: "{{ route('invoice.store') }}", 
        method: 'POST',
        data: JSON.stringify({form : formdata, table : hot.getData()}),//{ form : formdata, table : JSON.stringify(hot.getData()}), // returns all cell data
        contentType: "application/json; charset=utf-8",
        dataType: 'json',

        beforeSend: function (xhr) {
          // checks for an empty table
          if (hot.countRows() == hot.countEmptyRows()) { 
            alert('Failed to save. Table has no data.'); 
            return false;
          };

          //checks for empty columns
          if (hot.countEmptyCols() > 0) {
            alert('Failed to save. Table has empty columns.'); 
            return false;          
          };

          // check for empty rows not at the end of the table, those will be trimed later
          if ((hot.countEmptyRows() - hot.countEmptyRows(true)) > 0) {
            alert('Failed to save. Table has empty rows.'); 
            return false;          
          };


          // needed to get pass auth middleware   
          var token = $('meta[name="csrf_token"]').attr('content');

          if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
          }
        },

        success:function(data){
          // check response
          if (data.status == 'success') {
          	alert('Invoice was successfully saved.');
         	  hot.updateSettings({
                cells: function (row, col, prop) {
                  var cellProperties = {};

                    cellProperties.readOnly = true;

                  return cellProperties;
                }
              });
            window.location.replace('{{ url('invoice') }}'+'/'+data.invoice_id );
          }else{
          	alert('There was an eror, please contact Developoment');
          };

        },

        error:function(data){
          // ** turn this into alert
          alert('There was an error with the submit, please check your data and try again. If problem persist contact Developoment team.');
        }
      })
    } 
  })();        
</script>





@endsection