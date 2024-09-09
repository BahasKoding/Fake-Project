<?php

namespace App\Http\Controllers;

use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PendataanController extends Controller
{
    public function index()
    {
        $pendataan = Pendataan::all();
        return view('Pendataan.index', compact('pendataan'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'no_pendataan' => 'required|string|max:255',
                'nik' => 'required|integer',
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string',
                'umur' => 'required|integer',
                'alamat' => 'required|string|max:255',
            ]);
            $validatedData['status'] = 0;

            $pendataan = Pendataan::create($validatedData);

            return response()->json([
                'message' => 'Data berhasil disimpan!',
                'data' => $pendataan
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function edit($id)
    {
        $pendataan = Pendataan::findOrFail($id);
        return response()->json($pendataan);
    }

    public function update(Request $request, $id)
    {
        try {
            $pendataan = Pendataan::findOrFail($id);
            $validatedData = $request->validate([
                'no_pendataan' => 'required|string|max:255',
                'nik' => 'required|integer',
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string',
                'umur' => 'required|integer',
                'alamat' => 'required|string|max:255',
            ]);

            $pendataan->update($validatedData);

            return response()->json([
                'message' => 'Data berhasil diperbarui!',
                'data' => $pendataan
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        $pendataan = Pendataan::findOrFail($id);
        $pendataan->delete();
        return response()->json(['message' => 'Data berhasil dihapus!'], 200);
    }
}
