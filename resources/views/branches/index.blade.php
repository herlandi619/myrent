@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Kelola Cabang</h2>

    <a href="{{ route('branches.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        + Tambah Cabang
    </a>

    @if(session('success'))
        <div class="mt-3 bg-green-500 text-white p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-4 bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2">Nama Cabang</th>
                    <th class="py-2">Alamat</th>
                    <th class="py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $b)
                <tr class="border-b">
                    <td class="py-2 text-center">{{ $b->name }}</td>
                    <td class="py-2 text-center">{{ $b->address }}</td>
                    <td class="py-2 text-center">
                        <a href="{{ route('branches.edit', $b->id) }}" class="text-blue-600 font-semibold hover:underline">Edit</a>

                        <form action="{{ route('branches.delete', $b->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus?')" 
                                    class="text-red-600 font-semibold hover:underline ml-3">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
