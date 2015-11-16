{{-- List styles to import --}}

@extends('master')

@section('head')
	{{-- This is required by any page that will use the Handsontable --}}
  <link rel="stylesheet" media="screen" href="http://handsontable.com/dist/handsontable.full.css">
@endsection

@section('title', 'Quantity')

@section('content')
  </br>
  </br>
  </br>
  </br>
  Invoice: {{$invoice->id}} 
  <br>
  </br>
  <button name="save" id="save" data="#qty" data-instance="hotInstance">Save</button>

  <p id="msg"></p>
  Enter Quantity for each store: 

  <meta name="csrf_token" content="{{ csrf_token() }}" />

  <!-- Table -->
  <div id="qty"></div>
@endsection

@section('js')
  <script src="http://handsontable.com/dist/handsontable.full.js"></script>

  <script>
  	// load style data
  	var styleData = [
    @foreach($invoice->inventory_prep as $item)
    {
        id: '{{$item->id}}', 
        style: '{{$item->style}}', 
        size: '{{$item->size_matrix->name}}', 
        department: '{{$item->department->name}}', 
        color: '{{$item->color}}', 
        warehouse: 0,
        berry: 0,
        lancaster: 0,
        wichita: 0
      },
    @endforeach
      ];


    // Instead of creating a new Handsontable instance
    // with the container element passed as an argument,
    // you can simply call .handsontable method on a jQuery DOM object.
    var $container = $("#qty");

    $container.handsontable({
      data: styleData,    // must be define for dataSchema to work and return data as Objects
      dataSchema: {
      	style: null, 
      	size: null, 
      	department: null, 
      	color: null, 
      	warehouse: null, 
      	berry: null,
      	lancaster: null,
      	wichita: null,
      }, 

      rowHeaders: true,
      colHeaders: true,
      contextMenu: true,
      undo: true,

      startRows: 1,
      minSpareRows: 0,
      
      manualColumnResize: true,
      manualRowResize: true,
      colWidths: [120, 70, 120, 120, 80, 80, 80, 80],
      colHeaders: ['Style', 'Size', 'Department', 'Color', 'Warehouse', 'Berry', 'Lancaster', 'Wichita'],

      columns: [
        {
          data: 'style', 
          readOnly: true
        },
        {
          data: 'size', 
          readOnly: true
        },
        {
          data: 'department', 
          readOnly: true
        },
        {
          data: 'color', 
          readOnly: true
        },
        {
        	data: 'warehouse',
        	type: 'numeric'
        },
        {
        	data: 'berry',
        	type: 'numeric'
        },
        {
        	data: 'lancaster',
        	type: 'numeric'
        },
        {
        	data: 'wichita',
        	type: 'numeric'
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
    var hotInstance = $("#qty").handsontable('getInstance');


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

        $.ajax({
          url: "{{ route('quantity.store') }}", 
          method: 'POST',
          data: JSON.stringify(hot.getSourceData()),//{ form : formdata, table : JSON.stringify(hot.getData()}), // returns all cell data
          contentType: "application/json; charset=utf-8",
          dataType: 'json',

          beforeSend: function (xhr) {
            // checks for an empty table
            if (hot.countRows() == hot.countEmptyRows()) { 
              alert('Failed to save. Table has no data.'); 
              return false;
            };

            //checks for empty columns
            // if (hot.countEmptyCols() > 0) {
            //   alert('Failed to save. Table has empty columns.'); 
            //   return false;          
            // };

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
              //window.location.replace('{{ url('invoice') }}'+'/'+data.invoice_id );
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