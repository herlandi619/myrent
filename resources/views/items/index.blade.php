@extends('layouts.app')

@section('content')
<h2>Daftar Item Rental</h2>

<a href="/items/create" class="btn btn-primary mb-3">Tambah Item</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga / Jam</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($items as $i)
        <tr>
            <td>{{ $i->name }}</td>
            <td>{{ $i->type }}</td>
            <td>Rp {{ number_format($i->price_per_hour) }}</td>
            <td>
                <a href="/items/{{ $i->id }}/edit" class="btn btn-warning btn-sm">Edit</a>

                <form action="/items/{{ $i->id }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
