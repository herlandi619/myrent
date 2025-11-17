@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto px-4 py-6">

    <div class="bg-white shadow-lg rounded-xl p-6 space-y-4">

        <h3 class="text-2xl font-semibold text-gray-800">Pembayaran</h3>

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <p class="text-gray-700"><strong>Booking ID:</strong> {{ $booking->id }}</p>
        <p class="text-gray-700"><strong>Item:</strong> {{ $booking->item->name }}</p>
        <p class="text-gray-700"><strong>Cabang:</strong> {{ $booking->branch->name }}</p>
        <p class="text-gray-700"><strong>Jam:</strong> {{ $booking->start_time }} — {{ $booking->end_time }}</p>

        <hr class="border-gray-300">

        <h4 class="text-xl font-bold text-gray-900">
            Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
        </h4>

        <form action="{{ route('payment.store', ['booking_id' => $booking->id]) }}" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="amount" value="{{ $booking->total_price }}">

            {{-- Dropdown metode pembayaran --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Pilih Metode Pembayaran</label>
                <select name="method" id="method"
                    class="w-full p-3 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="cash">Cash / Tunai</option>
                    <option value="qris">QRIS</option>
                    <option value="bank">Transfer Bank</option>
                </select>
            </div>

            {{-- QRIS --}}
            <div id="qrisBox" class="hidden bg-gray-50 p-4 rounded-lg border">
                <p class="text-gray-700 font-medium mb-2">Scan QR untuk pembayaran via QRIS:</p>
                <img class="mx-auto rounded-lg shadow"
                     src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PAYMENT-TRIPLEA-{{ $booking->id }}"
                     alt="QRIS">
                <p class="text-xs text-gray-500 mt-2 text-center">Setelah transfer, pembayaran akan diverifikasi.</p>
            </div>

            {{-- Bank --}}
            <div id="bankBox" class="hidden bg-gray-50 p-4 rounded-lg border">
                <p class="text-gray-700 font-medium mb-2">Transfer ke rekening berikut:</p>
                <ul class="text-gray-700 text-sm space-y-1">
                    <li>BCA: 123-456-789 a.n TripleA</li>
                    <li>Mandiri: 987-654-321 a.n TripleA</li>
                </ul>
                <p class="text-xs text-gray-500 mt-2">Upload bukti transfer belum tersedia.</p>
            </div>

            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                Bayar Sekarang
            </button>
        </form>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const method = document.getElementById('method');
        const qrisBox = document.getElementById('qrisBox');
        const bankBox = document.getElementById('bankBox');

        method.addEventListener('change', function () {
            qrisBox.classList.toggle('hidden', this.value !== 'qris');
            bankBox.classList.toggle('hidden', this.value !== 'bank');
        });
    });
</script>

@endsection
