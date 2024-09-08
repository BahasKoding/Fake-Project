<?php

namespace App\Http\Controllers;
use App\Models\Monitoring;
use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendataan = Pendataan::where('status', 1)->with('monitoring')->get();
        return view('Laporan.index', compact('pendataan'));
    }

    public function downloadPdf(Request $request)
    {
        // Ambil parameter tanggal dari request
        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');

        // Konversi tanggal ke format yang bisa digunakan untuk query
        $fromDate = $fromDate ? \Carbon\Carbon::createFromFormat('Y-m-d', $fromDate) : null;
        $toDate = $toDate ? \Carbon\Carbon::createFromFormat('Y-m-d', $toDate) : null;

        // Ambil data sesuai dengan filter tanggal jika ada
        $pendataan = Pendataan::query()
            ->when($fromDate, function ($query, $fromDate) {
                return $query->whereHas('monitoring', function ($query) use ($fromDate) {
                    $query->whereDate('created_at', '>=', $fromDate);
                });
            })
            ->when($toDate, function ($query, $toDate) {
                return $query->whereHas('monitoring', function ($query) use ($toDate) {
                    $query->whereDate('created_at', '<=', $toDate);
                });
            })
            ->where('status', 1)
            ->with('monitoring')
            ->get();

        // Setup Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content
        $view = view('Laporan.pdf', compact('pendataan'))->render();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF
        return $dompdf->stream('laporan.pdf', ['Attachment' => true]);
    }


}
