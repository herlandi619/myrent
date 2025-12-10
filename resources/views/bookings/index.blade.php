@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Booking</h2>
        <a href="/bookings/create" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
            Booking Baru
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        
        <!-- Table Wrapper (scrollable on mobile) -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">

                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Item</th>
                        <th class="px-6 py-3">Cabang</th>
                        {{-- <th class="px-6 py-3">Jam Mulai</th> --}}
                        {{-- <th class="px-6 py-3">Jam Selesai</th> --}}
                        {{-- <th class="px-6 py-3">Total Harga</th> --}}
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">
                    @foreach($bookings as $b)
                    <tr class="border-b hover:bg-gray-50">
                        {{-- <td class="px-6 py-4 font-medium">{{ $b->id }}</td> --}}
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $b->item->name }}</td>
                        <td class="px-6 py-4">{{ $b->branch->name }}</td>
                        {{-- <td class="px-6 py-4">{{ $b->start_time }}</td> --}}
                        {{-- <td class="px-6 py-4">{{ $b->end_time }}</td> --}}
                        {{-- <td class="px-6 py-4 font-semibold">
                            Rp {{ number_format($b->total_price, 0, ',', '.') }}
                        </td> --}}
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs
                                @if($b->status == 'paid')
                                    bg-green-100 text-green-600
                                @elseif($b->status == 'pending')
                                    bg-yellow-100 text-yellow-600
                                @else
                                    bg-gray-200 text-gray-600
                                @endif
                            ">
                                {{ ucfirst($b->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/bookings/{{ $b->id }}" 
                               class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-xs shadow">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
