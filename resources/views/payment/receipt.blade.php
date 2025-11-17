@extends('layouts.app')

@section('content')
<div class="card p-3">
    <h3>Struk Pembayaran</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><strong>No Pembayaran:</strong> {{ $payment->id }}</p>
    <p><strong>Booking ID:</strong> {{ $payment->booking->id }}</p>
    <p><strong>Penyewa:</strong> {{ $payment->booking->user->name }}</p>
    <p><strong>Item:</strong> {{ $payment->booking->item->name }}</p>
    <p><strong>Cabang:</strong> {{ $payment->booking->branch->name }}</p>
    <p><strong>Metode:</strong> {{ strtoupper($payment->method) }}</p>
    <p><strong>Jumlah:</strong> Rp {{ number_format($payment->amount,0,',','.') }}</p>
    <p><strong>Status:</strong> {{ strtoupper($payment->status) }}</p>

    <hr>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    <a href="#" onclick="window.print()" class="btn btn-primary">Cetak Struk</a>
</div>
@endsection
