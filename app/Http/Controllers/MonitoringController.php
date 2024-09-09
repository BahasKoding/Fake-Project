<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MonitoringController extends Controller
{
    public function index()
    {
        $pendataan = Pendataan::where('status', 1)->with('monitoring')->get();
        return view('monitoring.index', compact('pendataan'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_pendataan' => 'required|exists:tb_pendataan,id',
                'Jumlah_bantuan' => 'required|numeric',
            ]);

            $monitoring = Monitoring::create($validatedData);

            return response()->json([
                'message' => 'Data monitoring berhasil disimpan!',
                'data' => $monitoring
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
