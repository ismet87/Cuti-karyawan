<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawan;
use DB;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        // // Ambil nilai pencarian dari input form
        $search = $request->input('search');
    
        // // Query untuk menampilkan karyawan, dengan pencarian nama
        // $karyawans = Karyawan::when($search, function ($query, $search) {
        //     return $query->where('nama', 'like', '%' . $search . '%');
        // })->paginate(6);  // Menampilkan 10 data per halaman
        $karyawans = Karyawan::when($search, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        })
        // ->leftJoin('cuti', 'karyawans.id', '=', 'cuti.karyawan_id')
        ->select(
            'karyawans.*',
            DB::raw('( SELECT 12 - COALESCE(SUM(cuti.lama_cuti), 0) 
            from cuti 
            join jenis_cuti on jenis_cuti.id  = cuti.jenis_cuti_id
            where karyawan_id = karyawans.id 
            and year(tgl_entri) = \''.date("Y").'\'
            and jenis_cuti.is_wajib = 0
            )  as sisa_cuti')
        )
        // ->where(DB::raw('year(cuti.tgl_entri)'), '=', date("Y"))
        // ->groupBy('karyawans.id', 'karyawans.nama')
        ->paginate(5);
        
    
        return view('karyawans.index', compact('karyawans'));
    }
    

public function create()
{
    return view('karyawans.create');
}

public function store(Request $request)
{
    $request->validate([
        'nik' => 'required|unique:karyawans',
        'nama' => 'required',
        'tgl_lahir' => 'required|date',
        'tgl_masuk' => 'required|date',
    ]);

    Karyawan::create($request->all());
    return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil ditambahkan.');
}

public function edit(Karyawan $karyawan)
{
    return view('karyawans.edit', compact('karyawan'));
}

public function update(Request $request, Karyawan $karyawan)
{
    $request->validate([
        'nik' => 'required|unique:karyawans,nik,' . $karyawan->id,
        'nama' => 'required',
        'tgl_lahir' => 'required|date',
        
        'tgl_masuk' => 'required|date',
    ]);

    $karyawan->update($request->all());
    return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil diupdate.');
}

public function destroy(Karyawan $karyawan)
{
    $karyawan->delete();
    return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil dihapus.');
}

}
