@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    
    <h3 class="text-2xl font-bold mb-4">Kelola Alat</h3>

    <a href="{{ route('items.create') }}" 
       class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded mb-4">
       + Tambah Alat
    </a>

    @include('components.alert') {{-- untuk alert success/error --}}

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <th class="px-4 py-3 border">Nama Alat</th>
                    <th class="px-4 py-3 border">Cabang</th>
                    <th class="px-4 py-3 border">Jenis</th>
                    <th class="px-4 py-3 border">Tarif/Jam</th>
                    <th class="px-4 py-3 border">Tarif/Hari</th>
                    <th class="px-4 py-3 border">Status</th>
                    <th class="px-4 py-3 border w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr class="border hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $item->name }}</td>
                    <td class="px-4 py-2 border">{{ $item->branch->name }}</td>
                    <td class="px-4 py-2 border">{{ $item->type }}</td>
                    <td class="px-4 py-2 border">Rp{{ number_format($item->hourly_rate) }}</td>
                    <td class="px-4 py-2 border">Rp{{ number_format($item->daily_rate) }}</td>
                    <td class="px-4 py-2 border">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $item->status == 'available' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('items.edit', $item->id) }}" 
                           class="px-2 py-1 bg-yellow-400 hover:bg-yellow-500 rounded text-black text-xs mr-1">
                           Edit
                        </a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus item?')"
                                class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>

</div>
@endsection
