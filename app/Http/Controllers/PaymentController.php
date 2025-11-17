<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function create($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('payment.create', compact('booking'));
    }

    public function store(Request $request, $booking_id)
    {
        $request->validate([
            'method' => 'required'
        ]);

        Payment::create([
            'booking_id' => $booking_id,
            'amount'     => $request->amount,
            'method'     => $request->method,
            'status'     => 'paid'
        ]);

        Booking::findOrFail($booking_id)->update([
            'status' => 'finished'
        ]);

        return redirect()->route('bookings.index')->with('success', 'Pembayaran berhasil!');
    }
}
