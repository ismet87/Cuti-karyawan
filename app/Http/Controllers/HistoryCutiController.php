<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryCuti;
use App\Models\karyawan;
use App\Models\Cuti;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;


class HistoryCutiController extends Controller
{public function index(Request $request)
    {
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun saat ini jika tidak ada input
        $search = $request->input('search');
        
        // Ambil data cuti dengan join ke tabel karyawans dan jenis_cutis
        $cutis = DB::table('karyawans')
            ->leftjoin('cuti', 'cuti.karyawan_id', '=', 'karyawans.id')
            // ->join('jenis_cuti', 'cuti.jenis_cuti_id', '=', 'jenis_cuti.id')
            ->select( 
                'cuti.*',
                'karyawans.nama as karyawan_name',  // Alias untuk nama karyawan
                'karyawans.nik as karyawan_nik',    // Alias untuk NIK
                // 'jenis_cuti.nama as jenis_cuti_name', // Alias untuk jenis cuti
                // 'cuti.tgl_awal',                    // Menambahkan kolom tanggal awal
                // 'cuti.tgl_akhir',                   // Menambahkan kolom tanggal akhir
                // 'cuti.keterangan',                  // Menambahkan kolom keterangan
                DB::raw('( 
                    SELECT 12 - COALESCE(SUM(c.lama_cuti), 0) 
                    FROM cuti as c 
                    JOIN jenis_cuti as jc ON jc.id = c.jenis_cuti_id 
                    WHERE c.karyawan_id = karyawans.id 
                      AND YEAR(c.tgl_entri) = ' . $tahun . ' 
                      AND jc.is_wajib = 0
                ) as sisa_cuti')
            )
            ->when($search, function ($query, $search) {
                return $query->where('karyawans.nama', 'like', '%' . $search . '%');
            })
            ->whereYear('cuti.tgl_entri', $tahun) // Filter data berdasarkan tahun
            ->paginate(10);  // Pagination untuk 10 data per halaman
    
        // Kirim data tahun yang tersedia ke view
        $tahunOptions = range(date('Y'), 2020);
    
        // Kirim data ke view
        return view('history_cuti.index', compact('cutis', 'tahun', 'tahunOptions'));
    }
    
    
    
    
    public function generatePdf($id)
    {
        // Ambil data karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);
    
        // Ambil data cuti terkait karyawan
        $cutis = DB::table('cuti')
            ->join('jenis_cuti', 'cuti.jenis_cuti_id', '=', 'jenis_cuti.id')
            ->select(
                'cuti.*',
                'jenis_cuti.nama as jenis_cuti_name',
                'cuti.keterangan'  // Menambahkan kolom keterangan
                
            )
            ->where('cuti.karyawan_id', $id)
            ->get(); // Mengambil semua data cuti untuk karyawan tertentu
    
        // Render view 'pdf' dengan data karyawan dan cuti
        $pdf = Pdf::loadView('history_cuti.pdf', compact('karyawan', 'cutis'));
    
        // Tampilkan langsung PDF di browser atau unduh
        return $pdf->stream('rekap_cuti_' . $karyawan->id . '.pdf');
    }
    
    

    // public function create()
    // {
    //     {
    //         return view('history_cuti.create', compact('karyawans'));
    //     }
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'sisa_cuti' => 'required|integer',
    //     ]);

    //     HistoryCuti::create($request->all());
    //     return redirect()->route('history_cuti.index')->with('success', 'Data berhasil ditambahkan.');
    // }

    // public function edit($id)
    // {
    //     $historyCuti = HistoryCuti::findOrFail($id);
    //     return view('history_cuti.edit', compact('historyCuti'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'sisa_cuti' => 'required|integer',
    //     ]);

    //     $historyCuti = HistoryCuti::findOrFail($id);
    //     $historyCuti->update($request->all());
    //     return redirect()->route('history_cuti.index')->with('success', 'Data berhasil diperbarui.');
    // }

    // public function destroy($id)
    // {
    //     $historyCuti = HistoryCuti::findOrFail($id);
    //     $historyCuti->delete();
    //     return redirect()->route('history_cuti.index')->with('success', 'Data berhasil dihapus.');
    // }
}
