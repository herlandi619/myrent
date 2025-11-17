@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto px-4 py-6">

    <h2 class="text-3xl font-bold text-gray-800 mb-6">Buat Booking</h2>

    <form action="/bookings" method="POST" class="space-y-5">
        @csrf

        {{-- Item --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Item</label>
            <select name="item_id" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Pilih Item</option>
                @foreach($items as $i)
                    <option value="{{ $i->id }}">
                        {{ $i->name }} (Rp {{ number_format($i->hourly_rate) }}/jam)
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Cabang --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Cabang</label>
            <select name="branch_id" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @foreach($branches as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Jam Mulai --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Jam Mulai</label>
            <input type="datetime-local" name="start_time" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        {{-- Jam Selesai --}}
        <div>
            <label class="block text-gray-700 font-medium mb-1">Jam Selesai</label>
            <input type="datetime-local" name="end_time" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        {{-- Tombol --}}
        <button
            class="w-full bg-green-600 text-white font-semibold py-2.5 rounded-lg shadow-md hover:bg-green-700 transition">
            Simpan Booking
        </button>
    </form>

</div>

@endsection
