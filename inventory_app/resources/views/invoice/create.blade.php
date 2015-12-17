@extends('master')

@section('head')
	{{-- This is required by any page that will use the Handsontable --}}
	<link rel="stylesheet" media="screen" href="http://handsontable.com/dist/handsontable.full.css">
@endsection

@section('title', 'Invoice')

@section('content')
  </br>
  <div class="row">
    <div class="form-horizontal col-md-7">
      <div class="form-group">
      	<label for="vendor" class="col-md-3 control-label">Vendor:</label>
        <div class="col-md-6">
        	<select name="vendor" id="vendor" onchange="loadSizeData(this)" class="form-control">
            <option disabled selected> -- Select a Vendor -- </option>
            @foreach($vendors as $vendor)
            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
            @endforeach
          </select>
        </div>
      </div>  
      <div class="form-group">
      	<label for="invoice_number" class="col-md-3 control-label">Invoice ID:</label>
        <div class="col-md-6">
          <input type="text" id="invoice_number" name="invoice_number" class="form-control"/>
        </div>
      </div>  
      <div class="form-inline form-group">       
      	<label for="page_number" class="col-md-3 control-label">Page #:</label>
        <div class="col-md-6">
          <input type="text" id="page_number" style="width: 50px" value="1" class="form-control">
           of 
          <input type="text" id="page_total" style="width: 50px" value="1" class="form-control"> 
           Total Pages.
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-3">
        <label for="notes" class="col-md-2 control-label">Notes: </label>
        <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
      </div>
    </div>
  </div>

  <div class="row">
      <div class="col-md-offset-3">
        <button class="btn btn-success btn-lg" name="save" id="save" data="#invoice" data-instance="hotInstance">Save</button>
      </div>
      <p class="bg-danger text-danger" id="msg"></p>
      <p class="alert alert-info">Last line in the table is the only empty line allowed at time of submit and will not be saved.</p>

      <meta name="csrf_token" content="{{ csrf_token() }}"/>
      <!-- Table -->
      <div id="invoice"></div>
  </div>

@endsection

@section('js')
  <script src="http://handsontable.com/dist/handsontable.full.js"></script>

  <script>
    var changedData;
    var formatedData;

    function loadSizeData (selected) {
      document.getElementById("msg").innerHTML = "";
      $.ajax({
        method: "GET",
        url: "{{ url('settings/size_matrix').'/' }}"+selected.value,
        success: function (data) {
          //console.log('returned' + data)
          //changedData = JSON.parse(data);
          if (data.status == 'error') {
            document.getElementById("msg").innerHTML = 'This Vendor does not have any Matrices saved, create one <a href="{{ route('settings.size_matrix.create') }}">here</a>.';
            alert(data.msg);
            hotInstance.clear();
            hotInstance.updateSettings({
              data: [{style: 'Must first create Matrix for Vendor'}],
              columns:table_col_settings,
              cells: function (row, col, prop) {
                var cellProperties = {};

                cellProperties.readOnly = true;

                return cellProperties;
              }
            });
            
            return false;
          };

          formatedData = $.map(data, function(el, i) { 
            console.log(el);
            // console.log(i);

            return el.name; 
          });

          table_col_settings[2] ={
            data: 'size',
            type: 'dropdown',
            source: formatedData
          };
          
          hotInstance.updateSettings({
            columns:table_col_settings,
            cells: function (row, col, prop) {
              var cellProperties = {};

              cellProperties.readOnly = false;

              return cellProperties;
            }
          });
          hotInstance.clear();
        },
        beforeSend: function (xhr) {
              // needed to get pass auth middleware   
              var token = $('meta[name="csrf_token"]').attr('content');

              if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
              }
        }
      });
    }






  var table_col_settings = [
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
          //source: sizeMatrixData
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
          data: 'color', 
        }
      ]

    var $container = $("#invoice");

    $container.handsontable({
      data: [{style: 'Must first select Vendor'}],    // must be define for dataSchema to work and return data as Objects
      dataSchema: {style: null, cost: null, size: null, department: null, color: null}, 

      rowHeaders: true,
      colHeaders: true,
      contextMenu: true,
      undo: true,

      startRows: 5,
      minSpareRows: 1,
      
      manualColumnResize: true,
      manualRowResize: true,
      colWidths: [230, 90, 150, 150, 180],
      colHeaders: ['Style', 'Cost', 'Size', 'Department', 'Color'],

      columns: table_col_settings,
      cells: function (row, col, prop) {
        var cellProperties = {};

        cellProperties.readOnly = true;

        return cellProperties;
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
    var hotInstance = $("#invoice").handsontable('getInstance');


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
          data: JSON.stringify({form : formdata, table : hot.getSourceData()}),//{ form : formdata, table : JSON.stringify(hot.getData()}), // returns all cell data
          contentType: "application/json; charset=utf-8",
          dataType: 'json',

          beforeSend: function (xhr) {
            // checks for an empty table
            if (hot.countRows() == hot.countEmptyRows()) { 
              alert('Failed to save. Table has no data.');
              document.getElementById("msg").innerHTML = 'Table is empty.'
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
              window.location.replace('{{ url('invoice') }}'+'/'+data.invoice_id );
            }else{
            	alert('There was an eror, please contact Developoment');
            };

          },

          error:function(data){
            var jsMsg = "";
            var htmlMsg = "";
            for(var error in data.responseJSON) {
              jsMsg += data.responseJSON[error] + '\n';
              htmlMsg += data.responseJSON[error] + '<br>';
            }
            alert('There was an error with the submit, please check your data and try again. If problem persist contact Developoment team.\n \n '+ jsMsg);
            document.getElementById("msg").innerHTML = htmlMsg;
          }
        })
      } 
    })();      
  </script>
@endsection