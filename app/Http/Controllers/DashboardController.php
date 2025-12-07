<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller 
{
    public function index()
{   
    // Jika tabel belum ada (baru migrate:fresh), jangan jalankan query
    if (!Schema::hasTable('bookings') || !Schema::hasColumn('bookings', 'total_price')) {
        return view('dashboard', ['pendapatanCabang' => collect()]);
    }

    $pendapatanCabang = DB::table('branches')
        ->leftJoin('bookings', 'branches.id', '=', 'bookings.branch_id')
        ->select(
            'branches.id',
            'branches.name',
            DB::raw('
                COALESCE(
                    SUM(
                        CASE 
                            WHEN bookings.status IN ("paid", "finished") 
                            THEN bookings.total_price 
                            ELSE 0 
                        END
                    ), 
                0) as total_income
            ')
        )
        ->groupBy('branches.id', 'branches.name')
        ->orderBy('branches.id')
        ->get();

    return view('dashboard', compact('pendapatanCabang'));
}




}
