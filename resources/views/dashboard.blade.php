@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Header -->
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h2>
    <p class="text-gray-600 mb-6">
        Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span>!
    </p>

    <!-- Card -->
    <div class="bg-white shadow-md rounded-xl p-6 mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Aksi Cepat</h3>

        <a href="/bookings/create"
           class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
            Buat Booking Baru
        </a>
    </div>

    <!-- Laporan Keuangan -->
    <div class="bg-white shadow-md rounded-xl p-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Laporan Keuangan (Admin)</h3>

        <div class="flex flex-wrap gap-4">

            <!-- Harian -->
            <form method="POST" action="{{ route('laporan.harian') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition">
                    Laporan Harian
                </button>
            </form>

            <!-- Mingguan -->
            <form method="POST" action="{{ route('laporan.mingguan') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-3 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg shadow transition">
                    Laporan Mingguan
                </button>
            </form>

            <!-- Bulanan -->
            <form method="POST" action="{{ route('laporan.bulanan') }}">
                @csrf
                <button type="submit"
                    class="px-5 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow transition">
                    Laporan Bulanan
                </button>
            </form>

        </div>
    </div>

</div>

@endsection
