<?php

namespace App\Http\Controllers;

use App\Models\Pendataan;
use Illuminate\Http\Request;

class PendataanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pendataan.index');
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
        // Validasi input
        $validatedData = $request->validate([
            'no_pendataan' => 'required|string|max:255',
            'nik' => 'required|integer',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|integer',
            'alamat' => 'required|string|max:255',
        ]);
        // Tambahkan status secara otomatis
        $validatedData['status'] = 0;
        
        // Simpan data ke database
        Pendataan::create($validatedData);

        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Pendataan $pendataan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendataan $pendataan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendataan $pendataan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendataan $pendataan)
    {
        //
    }
}
