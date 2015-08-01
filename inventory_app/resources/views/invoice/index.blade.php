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

<div><h1>All Submited Forms</h1></div>

</br></br>
<table style="width:100%">
	<tr>
		<th>ID</th>
		<th>Invoice ID</th>
		<th>Vendor</th>
		<th>notes</th>
		<th>Page</th>
		<th>Created by</th>
	</tr>
    @foreach($invoices as $invoice)
      <tr>
        <td><a href="{{ route('invoice.show', ['id' => $invoice->id]) }}">{{$invoice->id}}</a></td>
        <td>{{$invoice->invoice_number}}</td>
        <td>{{$invoice->vendor->name}}</td>
        <td>{{$invoice->notes}}</td>
        <td>{{$invoice->page_number}} of {{$invoice->total_pages}}</td>
        <td>{{$invoice->created_by}}</td>
      </tr>
    @endforeach
</table>


</br>
<br>
<br>
<a href="{{ url('dashboard') }}">Go back to dashboard</a>