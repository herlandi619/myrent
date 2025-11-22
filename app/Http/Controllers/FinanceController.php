<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class FinanceController extends Controller
{
    public function index() {
        $payments = Payment::where('status','paid')->get();
        return view('admin.finance.index', compact('payments'));
    }

    public function exportPdf() {
        $payments = Payment::where('status','paid')->get();
        $pdf = PDF::loadView('admin.finance.pdf', compact('payments'));
        return $pdf->download('finance-report.pdf');
    }

    public function exportCsv() {
        $payments = Payment::where('status','paid')->get();

        $filename = "finance-report.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Booking ID','Amount','Method','Date']);

        foreach ($payments as $p) {
            fputcsv($handle, [$p->booking_id, $p->amount, $p->method, $p->created_at]);
        }
        fclose($handle);

        return response()->download($filename);
    }
}
