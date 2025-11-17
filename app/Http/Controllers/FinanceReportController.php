<?php

namespace App\Http\Controllers;

use App\Models\FinanceReport;
use App\Models\Booking;
use App\Models\Branch;
use Illuminate\Http\Request;

class FinanceReportController extends Controller
{
    public function index()
    {
        $reports = FinanceReport::with('branch')->get();
        return view('finance.index', compact('reports'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'date'      => 'required|date'
        ]);

        // hitung revenue harian
        $total = Booking::where('branch_id', $request->branch_id)
            ->whereDate('created_at', $request->date)
            ->where('status', 'finished')
            ->sum('total_price');

        FinanceReport::create([
            'branch_id'    => $request->branch_id,
            'date'         => $request->date,
            'total_income' => $total
        ]);

        return back()->with('success', 'Laporan berhasil dibuat');
    }
}
