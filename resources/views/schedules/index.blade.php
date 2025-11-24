@extends('layouts.app')

@section('content')

<div class="px-4 py-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Semua Jadwal Booking</h2>
    <p class="text-gray-600 mb-6">Berikut adalah seluruh jadwal PS yang sudah dibooking oleh user lain.</p>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Item</th>
                    <th class="p-3 text-left">Cabang</th>
                    <th class="p-3 text-left">Mulai</th>
                    <th class="p-3 text-left">Selesai</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($schedules as $s)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $s->user->name }}</td>
                        <td class="p-3 font-semibold">{{ $s->item->name }}</td>
                        <td class="p-3">{{ $s->branch->name }}</td>

                        <td class="p-3 text-blue-600 font-medium">
                            {{ $s->start_time }}
                        </td>

                        <td class="p-3 text-blue-600 font-medium">
                            {{ $s->end_time }}
                        </td>

                        <td class="p-3">
                            <span class="px-3 py-1 rounded-full text-sm
                                {{ $s->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $s->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-600">
                            Belum ada jadwal booking.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
