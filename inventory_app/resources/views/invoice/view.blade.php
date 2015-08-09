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

<div><h1>Submited Form</h1></div>

<h2>Vendor:  </h2>{{$invoice->vendor->name}}
<h2>Invoice ID:  </h2>{{$invoice->invoice_number}}

</br></br>
page# {{$invoice->page_number}} of {{$invoice->total_pages}} pages

</br>
Notes:  {{$invoice->notes}}
</br></br></br>
<table style="width:100%">
	<tr>
		<th>Style</th>
		<th>Cost</th>
		<th>Size</th>
		<th>Department</th>
		<th>Category</th>
		<th>Note</th>
	</tr>
    @foreach($invoice->inventory_prep as $item)
      <tr>
        <td>{{$item->style}}</td>
        <td>{{$item->cost}}</td>
        <td>{{$item->size_matrix->name}}</td>
        <td>{{$item->department->name}}</td>
        <td>{{$item->category->name}}</td>
        <td>{{$item->notes}}</td>
      </tr>
    @endforeach
</table>


</br>
<br>
<br>
<a href="{{ url('dashboard') }}">Go back to dashboard</a>

