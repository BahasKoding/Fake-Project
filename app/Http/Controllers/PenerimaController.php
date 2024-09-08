<?php

namespace App\Http\Controllers;

use App\Models\Pendataan;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Penerima.index',[
            'pendataan' => Pendataan::all()
        ]);
    }
    
    public function bulkUpdate(Request $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if (!in_array($action, ['terima', 'tolak'])) {
            return redirect()->back()->with('error', 'Aksi tidak valid.');
        }

        $status = ($action == 'terima') ? 1 : 2;

        Pendataan::whereIn('id', $ids)->update(['status' => $status]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerima $penerima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerima $penerima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerima $penerima)
    {
        //
    }
}
