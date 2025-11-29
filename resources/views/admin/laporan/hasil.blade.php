@extends('layouts.app')
@section('content')

<h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $title }}</h2>

<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="min-w-full text-left border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 border-b border-gray-200">No</th>
                <th class="px-4 py-3 border-b border-gray-200">ID Booking</th>
                <th class="px-4 py-3 border-b border-gray-200">Jumlah</th>
                <th class="px-4 py-3 border-b border-gray-200">Metode</th>
                <th class="px-4 py-3 border-b border-gray-200">Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $i => $row)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3 border-b border-gray-200">{{ $i + 1 }}</td>
                <td class="px-4 py-3 border-b border-gray-200">{{ $row->booking_id }}</td>
                <td class="px-4 py-3 border-b border-gray-200">Rp {{ number_format($row->amount) }}</td>
                <td class="px-4 py-3 border-b border-gray-200">{{ $row->method }}</td>
                <td class="px-4 py-3 border-b border-gray-200">
                    {{ $row->created_at->format('d-m-Y') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6 flex gap-4">

    <!-- Tombol Cetak PDF -->
    <a href="{{ route('laporan.cetak', $jenis) }}"
       class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">
        Cetak PDF
    </a>

    <!-- Tombol Kembali -->
    <a href="/"
       class="px-5 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow transition">
        Kembali
    </a>

</div>


@endsection