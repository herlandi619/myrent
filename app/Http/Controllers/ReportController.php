<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function harian()
    {
        $data = Payment::whereDate('created_at', today())
                       ->where('status', 'paid')
                       ->get();

        return view('admin.laporan.hasil', [
            'title' => 'Laporan Harian',
            'jenis' => 'harian',
            'data'  => $data
        ]);
    }

    public function mingguan()
    {
        $data = Payment::whereBetween('created_at', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ])
                    ->where('status','paid')
                    ->get();

        return view('admin.laporan.hasil', [
            'title' => 'Laporan Mingguan',
            'jenis' => 'mingguan',
            'data'  => $data
        ]);
    }

    public function bulanan()
    {
        $data = Payment::whereMonth('created_at', now()->month)
                       ->where('status','paid')
                       ->get();

        return view('admin.laporan.hasil', [
            'title' => 'Laporan Bulanan',
            'jenis' => 'bulanan',
            'data'  => $data
        ]);
    }

    public function cetak($jenis)
    {
        if ($jenis === 'harian') {
            $title = 'Laporan Harian';
            $data = Payment::whereDate('created_at', today())->get();

        } elseif ($jenis === 'mingguan') {
            $title = 'Laporan Mingguan';
            $data = Payment::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->get();

        } else {
            $title = 'Laporan Bulanan';
            $data = Payment::whereMonth('created_at', now()->month)->get();
        }

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('title', 'data'));
        return $pdf->download($title.'.pdf');
    }
}
