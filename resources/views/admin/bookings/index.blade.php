@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-6 p-4 bg-white shadow-lg rounded-lg">

    <h2 class="text-2xl font-bold mb-4">Kelola Booking</h2>

    @if(session('success'))
        <div class="p-3 bg-green-600 text-white rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2">No</th>
                <th class="p-2">User</th>
                <th class="p-2">Item</th>
                <th class="p-2">Cabang</th>
                <th class="p-2">Waktu</th>
                <th class="p-2">Total</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr class="border hover:bg-gray-100 text-center">
                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $b->user->name }}</td>
                <td class="p-2">{{ $b->item->name }}</td>
                <td class="p-2">{{ $b->branch->name }}</td>
                <td class="p-2">{{ $b->start_time }} - {{ $b->end_time }}</td>
                <td class="p-2">Rp {{ number_format($b->total_price, 0, ',', '.') }}</td>
                <td class="p-2 font-bold">{{ strtoupper($b->status) }}</td>
                <td class="p-2 space-x-1">

                    @if($b->status == 'pending')
                        <form action="{{ route('admin.bookings.accept', $b->id) }}" method="POST" class="inline">@csrf
                            <button class="px-2 py-1 bg-green-600 text-white rounded">Terima</button>
                        </form>

                        <form action="{{ route('admin.bookings.reject', $b->id) }}" method="POST" class="inline">@csrf
                            <button class="px-2 py-1 bg-red-600 text-white rounded">Tolak</button>
                        </form>
                    @endif

                    @if($b->status == 'accepted')
                        <form action="{{ route('admin.bookings.ongoing', $b->id) }}" method="POST" class="inline">@csrf
                            <button class="px-2 py-1 bg-blue-600 text-white rounded">Mulai</button>
                        </form>
                    @endif

                    @if($b->status == 'ongoing')
                        <form action="{{ route('admin.bookings.done', $b->id) }}" method="POST" class="inline">@csrf
                            <button class="px-2 py-1 bg-gray-800 text-white rounded">Selesai</button>
                        </form>
                    @endif

                    {{-- buatkan proses pembayaran lewat admin disini --}}
                   {{-- Pembayaran (hanya muncul jika booking DONE dan belum dibayar) --}}
                    @if($b->status == 'done' && !$b->payment)
                        <form action="{{ route('admin.bookings.pay', $b->id) }}" method="POST" class="inline">
                            @csrf
                            
                            <select name="method" class="border rounded px-2 py-1">
                                <option value="cash">Cash</option>
                                <option value="qris">QRIS</option>
                            </select>

                            <button class="px-2 py-1 bg-purple-600 text-white rounded">
                                Bayar
                            </button>
                        </form>
                    @endif

                    @if($b->payment)
                        <span class="px-2 py-1 bg-green-700 text-white rounded">
                            Sudah Dibayar ({{ strtoupper($b->payment->method) }})
                        </span>
                    @endif



                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
