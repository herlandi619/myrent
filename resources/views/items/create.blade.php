@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <h3 class="text-2xl font-bold mb-6">Tambah Alat</h3>

    <form action="{{ route('items.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        {{-- @include('items.form') --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Cabang --}}
        <div class="flex flex-col gap-2">
            <label class="font-semibold">Cabang</label>
            <select name="branch_id" 
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Nama Alat --}}
        <div class="flex flex-col gap-2">
            <label class="font-semibold">Nama Alat</label>
            <input type="text" name="name"
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
        </div>

        {{-- Jenis --}}
        <div class="flex flex-col gap-2">
            <label class="font-semibold">Jenis</label>
            <select name="type" 
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
                <option value="PS">PlayStation</option>
                <option value="Camera">Kamera</option>
                <option value="Other">Lainnya</option>
            </select>
        </div>

        {{-- Tarif per Jam --}}
        <div class="flex flex-col gap-2">
            <label class="font-semibold">Tarif / Jam</label>
            <input type="number" name="hourly_rate"
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
        </div>

        {{-- Tarif per Hari --}}
        <div class="flex flex-col gap-2">
            <label class="font-semibold">Tarif / Hari</label>
            <input type="number" name="daily_rate"
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
        </div>

        {{-- Status --}}
        <div class="flex flex-col gap-2">
            <label class="font-semibold">Status</label>
            <select name="status"
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
                <option value="available">Tersedia</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" 
                class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                Simpan
            </button>

            <a href="{{ route('items.index') }}" 
                class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
                Batal
            </a>
        </div>

    </div>


    </div>


        
    </form>

</div>
@endsection
