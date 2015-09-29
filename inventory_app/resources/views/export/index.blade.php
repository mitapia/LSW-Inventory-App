<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script> <!-- online -->


<div><h1>All Submited Forms</h1></div>

</br></br>
<table style="width:100%">
	<tr>
		<th>ID</th>
		<th>Style</th>
		<th>color</th>
        <th>Department</th>
		<th>Size Matrix</th>
        <th>Invoice Number</th>
	</tr>
    @foreach($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->style }}</td>
            <td>{{ $item->color }}</td>
            <td>{{ $item->department->name }}</td>
            <td>{{ $item->size_matrix->name }}</td>
            <td>{{ $item->invoice->invoice_number }}</td>
          </tr>
        
    @endforeach
</table>


</br>
<br>
<br>

<input type="submit" name="submit" id="submit" onclick="submit()">

<meta name="csrf_token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    function submit(){
    // var selected = [];
    // $("input[type='checkbox']:checked").each(
        
    //     function() {
    //         selected.push($(this).val());
    //        console.log($(this).val());

    //     }

    // );
    //console.log(selected)

        $.ajax({
            type:"post",
            url:"{{route('export.store')}}",
            data:{
                checkbox: true,
                },
            success:function(msg){
                console.log(msg);
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

