@extends('layouts.app')

@section('content')

<div class="flex justify-center px-4 mt-6">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Register</h2>

        <form action="/register" method="POST" class="space-y-4">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-gray-700 mb-1">Nama</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full p-3 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       required>
                @error('name') 
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full p-3 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       required>
                @error('email') 
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-gray-700 mb-1">Password</label>
                <input type="password" 
                       name="password" 
                       class="w-full p-3 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       required>
                @error('password') 
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- Konfirmasi Password
            <div>
                <label class="block text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" 
                       name="password_confirmation" 
                       class="w-full p-3 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div> --}}

            {{-- Tombol --}}
            <button
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition">
                Register
            </button>

            <p class="text-center text-gray-600 text-sm mt-3">
                Sudah punya akun?
                <a href="/login" class="text-blue-600 font-medium hover:underline">
                    Login
                </a>
            </p>
        </form>

    </div>
</div>

@endsection
