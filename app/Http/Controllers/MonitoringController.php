<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Pendataan;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendataan = Pendataan::where('status', 1)->with('monitoring')->get();
        return view('monitoring.index', compact('pendataan'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pendataan' => 'required|exists:tb_pendataan,id',
            'Jumlah_bantuan' => 'required|numeric',
        ]);

        Monitoring::create([
            'id_pendataan' => $request->id_pendataan,
            'Jumlah_bantuan' => $request->Jumlah_bantuan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitoring $monitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monitoring $monitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitoring $monitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitoring $monitoring)
    {
        //
    }
}
