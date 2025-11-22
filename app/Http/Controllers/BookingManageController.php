<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingManageController extends Controller
{
    public function index() { return view('admin.bookings.index',['bookings'=>Booking::all()]); }

    public function show(Booking $booking) { return view('admin.bookings.show', compact('booking')); }

    public function update(Request $request, Booking $booking) {
        $request->validate(['status'=>'required']);
        $booking->update(['status'=>$request->status]);
        return back()->with('success','Status booking diperbarui');
    }
}
