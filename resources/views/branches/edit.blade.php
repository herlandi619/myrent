@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-4 shadow-lg rounded-xl">
    <h2 class="text-xl font-bold mb-3">Edit Cabang</h2>

    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block">Nama Cabang</label>
            <input name="name" value="{{ $branch->name }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block">Alamat</label>
            <textarea name="address" class="w-full border p-2 rounded" required>{{ $branch->address }}</textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
</div>
@endsection
