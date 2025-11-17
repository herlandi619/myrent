<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller 
{
    public function index()
    {
        $upcomingBookings = Booking::with(['item', 'branch'])
            ->where('start_time', '>', now())
            ->orderBy('start_time', 'asc')
            ->get();

        return view('dashboard', compact('upcomingBookings'));
    }

}
