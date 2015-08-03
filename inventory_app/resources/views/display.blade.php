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

<table style="width:100%">
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    @foreach($entry as $item)
      <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
      </tr>
    @endforeach
</table>