@extends('layouts.app')

@section('content')

<div class="flex justify-center px-4 mt-6">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Login</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4">
            @csrf

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

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                Login
            </button>

            <p class="text-center text-gray-600 text-sm mt-3">
                Belum punya akun?
                <a href="/register" class="text-blue-600 font-medium hover:underline">
                    Register
                </a>
            </p>
        </form>

    </div>
</div>

@endsection
