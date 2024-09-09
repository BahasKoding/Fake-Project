<?php

namespace App\Http\Controllers;
use App\Models\Monitoring;
use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF; // Ubah ini

class LaporanController extends Controller
{
    private function getFilteredData(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = Pendataan::where('status', 1)->with('monitoring');

        if ($fromDate && $toDate) {
            $query->whereHas('monitoring', function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('created_at', [$fromDate, $toDate]);
            });
        }

        return $query->get();
    }

    public function index(Request $request)
    {
        $pendataan = $this->getFilteredData($request);
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        return view('Laporan.index', compact('pendataan', 'fromDate', 'toDate'));
    }

    public function downloadPdf(Request $request)
    {
        $pendataan = $this->getFilteredData($request);
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $pdf = PDF::loadView('Laporan.pdf', compact('pendataan', 'fromDate', 'toDate'));
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->getDomPDF()->set_option("isPhpEnabled", true);

        return $pdf->download('laporan.pdf');
    }
}
