<?php

namespace App\Http\Controllers;

use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JenisCutiController extends Controller
{
    public function index()
    {
        $jenisCuti = JenisCuti::paginate(5);
        return view('jenis_cuti.index', compact('jenisCuti'));
    }

    public function create()
    {
        return view('jenis_cuti.create');
    }

    public function store(Request $request)
{
    $data = JenisCuti::create($request->all());
    return response()->json([
        'success' => true,
        'data' => $data
    ]);
}


    public function show(JenisCuti $jenisCuti)
    {
        return view('jenis_cuti.show', compact('jenisCuti'));
    }

    public function edit(JenisCuti $jenisCuti)
    {
        // Respons JSON untuk memuat data ke modal edit
        return response()->json($jenisCuti);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'is_wajib' => 'required|boolean',
            'keterangan' => 'nullable|string',
        ]);
    
        // Update data
        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->update($validated);
    
        return response()->json(['success' => true, 'data' => $jenisCuti], 200);
    }
    

    public function destroy(JenisCuti $jenisCuti)
    {
        try {
            $jenisCuti->delete();
            return response()->json(['success' => true, 'message' => 'Jenis cuti berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
    
}
