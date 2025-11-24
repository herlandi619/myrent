@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-4 shadow-lg rounded-xl">
    <h2 class="text-xl font-bold mb-3">Tambah Cabang</h2>

    <form action="{{ route('branches.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block">Nama Cabang</label>
            <input name="name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block">Alamat</label>
            <textarea name="address" class="w-full border p-2 rounded" required></textarea>
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
    </form>
</div>
@endsection
