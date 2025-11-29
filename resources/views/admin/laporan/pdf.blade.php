<h2 style="text-align:center;">{{ $title }}</h2>

<table border="1" cellpadding="5" width="100%">
    <tr>
        <th>No</th>
        <th>ID Booking</th>
        <th>Jumlah</th>
        <th>Metode</th>
        <th>Tanggal</th>
    </tr>

    @foreach($data as $i => $row)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $row->booking_id }}</td>
        <td>Rp {{ number_format($row->amount) }}</td>
        <td>{{ $row->method }}</td>
        <td>{{ $row->created_at->format('d-m-Y H:i') }}</td>
    </tr>
    @endforeach
</table>
