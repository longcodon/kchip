<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khachhang;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Doanh thu theo ngày
        $dailyRevenue = Khachhang::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(price) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Doanh thu theo tác phẩm
        $titleRevenue = Khachhang::select(
                'title',
                DB::raw('SUM(price) as total')
            )
            ->groupBy('title')
            ->get();

        // Tổng số đơn hàng và tổng doanh thu
        $totalOrders = Khachhang::count();
        $totalRevenue = Khachhang::sum('price');

        return view('dashboard', compact('dailyRevenue', 'titleRevenue', 'totalOrders', 'totalRevenue'));
    }
}
