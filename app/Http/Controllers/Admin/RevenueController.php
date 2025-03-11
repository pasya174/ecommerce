<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        $date = $_REQUEST['date'] ?? Carbon::now()->format('Y-m');

        [$year, $month] = explode('-', $date);

        $filter_date = $date;

        $start_date = Carbon::create($year, $month, 1)->startOfMonth()->toDateString();
        $end_date = Carbon::create($year, $month, 1)->endOfMonth()->toDateString();

        $query = Transactions::where('status', 1)
            ->whereNotNull('payment_status')
            ->whereBetween('created_at', [$start_date, $end_date]);

        $pendapatan_kotor = $query->sum('total_amount');
        $biaya_admin = 0.1; // 10% biaya admin
        $pendapatan_bersih = $pendapatan_kotor * (1 - $biaya_admin);

        return view('administator.pages.revenue', compact('pendapatan_kotor', 'pendapatan_bersih', 'date', 'filter_date'));
    }

    public function data($date)
    {
        $date = $_REQUEST['date'] ?? Carbon::now()->format('Y-m');

        [$year, $month] = explode('-', $date);

        $start_date = Carbon::create($year, $month, 1)->startOfMonth()->toDateString();
        $end_date = Carbon::create($year, $month, 1)->endOfMonth()->toDateString();

        $query = Transactions::where('status', 1)
            ->whereNotNull('payment_status')
            ->whereBetween('created_at', [$start_date, $end_date]);

        $pendapatan_kotor = $query->sum('total_amount');
        $biaya_admin = 0.1; // 10% biaya admin
        $pendapatan_bersih = $pendapatan_kotor * (1 - $biaya_admin);

        return view('administator.pages.revenue', compact('pendapatan_kotor', 'pendapatan_bersih', 'date'));
    }
}
