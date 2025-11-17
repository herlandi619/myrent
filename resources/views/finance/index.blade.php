@extends('layouts.app')

@section('content')
<h2>Laporan Keuangan</h2>

<form action="/finance-reports/generate" method="POST" class="card p-3 mb-3">
    @csrf

    <div class="mb-3">
        <label>Dari Tanggal</label>
        <input type="date" name="from" class="form-control">
    </div>

    <div class="mb-3">
        <label>Sampai Tanggal</label>
        <input type="date" name="to" class="form-control">
    </div>

    <button class="btn btn-success">Generate</button>
</form>

@if(isset($reports))
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Item</th>
            <th>Total Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $r)
        <tr>
            <td>{{ $r->date }}</td>
            <td>{{ $r->item }}</td>
            <td>Rp {{ number_format($r->income) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection
