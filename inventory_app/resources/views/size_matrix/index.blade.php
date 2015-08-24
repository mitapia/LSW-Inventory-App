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
        <th>Name</th>
        <th>Vendor Name</th>
        @for ($i=0; $i <= 13; $i++) 
            <th>{{$i}}_K</th>
        @endfor
        
        @for ($i=0; $i <= 14; $i += 0.5) 
            <th>{{$i}}</th>
        @endfor
    </tr>
    @foreach($matices as $row)
      <tr>
        <td>{{ $row->name }}</td>
        <td>{{ $row->vendor['name'] }}</td>
        @for ($i=0; $i <= 13; $i++) 
            <td>{{ $row->{$i.'_K'} }}</td>
        @endfor
        
        @for ($i=0; $i <= 14; $i += 0.5) 
            <td>{{ $row->{str_replace('.', '_', strval($i)) . '_A'} }}</td>
        @endfor
      </tr>
    @endforeach
</table>