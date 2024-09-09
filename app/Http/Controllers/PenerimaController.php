<?php

namespace App\Http\Controllers;

use App\Models\Pendataan;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    public function index()
    {
        $pendataan = Pendataan::all();
        return view('Penerima.index', compact('pendataan'));
    }

    public function bulkUpdate(Request $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if (!in_array($action, ['terima', 'tolak'])) {
            return response()->json(['error' => 'Aksi tidak valid.'], 400);
        }

        $status = ($action == 'terima') ? 1 : 2;

        try {
            Pendataan::whereIn('id', $ids)->update(['status' => $status]);
            return response()->json(['message' => 'Data berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Tambahkan method search jika diperlukan
    public function search(Request $request)
    {
        $query = $request->input('query');
        $pendataan = Pendataan::where('nama_lengkap', 'LIKE', "%{$query}%")->get();
        return response()->json($pendataan);
    }
}
