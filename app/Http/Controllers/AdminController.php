<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Item;
use App\Models\Branch;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'items' => Item::count(),
            'branches' => Branch::count(),
            'pending' => Booking::where('status','pending')->count(),
            'income_today' => Booking::whereDate('created_at', today())->sum('total_price')
        ]);
    }
}
