@extends('master')

@section('head')
	{{-- This is required by any page that will use the Handsontable --}}
  <link rel="stylesheet" media="screen" href="http://handsontable.com/dist/handsontable.full.css">
@endsection

  <style type="text/css">
/*.checkbox-grid li {
    display: block;
    float: left;
    width: 33%;
}*/
  </style>

@section('title', 'Size Matrix')

@section('content')
  <div class="row">
    <!-- <form> -->
      <div class="checkbox-grid">
        @foreach($vendors as $vendor)
          <label class="col-xs-6 col-sm-5 col-md-4 col-lg-2">
          <input type="checkbox" value="{{$vendor->id}}" id="{{$vendor->id}}"/>{{$vendor->name}}
          </label>
        @endforeach
      </div>
    <!-- </form> -->
  </div>

  <div class="row">
      <div class="col-md-offset-3">
        <button class="btn btn-success btn-lg" name="save" id="save" data="#invoice" data-instance="hotInstance">Save</button>
      </div>
      <p class="bg-danger text-danger" id="msg"></p>
      <p class="alert alert-info">Last line in the table is the only empty line allowed at time of submit and will not be saved.</p>
  </div>

  <div class="row">
    <hr>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <!-- Table -->
    <div id="invoice"></div>
  </div>
@endsection

@section('js')
  <script src="http://handsontable.com/dist/handsontable.full.js"></script>
  <script src="http://docs.handsontable.com/0.16.1/bower_components/chroma-js/chroma.min.js"></script>

  <script>
    var heatmap = [],
    heatmapScale = chroma.scale(['#FFFFFF', '#8BC34A']),
    table_col_settings = [
      {
        data: 'name', 
      },
      @for ($i = 0; $i <= 13; $i++)
        {
          data: '{{$i}}_K',
          type: 'numeric',
          renderer: heatmapRenderer
        },
      @endfor
      @for ($i = 0; $i <= 14; $i+=0.5)
        {
          data: '{{ str_replace('.', '_', strval($i)) . '_A' }}',
          type: 'numeric',
          renderer: heatmapRenderer
        },
      @endfor
    ];

    var $container = $("#invoice");

    $container.handsontable({
      data: [],    // must be define for dataSchema to work and return data as Objects
      dataSchema: {
        name: null,
        @for ($i = 0; $i <= 13; $i++)
          '{{$i}}_K': null,
        @endfor
        @for ($i = 0; $i <= 14; $i+=0.5)
          {{-- for some reason it will not allow a single number as name, adding '_' to bypass problem --}}
          '{{ str_replace('.', '_', strval($i)) . '_A' }}': null,
        @endfor
      }, 

      rowHeaders: true,
      colHeaders: true,
      contextMenu: true,
      fixedColumnsLeft: 1,    
      manualColumnFreeze: true,
      undo: true,

      startRows: 5,
      minSpareRows: 1,
      
      manualColumnResize: true,
      manualRowResize: true,

      viewportColumnRenderingOffset: 30,
      colWidths: [160, 
        @for ($i = 0; $i < 50; $i++)
          45,
        @endfor
      ],
      colHeaders: [
        'Name',
        @for ($i = 0; $i <= 13; $i++)
          '{{$i}}_K',
        @endfor
        @for ($i = 0; $i <= 14; $i+=0.5)
          '{{$i}}',
        @endfor
        ],

      columns: table_col_settings,
      // cells: function (row, col, prop) {
      //   var cellProperties = {};

      //   cellProperties.readOnly = true;

      //   return cellProperties;
      // },
      // Validation on check will occur on the entire table and will aler if fail
      afterDeselect: function (callback) {

      },
      afterChange: function (change, source) {

      },
      beforeChangeRender: updateHeatmap,
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


    function updateHeatmap(change, source) {
        console.log(change);
      if (change) {
        heatmap[change[0][0]] = generateHeatmapData.call(this, change[0][0]);
      } else {
        heatmap = [];
    
        for(var i = 0, rowCount = this.countRows(); i < rowCount ; i++) {
          heatmap[i] = generateHeatmapData.call(this, i);
            console.log(heatmap[i]);
        }
      }
    }
    
    function point(min, max, value) {
      return (value - min) / (max - min);
    }
    
    function generateHeatmapData(rowId) {
      var values = this.getDataAtRow(rowId);
        console.log('values before splice: ' + values);
      values.splice(0, 1);
        console.log('After splice: ' + values);
      return {
        min: Math.min.apply(null, values),
        max: Math.max.apply(null, values)
      };
    }
    
    function heatmapRenderer(instance, td, row, col, prop, value, cellProperties) {
      Handsontable.renderers.TextRenderer.apply(this, arguments);
    
      if (heatmap[row]) {
        td.style.backgroundColor = heatmapScale(point(heatmap[row].min, heatmap[row].max, parseInt(value, 10))).hex();
        td.style.textAlign = 'right';
      }
    }

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
        var formData = [];
        $("input[type='checkbox']:checked").each(
          function() {
            formData.push($(this).val());
          }
        );

        $.ajax({
          url: "{{ route('settings.size_matrix.store') }}", 
          method: 'POST',
          data: JSON.stringify({vendor : formData, table : hot.getSourceData()}),//{ form : formdata, table : JSON.stringify(hot.getData()}), // returns all cell data
          contentType: "application/json; charset=utf-8",
          dataType: 'json',

          beforeSend: function (xhr) {
            // checks for an empty table
            // if (hot.countRows() == hot.countEmptyRows()) { 
            //   alert('Failed to save. Table has no data.');
            //   document.getElementById("msg").innerHTML = 'Table is empty.'
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
            	alert('Matrix(es) was successfully saved.');
           	  hot.updateSettings({
                  cells: function (row, col, prop) {
                    var cellProperties = {};

                      cellProperties.readOnly = true;

                    return cellProperties;
                  }
                });
              window.location.replace('{{ url('settings/size_matrix') }}');
            }else{
            	alert('There was an eror, please contact Developoment');
            };
          },

          error:function(data){
            // console.log('start error');
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