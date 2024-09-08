<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class PengumumanController extends Controller
{
    public function index()
    {
        try {
            $pengumuman = Pengumuman::all();
            return view('Pengumuman.index', compact('pengumuman'));
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul_kegiatan' => 'required',
                'file'           => 'required|file|mimes:pdf,doc,docx|max:2048',
            ]);

            $data = $request->only(['judul_kegiatan']);
            if ($request->hasFile('file')) {
                $data['file'] = $request->file('file')->store('files', 'public');
            }

            Pengumuman::create($data);

            return response()->json(['message' => 'Pengumuman berhasil ditambahkan'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        try {
            $pengumuman = Pengumuman::findOrFail($id);
            return response()->json($pengumuman);
        } catch (Exception $e) {
            return response()->json(['error' => 'Pengumuman tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pengumuman = Pengumuman::findOrFail($id);

            $request->validate([
                'judul_kegiatan' => 'required',
                'file'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ]);

            $data = $request->only(['judul_kegiatan']);
            if ($request->hasFile('file')) {
                if ($pengumuman->file) {
                    Storage::disk('public')->delete($pengumuman->file);
                }
                $data['file'] = $request->file('file')->store('files', 'public');
            }

            $pengumuman->update($data);

            return response()->json(['message' => 'Pengumuman berhasil diperbarui'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pengumuman = Pengumuman::findOrFail($id);
            Storage::disk('public')->delete($pengumuman->file);
            $pengumuman->delete();

            return response()->json(['message' => 'Pengumuman berhasil dihapus'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
