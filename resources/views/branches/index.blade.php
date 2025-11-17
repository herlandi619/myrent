@extends('layouts.app')

@section('content')
<h2>Cabang</h2>

<a href="/branches/create" class="btn btn-primary mb-3">Tambah Cabang</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Cabang</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($branches as $b)
        <tr>
            <td>{{ $b->name }}</td>
            <td>{{ $b->address }}</td>
            <td>
                <a href="/branches/{{ $b->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                <form action="/branches/{{ $b->id }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
