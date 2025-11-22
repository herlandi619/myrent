<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index() {
        return view('admin.reports.index');
    }

    public function pdf($type) {
        $data = $this->getData($type);
        $pdf = PDF::loadView('admin.reports.pdf', compact('data'));
        return $pdf->download("laporan-$type.pdf");
    }

    public function excel($type) {
        $data = $this->getData($type);
        return Excel::download(new \App\Exports\ReportExport($data),"laporan-$type.xlsx");
    }

    private function getData($type) {
        return match($type) {
            'daily' => Booking::whereDate('created_at', today())->get(),
            'weekly' => Booking::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get(),
            'monthly' => Booking::whereMonth('created_at', now()->month)->get(),
        };
    }
}
