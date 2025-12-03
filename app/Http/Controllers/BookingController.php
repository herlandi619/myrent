<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Item;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
                           ->with('item', 'branch')
                           ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function adminIndex()
    {
        $bookings = Booking::with('user', 'item', 'branch')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $branches = Branch::all();
        $items = Item::where('status', 'available')->get();
        return view('bookings.create', compact('branches', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id'    => 'required',
            'branch_id'  => 'required',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time'
        ]);

        // Hitung tarif otomatis
        $item = Item::findOrFail($request->item_id);
        $start = Carbon::parse($request->start_time);
        $end   = Carbon::parse($request->end_time);

        $hours = $start->diffInHours($end);
        $total = $hours * $item->hourly_rate;

        Booking::create([
            'user_id'     => Auth::id(),
            'item_id'     => $request->item_id,
            'branch_id'   => $request->branch_id,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'total_price' => $total,
            'status'      => 'pending'
        ]);

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking berhasil dibuat!');
    }

    public function show($id)
    {
        $booking = Booking::with('item', 'branch')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $items = Item::all();
        $branches = Branch::all();

        return view('bookings.edit', compact('booking', 'items', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time'   => 'required|after:start_time'
        ]);

        $booking = Booking::findOrFail($id);
        $item = Item::findOrFail($booking->item_id);

        $hours = Carbon::parse($request->start_time)
                       ->diffInHours(Carbon::parse($request->end_time));
        $total = $hours * $item->hourly_rate;

        $booking->update([
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'total_price' => $total
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking diupdate');
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking dibatalkan');
    }

    public function allSchedules()
    {
        $schedules = Booking::with(['item', 'branch', 'user'])
            ->orderBy('start_time', 'asc')
            ->get();

        return view('schedules.index', compact('schedules'));
    }



    /////////////////////////////////////////////////////////////////////////
    public function adminIndex2()
    {
        $bookings = Booking::with(['item', 'branch', 'user'])
                    ->orderBy('start_time', 'DESC')
                    ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function accept($id)
    {
        Booking::where('id', $id)->update(['status' => 'accepted']);
        return back()->with('success', 'Booking diterima.');
    }

    public function reject($id)
    {
        Booking::where('id', $id)->update(['status' => 'rejected']);
        return back()->with('success', 'Booking ditolak.');
    }

    public function ongoing($id)
    {
        Booking::where('id', $id)->update(['status' => 'ongoing']);
        return back()->with('success', 'Booking sedang berjalan.');
    }

    public function done($id)
    {
        Booking::where('id', $id)->update(['status' => 'done']);
        return back()->with('success', 'Booking selesai.');
    }

    // payment admin
    public function pay(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Cek apakah sudah dibayar
        if ($booking->payment) {
            return back()->with('success', 'Booking ini sudah dibayar.');
        }

        // Validasi payment method
        $request->validate([
            'method' => 'required|in:cash,qris',
        ]);

        // Buat payment entry
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => $request->method,
            'status' => 'paid',
        ]);

        // Update status booking menjadi paid
        $booking->status = 'paid';
        $booking->save();

        return back()->with('success', 'Pembayaran berhasil diproses oleh admin.');
    }



}


