@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto px-4 py-6">
    
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Detail Booking</h2>

    <div class="bg-white shadow-md rounded-xl p-5 space-y-3">

        <p class="text-gray-700">
            <strong class="font-semibold">Item:</strong> {{ $booking->item->name }}
        </p>

        <p class="text-gray-700">
            <strong class="font-semibold">Cabang:</strong> {{ $booking->branch->name }}
        </p>

        <p class="text-gray-700">
            <strong class="font-semibold">Jam Mulai:</strong> {{ $booking->start_time }}
        </p>

        <p class="text-gray-700">
            <strong class="font-semibold">Jam Selesai:</strong> {{ $booking->end_time }}
        </p>

        <p class="text-gray-700">
            <strong class="font-semibold">Total Harga:</strong>
            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
        </p>

        <p class="text-gray-700">
            <strong class="font-semibold">Status:</strong>
            <span class="px-3 py-1 rounded-full text-white
                @if($booking->status == 'pending') bg-yellow-500
                @elseif($booking->status == 'paid') bg-green-600
                @else bg-red-600 @endif">
                {{ ucfirst($booking->status) }}
            </span>
        </p>

        <a href="/bookings"
               class="block w-full text-center bg-blue-600 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-blue-700 transition">
                Kembali
            </a>

        {{-- @if($booking->status == 'pending')
            <a href="/payment/{{ $booking->id }}"
               class="block w-full text-center bg-blue-600 text-white font-semibold py-2.5 rounded-lg shadow hover:bg-blue-700 transition">
                Bayar Sekarang
            </a>
        @endif --}}

    </div>
</div>

@endsection
