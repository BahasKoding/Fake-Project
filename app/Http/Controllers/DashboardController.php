<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Pendataan;
use App\Models\Monitoring;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengumuman = Pengumuman::count();
        $totalPendataan = Pendataan::count();
        $totalMonitoring = Monitoring::count();

        $latestPengumuman = Pengumuman::latest()->take(5)->get();
        $latestPendataan = Pendataan::latest()->take(5)->get();

        // Data untuk Pie Chart (menggunakan status dari Pendataan sebagai contoh)
        $pendataanStatusData = Pendataan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->values()
            ->toArray();
        $pendataanStatusLabels = Pendataan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('status')
            ->toArray();

        // Data untuk Area Chart
        $pendataanTrend = Pendataan::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $pendataanTrendLabels = $pendataanTrend->pluck('date')->toArray();
        $pendataanTrendData = $pendataanTrend->pluck('total')->toArray();

        return view('dashboard.index', compact(
            'totalPengumuman',
            'totalPendataan',
            'totalMonitoring',
            'latestPengumuman',
            'latestPendataan',
            'pendataanStatusData',
            'pendataanStatusLabels',
            'pendataanTrendLabels',
            'pendataanTrendData'
        ));
    }
}
